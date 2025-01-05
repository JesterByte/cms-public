<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
      #map {
        height: 600px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <?php 
      include_once "theme.html"; 
      include_once "navbar.php";
    ?>
    
    <main>
      <div class="container py-5">
        <h1 class="display-4 text-center mb-4 py-3">Cemetery Map</h1>
        <p class="lead text-center mb-5">Check the status of available lots and locate your loved one's grave with ease.</p>
        <div class="rounded shadow" id="map"></div>
      </div>
    </main>

    <?php include_once "footer.html"; ?>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
      $(document).ready(function() {
        var map = L.map('map').setView([14.871318, 120.976566], 18); // Use your latitude and longitude

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
          maxZoom: 20
        }).addTo(map);

        // Function to draw rectangles for graves
        function drawGrave(grave) {
          const graveWidth = 0.000009; // Approx. 1 meter in longitude degrees
          const graveHeight = 0.000018; // Approx. 2 meters in latitude degrees

          // Calculate end latitude and longitude based on starting coordinates and grave size
          var startLat = grave.latitude_start;
          var startLng = grave.longitude_start;
          var endLat = grave.latitude_end;
          var endLng = grave.longitude_end;

          // Determine the color based on grave status
          let color;
          switch (grave.status) {
            case 'Available':
              color = 'green';
              break;
            case 'Reserved':
              color = 'yellow';
              break;
            case 'Sold':
              color = 'red';
              break;
            case 'Sold and Occupied':
              color = 'gray';
              break;
            default:
              color = 'blue'; // Default color for unknown status
          }

          // Create a rectangle (polygon) for the grave lot
          var rectangle = L.rectangle([[startLat, startLng], [endLat, endLng]], {
            color: color,
            weight: 1,
            fillOpacity: 0.5
          }).addTo(map);

          // Add a popup to the rectangle showing the status
          rectangle.bindPopup("<b>Status:</b> " + grave.status);
        }


        // Fetch grave data from PHP file (using AJAX)
        fetch('fetch-grave-data.php')
          .then(response => response.json())
          .then(data => {
            // Iterate through graves and draw rectangles
            data.forEach(grave => {
              drawGrave(grave);
            });
          })
          .catch(error => console.error('Error fetching grave data:', error));
      });
    </script>

    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
