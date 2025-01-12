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
      $pageTitle = "Payments";
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
          </div>

        <!-- DataTable -->
        <div class="table-responsive rounded shadow">
            <table id="myReservationsTable" class="table table-striped table-hover table-bordered text-center" style="width:100%">
              <thead>
                <tr>
                  <th>Payment Date</th>
                  <th>Payment For</th>
                  <th>Payment Option</th>
                  <th>Amount</th>
                  <th>Payment Status</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>

        </main>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php include_once "../components/datatable-cdn-js.html"; ?>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/initialize-datatable.js"></script>

    <?php include_once "../components/modals/modal-sign-out.html"; ?>

    <script>
      $(document).ready(function() {
        initializeDataTable("#myReservationsTable")
      });
    </script>

  </body>
</html>
