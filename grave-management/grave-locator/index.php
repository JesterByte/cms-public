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
        <h1 class="h2">Grave Locator</h1>
      </div>

      <div class="row mb-4">
        <div class="col-md-12">
          <!-- Search Form -->
          <form action="grave-locator-results.php" method="GET" class="row g-3">
            <div class="col-md-6">
              <input type="text" class="form-control" name="search" placeholder="Enter Name, ID, or Date" required>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="filter">
                <option value="name" selected>Search by Name</option>
                <option value="id">Search by ID</option>
                <option value="date">Search by Date</option>
              </select>
            </div>
            <div class="col-md-3">
              <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search"></i> Search
              </button>
            </div>
          </form>
        </div>
      </div>

      <!-- Search Results Section -->
      <div class="row">
        <div class="col-md-12">
          <h5>Search Results</h5>
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-primary">
                <tr>
                  <th scope="col">Grave ID</th>
                  <th scope="col">Name</th>
                  <th scope="col">Date of Burial</th>
                  <th scope="col">Section</th>
                  <th scope="col">Location</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Example data; replace with dynamic PHP code -->
                <tr>
                  <td>G12345</td>
                  <td>John Doe</td>
                  <td>2023-10-15</td>
                  <td>Section A</td>
                  <td>Row 5, Plot 12</td>
                  <td>
                    <a href="view-grave-map.php?id=G12345" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-map-fill"></i> View on Map
                    </a>
                  </td>
                </tr>
                <!-- Repeat for additional rows -->
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Map Section -->
      <div class="row mt-5">
        <div class="col-md-12">
          <h5>Map</h5>
          <div class="card">
            <div class="card-body">
              <!-- Embed a static map or integrate an API like Google Maps -->
              <div id="map" style="height: 400px; width: 100%; background: #f0f0f0; text-align: center; line-height: 400px;">
                Map will be displayed here (e.g., Google Maps integration).
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>
<script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
