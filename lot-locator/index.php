<?php
    session_start();
    require_once "../utils/helpers.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
<head>
    <?php 
        $pageTitle = "Lot Locator";
        include_once "../components/head.php"; 
    ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
        .legend {
            background: white;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .legend h4 {
            margin: 0 0 10px;
        }
        .legend div {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }
        .legend div span {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php 
        include_once "../components/theme.html"; 
        include_once "../components/navbar.php";
    ?>
    
    <main>
        <div class="container mt-5">
          <h1 class="display-4 text-center mb-4">Lot Locator</h1>
          <p class="lead text-center mb-5">Check the status of available lots and locate your loved one's lot with ease.</p>            
          <div class="rounded shadow mb-4" id="map"></div>
        </div>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([14.871318, 120.976566], 18); // Use your latitude and longitude

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 20
            }).addTo(map);

            // Function to draw rectangles for lots
            function drawLot(lot) {
                const lotWidth = 0.000009; // Approx. 1 meter in longitude degrees
                const lotHeight = 0.000018; // Approx. 2 meters in latitude degrees

                // Calculate end latitude and longitude based on starting coordinates and lot size
                var startLat = lot.latitude_start;
                var startLng = lot.longitude_start;
                var endLat = lot.latitude_end;
                var endLng = lot.longitude_end;

                // Determine the color based on lot status
                let color;
                switch (lot.status) {
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

                // Create a rectangle (polygon) for the lot lot
                var rectangle = L.rectangle([[startLat, startLng], [endLat, endLng]], {
                    color: color,
                    weight: 1,
                    fillOpacity: 0.5
                }).addTo(map);

                // Add a popup to the rectangle showing the status
                rectangle.bindPopup("<b>Status:</b> " + lot.status);
            }

            // Fetch lot data from PHP file (using AJAX)
            fetch('../content/lot-locator.php')
                .then(response => response.json())
                .then(data => {
                    // Iterate through lots and draw rectangles
                    data.forEach(lot => {
                        drawLot(lot);
                    });
                })
                .catch(error => console.error('Error fetching lot data:', error));

            // Add legend to the map
            var legend = L.control({ position: 'bottomright' });

            legend.onAdd = function (map) {
                var div = L.DomUtil.create('div', 'legend');
                div.innerHTML += '<h4>Legend</h4>';
                div.innerHTML += '<div><span style="background: green;"></span>Available</div>';
                div.innerHTML += '<div><span style="background: yellow;"></span>Reserved</div>';
                div.innerHTML += '<div><span style="background: red;"></span>Sold</div>';
                div.innerHTML += '<div><span style="background: gray;"></span>Sold and Occupied</div>';
                return div;
            };

            legend.addTo(map);
        });
    </script>
  </body>
</html>