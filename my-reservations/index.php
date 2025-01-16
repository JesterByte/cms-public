<?php 
  session_start();
  require_once "../utils/helpers.php";
  require_once "../content/my-reservation.php";

  if (!isset($_SESSION["customer_id"])) {
    serverRedirect("../");
  }

  function displayMyReservationsTable($myReservationsTable) {
    foreach ($myReservationsTable as $myReservationsRow) {
      startRow();
      rowData($myReservationsRow["created_at"]);
      rowData($myReservationsRow["formatted_reserved_lot"]);
      if ($myReservationsRow["lot_type"] == "Pending") {
        rowDataBadge("info", $myReservationsRow["lot_type"]);
      } else {
        rowData($myReservationsRow["lot_type"]);
      }
      rowData($myReservationsRow["total_purchase_price"]);
      rowData($myReservationsRow["total_balance"]);
      rowData($myReservationsRow["down_payment"]);  
      rowData($myReservationsRow["monthly_payment"]);
      if ($myReservationsRow["reservation_status"] == "Verified") {
        rowLink("btn-primary", '<i class="bi bi-list-ol"></i>', 'Choose', "../payment-options/?data=" . $myReservationsRow["payment_options_url"]);
      } else {
        rowData( $myReservationsRow["payment_option"]);
      }
      if ($myReservationsRow["reservation_status"] == "Pending") {
        rowDataBadge("info", $myReservationsRow["reservation_status"]);
      } else {
        rowDataBadge("success", $myReservationsRow["reservation_status"]);
      }
      if ($myReservationsRow["total_purchase_price"] == "₱0.00") {
        rowDataBadge("info", "Pending");
      } else {
        $buttonText = $myReservationsRow["monthly_payment"] != null && str_contains($myReservationsRow["payment_option"], "Installment") ? "Pay " . $myReservationsRow["monthly_payment"] : "Pay";
        rowButton("btn-primary", '<i class="bi bi-credit-card-fill"></i>', $buttonText);
      }
      endRow();  
    }
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "My Reservations";
      include_once "../components/dashboard-head.php";   
      include_once "../components/datatable-cdn-css.html"; 
    ?>
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
            <div class="btn-group">
              <a href="#" class="btn btn-primary active" aria-current="page">Pending</a>
              <a href="#" class="btn btn-primary">Cash Sale</a>
              <a href="#" class="btn btn-primary">6 Months</a>
              <a href="#" class="btn btn-primary">Installment</a>
            </div>
          </div>

        <!-- DataTable -->
        <div class="table-responsive rounded shadow">
            <table id="myReservationsTable" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                <tr>
                  <th>Date of Reservation</th>
                  <th>Reserved Lot</th>
                  <th>Lot Type</th>
                  <th>Total Purchase Price</th>
                  <th>Total Balance</th>
                  <th>Down Payment</th>
                  <th>Monthly Payment</th>
                  <th>Payment Option</th>
                  <th>Reservation Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?= displayMyReservationsTable($myReservationsTable); ?>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <?php include_once "../components/datatable-cdn-js.html"; ?>
    <script src="../assets/js/initialize-datatable.js"></script>
    <script src="../assets/js/bootstrap-toast.js"></script>


    <?php include_once "../components/modals/modal-sign-out.html"; ?>

    <script>
      $(document).ready(function() {
        const paymentOptionUpdated = <?= jsonSession("payment_option_updated") ?>

        if (paymentOptionUpdated === true) {
          showToast("Your payment option has been successfully set. Thank you for your patience!", "Payment Option Updated");
          unsetToast();
        }
      });
    </script>

    <script>
      $(document).ready(function() {
        initializeDataTable("#myReservationsTable")
      });
    </script>

  </body>
</html>
