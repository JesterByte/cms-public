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
        <h1 class="h2">My Reservations</h1>
      </div>

      <!-- Reservations Table -->
      <div class="row">
        <div class="col-md-12">
          <h5>Reservation Details</h5>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Reservation ID</th>
                  <th scope="col">Reserved Plot</th>
                  <th scope="col">Reservation Date</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example Data: Replace with dynamic PHP loop -->
                <tr>
                  <td>R12345</td>
                  <td>Section A, Row 5, Plot 12</td>
                  <td>2024-12-01</td>
                  <td><span class="badge bg-success">Confirmed</span></td>
                  <td>
                    <a href="view-reservation.php?id=R12345" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                    <a href="edit-reservation.php?id=R12345" class="btn btn-sm btn-outline-secondary">
                      <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="cancel-reservation.php?id=R12345" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-x-circle"></i> Cancel
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>R67890</td>
                  <td>Section B, Row 2, Plot 8</td>
                  <td>2024-12-10</td>
                  <td><span class="badge bg-warning">Pending</span></td>
                  <td>
                    <a href="view-reservation.php?id=R67890" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                    <a href="edit-reservation.php?id=R67890" class="btn btn-sm btn-outline-secondary">
                      <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="cancel-reservation.php?id=R67890" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-x-circle"></i> Cancel
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
