<?php 
    require_once "../utils/helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $pageTitle = "Sign In";
        include_once "../components/head.php";
    ?>
    <style>
        .form-signin {
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }
        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>
<body>
    <?php 
        include_once "../components/theme.html"; 
        include_once "../components/navbar.php";
    ?>

    <main class="form-signin w-100 m-auto">
        <form class="needs-validation" novalidate action="../process/process-sign-in.php" method="post">
            <div class="d-flex justify-content-center">
              <img class="img-fluid" src="../assets/brand/green_haven_memorial_park_logo.png" alt="" width="300" height="150">
            </div>
            <hr>
            <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>

            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="Email address" required>
                <label for="floatingInput">Email Address</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>

            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit" name="sign_in">Sign in</button>
        </form>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>
</html>