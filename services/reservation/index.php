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

    <script src="reservation-notes-input-counter.js"></script>
    <script src="form-validation.js"></script>
    <script src="phone-input-formatter.js"></script>
    <script src="map.js"></script>


  </body>
</html>
