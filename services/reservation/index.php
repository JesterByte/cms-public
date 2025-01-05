<?php
// Fetch available grave lots from the database
include_once "../../database-connection.php";

$sql = "SELECT grave_id 
FROM cemetery_graves 
WHERE status = 'Available' 
ORDER BY 
  CAST(SUBSTRING(grave_id, LOCATE('C', grave_id) + 1, LOCATE('G', grave_id) - LOCATE('C', grave_id) - 1) AS UNSIGNED)
";
$result = $connection->query($sql);

$options = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $graveCode = $row['grave_id'];
        if (preg_match('/P(\d+)-C(\d+)G(\d+)/', $graveCode, $matches)) {
            $phase = $matches[1];
            $column = $matches[2];
            $grave = $matches[3];
            $lotName = "Phase {$phase} - Column {$column}, Grave {$grave}<br>";
        } else {
            echo "Invalid format for {$graveCode}<br>";
        }
        $options .= "<option value='{$row['grave_id']}'>{$lotName}</option>";
    }
} else {
    $options = "<option value='' disabled>No available lots</option>";
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  </head>
  <body>
    <?php 
      include_once "theme.html"; 
      include_once "navbar.php";
    ?>

<main class="container mt-5">
      <h1 class="display-4 text-center mb-4 py-3">Make a Reservation</h1>
      <p class="lead text-center mb-5">Reserve a grave lot easily by filling out the form below. Our team will review your request and confirm your reservation.</p>

      <div class="row py-5">
        <!-- Map on the left -->
        <div class="col-md-6 py-3">
          <div id="map" class="rounded shadow" style="height: 400px;"></div>
        </div>

        <!-- Form on the right -->
        <div class="col-md-6">
          <form action="submit-reservation.php" class="needs-validation" novalidate method="POST">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="first-name" name="first_name" maxlength="50" pattern="[A-Za-z\s\-']+" placeholder="First Name" required>
              <label for="first-name">First Name</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="middle-name" name="middle_name" maxlength="50" pattern="[A-Za-z\s\-']+" placeholder="Middle Name (Optional)">
              <label for="middle-name">Middle Name (Optional)</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="last-name" name="last_name" maxlength="50" pattern="[A-Za-z\s\-']+" placeholder="Last Name" required>
              <label for="last-name">Last Name</label>
            </div>
            <div class="form-floating mb-3">
              <select name="" id="suffix" class="form-select" aria-label="Default select example">
                <option value="" selected></option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
              </select>
              <label for="suffix">Suffix (Optional)</label>
            </div>
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
              <label for="email">Email Address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="tel" class="form-control" id="phone" name="phone" pattern="^\+639\d{2}-\d{3}-\d{4}$" placeholder="Phone Number" required>
              <label for="phone">Phone Number</label>
            </div>
            <div class="form-floating mb-3">
              <select class="form-select" id="lotSelection" name="grave_lot" required>
                <option value="" disabled selected></option>
                <?php echo $options; ?>
                <!-- Dynamic lot options will be fetched from the database -->
              </select>
              <label for="lotSelection" class="form-label">Choose an available lot</label>
            </div>
            <div class="form-floating mb-3">
              <textarea class="form-control" id="reservationNotes" maxlength="500" name="reservation_notes" rows="4" placeholder="Any specific requests or notes about your reservation (Optional)" title="You can expand by dragging the bottom-right corner of the text area"></textarea>
              <label for="reservationNotes">Any specific requests or notes about your reservation (Optional)</label>
              <small id="charCount" class="form-text text-muted">500 characters remaining</small>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg" name="submit_button">Submit Reservation</button>
            </div>
          </form>
        </div>
      </div>
    </main>

    <?php include_once "footer.html"; ?>
    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/dist/js/sweetalert2.js"></script>

    <!-- Leaflet.js -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
      document.getElementById('reservationNotes').addEventListener('input', function() {
        const remainingChars = 500 - this.value.length;
        document.getElementById('charCount').textContent = remainingChars + " characters remaining";
      });
    </script>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
      })()
    </script>

    <script>
      document.getElementById('phone').addEventListener('focus', function(e) {
        if (e.target.value === '') {
          e.target.value = '+639'; // Automatically add +639 when the user focuses on the input field
        }
      });

      document.getElementById('phone').addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, ''); // Remove any non-numeric characters
        
        // Ensure the number starts with +639 and limit input length to 13 characters
        if (value.length <= 3) {
          e.target.value = '+639' + value.slice(3);
        } else {
          let formatted = '+639' + value.slice(3, 5); // The +639 stays fixed
          if (value.length > 5) {
            formatted += '-' + value.slice(5, 8); // Add hyphen after the 5th digit
          }
          if (value.length > 8) {
            formatted += '-' + value.slice(8, 12); // Add hyphen after the 7th digit
          }
          e.target.value = formatted.slice(0, 15); // Limit the length to 13 characters (including hyphens)
        }
      });
    </script>

    <script>
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
    </script>


  </body>
</html>
