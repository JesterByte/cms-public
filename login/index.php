<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
  </head>
  <body>
    <?php 
      include_once "theme.html"; 
    ?>

    <main class="container mt-3 border py-3 rounded shadow">
      <a href="../" class="btn shadow"><i class="bi bi-arrow-left"></i></a>
      <div class="text-center">
        <img class="img-fluid" src="../assets/brand/green_haven_memorial_park_logo.png" alt="Logo" width="500" height="250">
      </div>
      <h1 class="display-4 text-center mb-4">Login</h1>
      <p class="lead text-center mb-5">Please enter your username and password to access your account.</p>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <form action="submit-login.php" class="needs-validation" novalidate method="POST">
            <!-- Username Input -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="username" name="username" pattern="^[a-zA-Z][a-zA-Z0-9._]{2,19}$" title="3–20 characters, starts with a letter, allows letters, numbers, dots, and underscores" placeholder="Username" required>
              <label for="username">Username</label>
            </div>

            <!-- Password Input -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password" minlength="8" maxlength="64" 
              pattern="(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,64}" 
              title="Must contain at least 8 characters, including uppercase, lowercase, a number, and a special character" name="password" placeholder="Password" required>
              <label for="password">Password</label>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg" name="submit_button">Login</button>
            </div>
          </form>

          <!-- Options for users -->
          <div class="text-center mt-3">
            <a href="../forgot-password/">Forgot your password?</a>
          </div>
          <div class="text-center mt-2">
            <p>No account yet? <a href="../signup/">Sign up here</a></p>
          </div>
        </div>
      </div>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="form-validation.js"></script>
  </body>
</html>
