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
      <h1 class="display-4 text-center mb-4">Sign Up</h1>
      <p class="lead text-center mb-5">Create your account by filling out the form below.</p>

      <div class="row justify-content-center">
        <div class="col-md-6">
          <form action="submit-signup.php" class="needs-validation" novalidate method="POST">
            <!-- Username Input -->
            <div class="form-floating mb-3">
              <input 
                type="text" 
                class="form-control" 
                id="username" 
                name="username" 
                placeholder="Username" 
                pattern="^[a-zA-Z0-9_-]{3,20}$" 
                title="Username must be 3-20 characters long and can only include letters, numbers, underscores, and hyphens." 
                required>
              <label for="username">Username</label>
              <div class="invalid-feedback">Please provide a valid username (3-20 characters, only letters, numbers, underscores, and hyphens).</div>
            </div>

            <!-- Email Input -->
            <div class="form-floating mb-3">
              <input 
                type="email" 
                class="form-control" 
                id="email" 
                name="email" 
                placeholder="Email Address" 
                required>
              <label for="email">Email Address</label>
              <div class="invalid-feedback">Please provide a valid email address.</div>
            </div>

            <!-- Password Input -->
            <div class="form-floating mb-3">
              <input 
                type="password" 
                class="form-control" 
                id="password" 
                name="password" 
                placeholder="Password" 
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                title="Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number." 
                required>
              <label for="password">Password</label>
              <div class="invalid-feedback">Password must be at least 8 characters long and include an uppercase letter, a lowercase letter, and a number.</div>
            </div>

            <!-- Confirm Password Input -->
            <div class="form-floating mb-3">
              <input 
                type="password" 
                class="form-control" 
                id="confirm-password" 
                name="confirm_password" 
                placeholder="Confirm Password" 
                required>
              <label for="confirm-password">Confirm Password</label>
              <div class="invalid-feedback">Passwords must match.</div>
            </div>

            <!-- Submit Button -->
            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-success btn-lg" name="submit_button">Sign Up</button>
            </div>
          </form>

          <!-- Option for users who already have an account -->
          <div class="text-center mt-3">
            <p>Already have an account? <a href="../login/">Log in here</a></p>
          </div>
        </div>
      </div>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <script src="form-validation.js"></script>
  </body>
</html>
