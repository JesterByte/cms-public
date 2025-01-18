<?php 
  session_start();
  require_once "../utils/helpers.php";
  require_once "../content/lot-reservations.php";

  if (!isset($_SESSION["customer_id"])) {
    serverRedirect("../");
  }

  function displayNewReservationsTableHead() {
    startRow();
    tableHead("Date of Reservation");
    tableHead("Reserved Lot");
    tableHead("Lot Type");
    tableHead("Payment Option");
    tableHead("Reservation Status");
    endRow();
  }

  function displayNewReservationsTable($newReservationsTable) {
    foreach ($newReservationsTable as $newReservationsRow) {
      startRow();
      rowData($newReservationsRow["created_at"]);
      rowData($newReservationsRow["formatted_reserved_lot"]);
      rowDataBadge("primary", $newReservationsRow["lot_type"]);

      if ($newReservationsRow["lot_type"] == "Pending") $lotTypeColor = "info"; else $lotTypeColor = "primary";
      rowDataBadge($lotTypeColor, $newReservationsRow["lot_type"]);

      switch ($newReservationsRow["reservation_status"]) {
        case "Verified":
          $reservationId = "reservation_id=" . $newReservationsRow["id"] . "&timestamp=" . time();
          $encrypedData = encrypt($reservationId, SECRET_KEY);
          rowLink("btn-primary", '<i class="bi bi-list-ol"></i>', "Choose Payment Option", "../payment-options/?data=" . $encrypedData);
          break;
        case "Pending":
          rowDataBadge("info", $newReservationsRow["payment_option"]);
          break;
        default:
          rowDataBadge("info", $newReservationsRow["payment_option"]);  
      }
      
      switch ($newReservationsRow["reservation_status"]) {
        case "Pending":
          $reservationStatusColor = "info";
          break;
        case "Verified":
          $reservationStatusColor = "success";
          break;
        default:
          $reservationStatusColor = "primary";
          break;
      }
      rowDataBadge($reservationStatusColor, $newReservationsRow["reservation_status"]);
      // rowData($pendingReservationsRow["lot_type"]);
      // rowData($pendingReservationsRow["payment_option"]);
      // rowData($pendingReservationsRow["reservation_status"]);
      endRow();
    }
  }

  function displayCashSaleReservationsTableHead() {
    startRow();
    tableHead("Date of Reservation");
    tableHead("Reserved Lot");
    tableHead("Lot Type");
    tableHead("Total Purchase Price");
    tableHead("Total Balance");
    endRow();
  }

  function displayCashSaleReservationsTable($cashSaleReservationsTable) {
    foreach ($cashSaleReservationsTable as $cashSaleReservationsRow) {
      startRow();
      rowData($cashSaleReservationsRow["created_at"]);
      rowData($cashSaleReservationsRow["formatted_reserved_lot"]);
      rowDataBadge("primary", $cashSaleReservationsRow["lot_type"]);
      rowData($cashSaleReservationsRow["total_purchase_price"]);
      rowData($cashSaleReservationsRow["total_balance"]);
      endRow();
    }
  }

  function displaySixMonthsReservationsTableHead() {
    startRow();
    tableHead("Date of Reservation");
    tableHead("Reserved Lot");
    tableHead("Lot Type");
    tableHead("Total Purchase Price");
    tableHead("Total Balance");
    endRow();
  }

  function displaySixMonthsReservationsTable($sixMonthsReservationsTable) {
    foreach ($sixMonthsReservationsTable as $sixMonthsReservationsRow) {
      startRow();
      rowData($sixMonthsReservationsRow["created_at"]);
      rowData($sixMonthsReservationsRow["formatted_reserved_lot"]);
      rowDataBadge("primary", $sixMonthsReservationsRow["lot_type"]);
      rowData($sixMonthsReservationsRow["total_purchase_price"]);
      rowData($sixMonthsReservationsRow["total_balance"]);
      endRow();
    }
  }

  function displayInstallmentReservationsTableHead() {
    startRow();
    tableHead("Date of Reservation");
    tableHead("Reserved Lot");
    tableHead("Lot Type");
    tableHead("Total Purchase Price");
    tableHead("Total Balance");
    tableHead("Down Payment");
    tableHead("Monthly Payment");
    endRow();
  }

  function displayInstallmentReservationsTable($installmentReservationsTable) {
    foreach ($installmentReservationsTable as $installmentReservationsRow) {
      startRow();
      rowData($installmentReservationsRow["created_at"]);
      rowData($installmentReservationsRow["formatted_reserved_lot"]);
      rowDataBadge("primary", $installmentReservationsRow["lot_type"]);
      rowData($installmentReservationsRow["total_purchase_price"]);
      rowData($installmentReservationsRow["total_balance"]);
      rowData($installmentReservationsRow["down_payment"]);
      rowData($installmentReservationsRow["monthly_payment"]);
      endRow();
    }
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Lot Reservations";
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
              <a href="?type=new" class="btn btn-primary <?= isActivePageLink("new") ?>" <?= isAriaCurrentPageLink("new") ?>>New 
                <?= buttonBadge(count($newReservationsTable)) ?>
              </a>
              <a href="?type=cash-sale" class="btn btn-primary <?= isActivePageLink("cash-sale") ?>" <?= isAriaCurrentPageLink("cash-sale") ?>>Cash Sale</a>
              <a href="?type=six-months" class="btn btn-primary <?= isActivePageLink("six-months") ?>" <?= isAriaCurrentPageLink("six-months") ?>>6 Months</a>
              <a href="?type=installment" class="btn btn-primary <?= isActivePageLink("installment") ?>" <?= isAriaCurrentPageLink("installment") ?>>Installment</a>
              <a href="?type=cancelled" class="btn btn-primary <?= isActivePageLink("cancelled") ?>" <?= isAriaCurrentPageLink("cancelled") ?>>Cancelled</a>
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <a href="../reservation-lot" class="btn"><i class="bi bi-plus-circle-fill"></i> Reserve a new lot</a>
          </div>

        <!-- DataTable -->
        <div class="table-responsive rounded shadow">
            <table id="lotReservations" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                  <?php 
                    switch ($_GET["type"]) {
                      case "new":
                        displayNewReservationsTableHead();
                        break;
                      case "cash-sale":
                        displayCashSaleReservationsTableHead();
                        break;
                      case "six-months":
                        displaySixMonthsReservationsTableHead();
                        break;
                      case "installment":
                        displayInstallmentReservationsTableHead();
                        break;
                      default:
                        displayNewReservationsTableHead();
                        break;
                    }
                  ?>
              </thead>
              <tbody>
                <?php
                  switch ($_GET["type"]) {
                    case "new": 
                      displayNewReservationsTable($newReservationsTable);
                      break;
                    case "cash-sale":
                      displayCashSaleReservationsTable($cashSaleReservationsTable);
                      break;
                    case "six-months":
                      displaySixMonthsReservationsTable($sixMonthsReservationsTable);
                      break;
                    case "installment":
                      displayInstallmentReservationsTable($installmentReservationsTable);
                      break;
                    default:
                      displayNewReservationsTable($newReservationsTable);
                      break;
                  }
                ?>
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
        initializeDataTable("#lotReservations")
      });
    </script>

  </body>
</html>
