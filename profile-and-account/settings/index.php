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
        <h1 class="h2">Settings</h1>
      </div>

      <div class="row">
        <!-- Notifications Settings -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-bell-fill me-2"></i>Notification Preferences</h5>
              <form action="update-notifications.php" method="POST">
                <div class="form-check form-switch mb-3">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="emailNotifications" 
                    name="email_notifications" 
                    checked>
                  <label class="form-check-label" for="emailNotifications">
                    Receive Email Notifications
                  </label>
                </div>
                <div class="form-check form-switch mb-3">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="smsNotifications" 
                    name="sms_notifications">
                  <label class="form-check-label" for="smsNotifications">
                    Receive SMS Notifications
                  </label>
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

        <!-- Privacy Settings -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-shield-lock-fill me-2"></i>Privacy Settings</h5>
              <form action="update-privacy.php" method="POST">
                <div class="form-check mb-3">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="showProfilePublic" 
                    name="profile_public" 
                    checked>
                  <label class="form-check-label" for="showProfilePublic">
                    Make My Profile Public
                  </label>
                </div>
                <div class="form-check mb-3">
                  <input 
                    class="form-check-input" 
                    type="checkbox" 
                    id="showActivities" 
                    name="show_activities">
                  <label class="form-check-label" for="showActivities">
                    Allow Others to See My Activities
                  </label>
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
      </div>

      <div class="row">
        <!-- Account Settings -->
        <div class="col-md-12">
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <h5 class="card-title"><i class="bi bi-gear-fill me-2"></i>Account Customization</h5>
              <form action="update-account-settings.php" method="POST">
                <!-- Theme Selection -->
                <div class="mb-3">
                  <label for="themeSelection" class="form-label">Preferred Theme</label>
                  <select class="form-select" id="themeSelection" name="theme">
                    <option value="light" selected>Light</option>
                    <option value="dark">Dark</option>
                    <option value="auto">Auto</option>
                  </select>
                </div>
                <!-- Language Selection -->
                <div class="mb-3">
                  <label for="languageSelection" class="form-label">Preferred Language</label>
                  <select class="form-select" id="languageSelection" name="language">
                    <option value="en" selected>English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                  </select>
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
      </div>
    </main>
  </div>
</div>
<script src="../../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
