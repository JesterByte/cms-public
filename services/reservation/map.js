// Initialize the map
var map = L.map('map').setView([14.871318, 120.976566], 18);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors',
  maxZoom: 20
}).addTo(map);

const graveWidth = 0.000009; // Approx. 1 meter in longitude degrees
const graveHeight = 0.000018; // Approx. 2 meters in latitude degrees

// Fetch available grave lots from the server using AJAX
fetch('fetch-grave-lots.php')
    .then(response => response.json())
    .then(graveLots => {
      // Add rectangles for each available grave lot
      graveLots.forEach(lot => {
        var startLat = lot.lat_start;
        var startLng = lot.lng_start;

        // Calculate the end coordinates for the rectangle
        var endLat = lot.lat_end;
        var endLng = lot.lng_end;

        // Create a rectangle (polygon) for the grave lot
        var rectangle = L.rectangle([[startLat, startLng], [endLat, endLng]], {
          color: lot.status === 'Available' ? 'green' : 'yellow',  // Color based on status
          weight: 1,
          fillOpacity: 0.5
        }).addTo(map);

        // Add a popup to the rectangle showing the status
        rectangle.bindPopup(`<b>${lot.grave_id}</b><br>Status: ${lot.status}`);
            
        // Set the selection behavior on click
        rectangle.on('click', function() {
          document.getElementById('lotSelection').value = lot.grave_id; // Set selected lot in the form
        });
      });
    })
    .catch(error => {
      console.error('Error fetching grave lots:', error);
    });