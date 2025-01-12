<?php 
  session_start();
  require_once "../utils/helpers.php";

  if (!isset($_SESSION["customer_id"])) {
    serverRedirect("../");
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Plot Locator";
      include_once "../components/dashboard-head.php";   
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
      include_once "../components/symbols.html";
      include_once "../components/dashboard-navbar.html";
    ?>
    
    <div class="container-fluid">
      <div class="row">
        <?php include_once "../components/sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><?= $pageTitle ?></h1>
            <!-- <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
                <svg class="bi"><use xlink:href="#calendar3"/></svg>
                This week
              </button>
            </div> -->
          </div>
          <div class="rounded shadow mb-4" id="map"></div>
        </main>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="../assets/js/modal-autofocus.js"></script>


    <?php include_once "../components/modals/modal-sign-out.html"; ?>

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
            fetch('../content/plot-locator.php')
                .then(response => response.json())
                .then(data => {
                    // Iterate through graves and draw rectangles
                    data.forEach(grave => {
                        drawGrave(grave);
                    });
                })
                .catch(error => console.error('Error fetching grave data:', error));

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
