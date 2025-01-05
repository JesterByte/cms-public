<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
    <title>Payment Submission</title>
  </head>
  <body>
    <?php 
      include_once "theme.html"; 
      include_once "navbar.php";
    ?>

    <main class="container mt-5">
      <h1 class="display-4 text-center mb-4 py-3">Payment Submission</h1>
      <p class="lead text-center mb-5">Upload your proof of payment for verification and track your transaction status.</p>

      <div class="row justify-content-center mb-3 py-5">
        <div class="col-md-6">
          <form action="submit-payment.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="fullName" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
              <label for="transactionID" class="form-label">Transaction ID</label>
              <input type="text" class="form-control" id="transactionID" name="transaction_id" placeholder="Enter transaction ID or receipt number" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
            </div>
            <div class="mb-3">
              <label for="proofOfPayment" class="form-label">Proof of Payment</label>
              <input type="file" class="form-control" id="proofOfPayment" name="proof_of_payment" accept="image/*,application/pdf" required>
              <small class="form-text text-muted">Accepted formats: JPG, PNG, PDF (max size: 5MB).</small>
            </div>
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg">Submit Payment</button>
            </div>
          </form>
        </div>
      </div>
    </main>

    <?php include_once "footer.html"; ?>
    <script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
