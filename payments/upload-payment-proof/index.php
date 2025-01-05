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
        <h1 class="h2">Upload Payment Proof</h1>
      </div>

      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <form method="post" action="process-upload.php" enctype="multipart/form-data">
                <!-- Payment Details -->
                <div class="mb-3">
                  <label for="transactionId" class="form-label">Transaction ID</label>
                  <input type="text" class="form-control" id="transactionId" name="transaction_id" placeholder="Enter Transaction ID" required>
                </div>

                <div class="mb-3">
                  <label for="paymentDate" class="form-label">Payment Date</label>
                  <input type="date" class="form-control" id="paymentDate" name="payment_date" required>
                </div>

                <div class="mb-3">
                  <label for="amount" class="form-label">Amount Paid</label>
                  <input type="number" class="form-control" id="amount" name="amount" step="0.01" placeholder="Enter Amount Paid" required>
                </div>

                <!-- File Upload -->
                <div class="mb-3">
                  <label for="paymentProof" class="form-label">Payment Proof</label>
                  <input type="file" class="form-control" id="paymentProof" name="payment_proof" accept=".jpg,.jpeg,.png,.pdf" required>
                  <small class="form-text text-muted">Accepted formats: JPG, PNG, PDF. Max size: 5MB.</small>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload"></i> Upload
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Additional Information -->
        <div class="col-md-4">
          <div class="alert alert-info" role="alert">
            <h5 class="alert-heading"><i class="bi bi-info-circle"></i> Instructions</h5>
            <p>Please make sure the information matches your payment receipt. Uploaded proof will be verified by our team within 3-5 business days.</p>
            <hr>
            <p class="mb-0">For assistance, contact <a href="contact-support.php">Support</a>.</p>
          </div>
        </div>
      </div>
    </main>



  </div>
</div>
<script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
