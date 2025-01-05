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
        <h1 class="h2">Dashboard</h1>
      </div>

      <!-- Dashboard Cards -->
      <div class="row mb-4">
        <!-- Reservations -->
        <div class="col-md-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title d-flex align-items-center">
                <i class="bi bi-calendar-check me-2"></i> My Reservations
              </h5>
              <p class="card-text">View and manage your upcoming reservations.</p>
              <a href="#" class="btn btn-primary btn-sm">Manage Reservations</a>
            </div>
          </div>
        </div>
        <!-- Payment History -->
        <div class="col-md-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title d-flex align-items-center">
                <i class="bi bi-receipt me-2"></i> Payment History
              </h5>
              <p class="card-text">Review your past transactions and payments.</p>
              <a href="#" class="btn btn-success btn-sm">View History</a>
            </div>
          </div>
        </div>
        <!-- Notifications -->
        <div class="col-md-4">
          <div class="card shadow-sm">
            <div class="card-body">
              <h5 class="card-title d-flex align-items-center">
                <i class="bi bi-bell me-2"></i> Notifications
              </h5>
              <p class="card-text">Stay updated with the latest announcements and alerts.</p>
              <a href="#" class="btn btn-warning btn-sm">View Notifications</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="row mb-4">
        <h4 class="mb-3">Quick Links</h4>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <i class="bi bi-map-fill h5 mb-2"></i>
              <h6 class="card-title">Grave Locator</h6>
              <a href="#" class="btn btn-outline-primary btn-sm">Locate</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <i class="bi bi-upload h5 mb-2"></i>
              <h6 class="card-title">Upload Payment Proof</h6>
              <a href="#" class="btn btn-outline-secondary btn-sm">Upload</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <i class="bi bi-tools h5 mb-2"></i>
              <h6 class="card-title">Maintenance Requests</h6>
              <a href="#" class="btn btn-outline-success btn-sm">Request</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card text-center shadow-sm">
            <div class="card-body">
              <i class="bi bi-question-circle h5 mb-2"></i>
              <h6 class="card-title">FAQs</h6>
              <a href="#" class="btn btn-outline-info btn-sm">Learn More</a>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="row mb-4">
        <h4 class="mb-3">Recent Activity</h4>
        <div class="col-md-12">
          <table class="table table-striped table-hover shadow-sm">
            <thead class="table-light">
              <tr>
                <th>Date</th>
                <th>Activity</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-01-01</td>
                <td>Submitted payment proof</td>
                <td><span class="badge bg-success">Approved</span></td>
              </tr>
              <tr>
                <td>2024-12-30</td>
                <td>Made a maintenance request</td>
                <td><span class="badge bg-warning">Pending</span></td>
              </tr>
              <tr>
                <td>2024-12-28</td>
                <td>Reservation for Grave Lot 12B</td>
                <td><span class="badge bg-danger">Rejected</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>
<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
