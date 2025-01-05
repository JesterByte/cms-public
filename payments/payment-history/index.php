<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
  </head>
  <body>
    <?php 
      include_once "theme.html";
      include_once "symbols.html";
      include_once "navbar.php";
    ?>
    
<div class="container-fluid">
  <div class="row">
    <?php include_once "sidebar.php"; ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Payment History</h1>
      </div>

      <!-- Filters and Search -->
      <div class="row mb-4">
        <div class="col-md-6">
          <form class="d-flex" method="get" action="payment-history.php">
            <input type="date" class="form-control me-2" name="start_date" placeholder="Start Date">
            <input type="date" class="form-control me-2" name="end_date" placeholder="End Date">
            <button class="btn btn-outline-primary" type="submit">
              <i class="bi bi-funnel"></i> Filter
            </button>
          </form>
        </div>
        <div class="col-md-6 text-end">
          <form class="d-inline-flex" method="get" action="payment-history.php">
            <input type="text" class="form-control me-2" name="search" placeholder="Search transactions">
            <button class="btn btn-outline-secondary" type="submit">
              <i class="bi bi-search"></i> Search
            </button>
          </form>
        </div>
      </div>

      <!-- Payment History Table -->
      <div class="row">
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Transaction ID</th>
                  <th scope="col">Date</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Status</th>
                  <th scope="col">Remarks</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example Data: Replace with dynamic PHP loop -->
                <tr>
                  <td>TXN001</td>
                  <td>2025-01-01</td>
                  <td>$500.00</td>
                  <td><span class="badge bg-success">Completed</span></td>
                  <td>Paid for grave reservation.</td>
                  <td>
                    <a href="view-payment.php?id=TXN001" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>TXN002</td>
                  <td>2025-01-02</td>
                  <td>$200.00</td>
                  <td><span class="badge bg-warning">Pending</span></td>
                  <td>Maintenance service payment.</td>
                  <td>
                    <a href="view-payment.php?id=TXN002" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>TXN003</td>
                  <td>2025-01-03</td>
                  <td>$150.00</td>
                  <td><span class="badge bg-danger">Failed</span></td>
                  <td>Payment attempt for headstone upgrade.</td>
                  <td>
                    <a href="retry-payment.php?id=TXN003" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-arrow-clockwise"></i> Retry
                    </a>
                  </td>
                </tr>
                <!-- End of Example Data -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>


  </div>
</div>
<script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
