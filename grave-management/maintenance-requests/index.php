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
        <h1 class="h2">Maintenance Requests</h1>
      </div>

      <!-- New Maintenance Request Form -->
      <div class="row mb-4">
        <div class="col-md-12">
          <h5>Submit a New Maintenance Request</h5>
          <form action="submit-maintenance.php" method="post">
            <div class="mb-3">
              <label for="gravePlot" class="form-label">Grave Plot</label>
              <input type="text" class="form-control" id="gravePlot" name="gravePlot" placeholder="e.g., Section A, Row 3, Plot 15" required>
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description of Issue</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe the maintenance issue..." required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
              <i class="bi bi-send"></i> Submit Request
            </button>
          </form>
        </div>
      </div>

      <!-- Existing Maintenance Requests -->
      <div class="row">
        <div class="col-md-12">
          <h5>Existing Maintenance Requests</h5>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Request ID</th>
                  <th scope="col">Grave Plot</th>
                  <th scope="col">Description</th>
                  <th scope="col">Date Submitted</th>
                  <th scope="col">Status</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example Data: Replace with dynamic PHP loop -->
                <tr>
                  <td>REQ001</td>
                  <td>Section A, Row 3, Plot 15</td>
                  <td>Overgrown grass and weeds.</td>
                  <td>2025-01-01</td>
                  <td><span class="badge bg-warning">Pending</span></td>
                  <td>
                    <a href="view-maintenance.php?id=REQ001" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
                    </a>
                    <a href="cancel-maintenance.php?id=REQ001" class="btn btn-sm btn-outline-danger">
                      <i class="bi bi-x-circle"></i> Cancel
                    </a>
                  </td>
                </tr>
                <tr>
                  <td>REQ002</td>
                  <td>Section B, Row 2, Plot 8</td>
                  <td>Damaged headstone.</td>
                  <td>2025-01-02</td>
                  <td><span class="badge bg-success">Completed</span></td>
                  <td>
                    <a href="view-maintenance.php?id=REQ002" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-eye"></i> View
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
