<?php 
session_start(); 

if (!isset($_SESSION["step"])) {
  unset($_SESSION["email"]);
  unset($_SESSION["otp"]);
  unset($_SESSION["otp_expiry"]);

  $_SESSION["step"] = 1;
}
?>
<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
    <title>Forgot Password</title>
    <style>
      /* Add some feedback for invalid inputs */
      .is-invalid {
        border-color: #dc3545;
      }
    </style>
  </head>
  <body>
    <?php include_once "theme.html"; ?>

    <main class="container mt-5 border py-5 rounded shadow">
      <?php 
        if (isset($_SESSION["step"]) && $_SESSION["step"] > 1) {
          echo '<button type="button" class="btn shadow" data-bs-toggle="modal" data-bs-target="#cancel-forgot-password-modal">
            <i class="bi bi-arrow-left"></i>
          </button>';
        } else {
          echo '<a href="../login/" class="btn shadow"><i class="bi bi-arrow-left"></i></a>';
        }
      ?>
      <h1 class="display-4 text-center mb-4">Forgot Password</h1>
      <p class="lead text-center mb-5">Please follow the steps to reset your password.</p>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <form id="forgotPasswordForm" class="needs-validation" novalidate action="submit-forgot-password.php" method="POST">
            <!-- Step 1: Enter Email -->
            <?php if (!isset($_SESSION["step"]) || $_SESSION["step"] == 1): ?>
              <div id="step1" class="step">
                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ""; ?>" placeholder="Email Address" required>
                  <label for="email">Email Address</label>
                  <div class="invalid-feedback">
                    Please provide a valid email address.
                  </div>
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-lg" name="submit_button_1">Next</button>
                </div>
              </div>
            <?php endif; ?>

            <!-- Step 2: Enter Verification Code -->
            <?php if (isset($_SESSION["step"]) && $_SESSION["step"] == 2): ?>
              <div id="step2" class="step">
                <div class="form-floating mb-3">
                  <input 
                    type="text" 
                    class="form-control" 
                    id="verificationCode" 
                    name="verification_code" 
                    placeholder="Verification Code" 
                    pattern="\d{6}" 
                    maxlength="6" 
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" 
                    required>
                  <label for="verificationCode">Verification Code</label>
                  <div class="invalid-feedback">
                    Please provide a 6-digit verification code.
                  </div>
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-lg" name="submit_button_2">Next</button>
                </div>
              </div>
            <?php endif; ?>


            <!-- Step 3: Set New Password -->
            <?php if (isset($_SESSION["step"]) && $_SESSION["step"] == 3): ?>
              <div id="step3" class="step">
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="newPassword" name="new_password" placeholder="New Password" minlength="8" required>
                  <label for="newPassword">New Password</label>
                  <div class="invalid-feedback">
                    Password must be at least 8 characters, include an uppercase letter, a lowercase letter, a number, and a special character.
                  </div>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                  <label for="confirmPassword">Confirm Password</label>
                  <div class="invalid-feedback">
                    Passwords do not match.
                  </div>
                </div>
                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-success btn-lg" name="submit_button_3">Reset Password</button>
                </div>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="cancel-forgot-password-modal" tabindex="-1" aria-labelledby="cancel-forgot-password-modal-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header text-bg-success">
            <h1 class="modal-title fs-5" id="cancel-forgot-password-modal-label">Forgot Password Cancellation</h1>
          </div>
          <div class="modal-body">
            Are you sure you want to cancel the password reset process?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form action="submit-forgot-password.php" method="post">
              <button type="submit" class="btn btn-primary" name="cancel_forgot_password">Yes</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Validate form inputs before submission
      document.getElementById('forgotPasswordForm').addEventListener('submit', function (event) {
        let form = event.target;

        // Check password match if on step 3
        if (<?php echo isset($_SESSION["step"]) && $_SESSION["step"] == 3 ? "true" : "false"; ?>) {
          let password = document.getElementById('newPassword');
          let confirmPassword = document.getElementById('confirmPassword');

          if (password.value !== confirmPassword.value) {
            confirmPassword.setCustomValidity("Passwords do not match.");
            confirmPassword.classList.add('is-invalid');
            event.preventDefault();
            return;
          } else {
            confirmPassword.setCustomValidity("");
            confirmPassword.classList.remove('is-invalid');
          }
        }

        // Validate other inputs
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add('was-validated');
      });
    </script>
  </body>
</html>
