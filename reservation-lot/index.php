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
      $pageTitle = "Reserve a Lot";
      include_once "../components/dashboard-head.php";   
    ?>
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
          <p class="lead text-muted">Please select an available lot on the map below to reserve it. A staff member will verify the lot type and pricing.</p>          
          <div class="rounded shadow mb-4" id="map"></div>
        </main>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/bootstrap-toast.js"></script>
    
    <?php 
        include_once "../components/modals/modal-sign-out.html"; 
        include_once "../components/modals/modal-reservation-lot.html";
    ?>

    <script>
      const lotInserted = <?= echoSessionToast("lot_reservation_inserted"); ?>

      if (lotInserted === true) {
        showToast("Your reservation request has been submitted successfully. Our staff will verify the selected lot and notify you once the verification is complete. Thank you for your patience!", "Reservation Submitted");
        unsetToast();
      }
    </script>

    <script>
        $(document).ready(function() {
            var map = L.map('map').setView([14.871318, 120.976566], 18); // Use your latitude and longitude

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                maxZoom: 20
            }).addTo(map);

            // Function to draw rectangles for lot
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

                // Add click event listener to the rectangle
                rectangle.on('click', function() {
                    // Set the values in the modal
                    $('#lotId').val(lot.lot_id);

                    // Show the modal
                    $('#lotReservationModal').modal('show');
                });
            }

            // Fetch lot data from PHP file (using AJAX)
            fetch('../content/reservation-lot.php')
                .then(response => response.json())
                .then(data => {
                    // Iterate through lots and draw rectangles
                    data.forEach(lot => {
                        drawLot(lot);
                    });
                })
                .catch(error => console.error('Error fetching lot data:', error));
        });
    </script>

  </body>
</html>
