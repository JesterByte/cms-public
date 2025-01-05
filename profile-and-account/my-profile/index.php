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
        <h1 class="h2">My Profile</h1>
      </div>

      <div class="row">
        <!-- Profile Details -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-person-circle me-2"></i>Personal Information</h5>
              <form action="update-profile.php" method="POST" class="needs-validation" novalidate>
                <!-- Full Name -->
                <div class="form-floating mb-3">
                  <input 
                    type="text" 
                    class="form-control" 
                    id="fullName" 
                    name="full_name" 
                    value="John Doe" 
                    placeholder="Full Name" 
                    required>
                  <label for="fullName">Full Name</label>
                  <div class="invalid-feedback">Please enter your full name.</div>
                </div>

                <!-- Email -->
                <div class="form-floating mb-3">
                  <input 
                    type="email" 
                    class="form-control" 
                    id="email" 
                    name="email" 
                    value="johndoe@example.com" 
                    placeholder="Email" 
                    required>
                  <label for="email">Email</label>
                  <div class="invalid-feedback">Please provide a valid email address.</div>
                </div>

                <!-- Contact Number -->
                <div class="form-floating mb-3">
                  <input 
                    type="tel" 
                    class="form-control" 
                    id="contactNumber" 
                    name="contact_number" 
                    value="+1234567890" 
                    placeholder="Contact Number" 
                    required>
                  <label for="contactNumber">Contact Number</label>
                  <div class="invalid-feedback">Please provide a valid contact number.</div>
                </div>

                <!-- Address -->
                <div class="form-floating mb-3">
                  <textarea 
                    class="form-control" 
                    id="address" 
                    name="address" 
                    placeholder="Address" 
                    style="height: 100px;" 
                    required>123 Green Haven Street, Memorial City</textarea>
                  <label for="address">Address</label>
                  <div class="invalid-feedback">Please provide your address.</div>
                </div>

                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-save me-2"></i>Save Changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Account Security -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-shield-lock me-2"></i>Account Security</h5>
              <form action="update-password.php" method="POST" class="needs-validation" novalidate>
                <!-- Current Password -->
                <div class="form-floating mb-3">
                  <input 
                    type="password" 
                    class="form-control" 
                    id="currentPassword" 
                    name="current_password" 
                    placeholder="Current Password" 
                    required>
                  <label for="currentPassword">Current Password</label>
                  <div class="invalid-feedback">Please enter your current password.</div>
                </div>

                <!-- New Password -->
                <div class="form-floating mb-3">
                  <input 
                    type="password" 
                    class="form-control" 
                    id="newPassword" 
                    name="new_password" 
                    placeholder="New Password" 
                    required>
                  <label for="newPassword">New Password</label>
                  <div class="invalid-feedback">Please provide a new password.</div>
                </div>

                <!-- Confirm New Password -->
                <div class="form-floating mb-3">
                  <input 
                    type="password" 
                    class="form-control" 
                    id="confirmPassword" 
                    name="confirm_password" 
                    placeholder="Confirm New Password" 
                    required>
                  <label for="confirmPassword">Confirm New Password</label>
                  <div class="invalid-feedback">Passwords do not match.</div>
                </div>

                <div class="d-grid gap-2">
                  <button type="submit" class="btn btn-success btn-lg">
                    <i class="bi bi-key me-2"></i>Update Password
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <!-- Additional Links -->
      <div class="row">
        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
              <div>
                <h5 class="card-title"><i class="bi bi-gear me-2"></i>Manage Preferences</h5>
                <p class="card-text">Update notification and privacy settings.</p>
              </div>
              <a href="settings.php" class="btn btn-outline-primary">
                <i class="bi bi-pencil-square me-2"></i>Manage Preferences
              </a>
            </div>
          </div>
        </div>
      </div>
    </main>

  </div>
</div>
<script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
