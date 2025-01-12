<?php 
    require_once "../utils/helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $pageTitle = "Sign Up";
        include_once "../components/head.php";
    ?>
    <style>
        .form-signup {
            max-width: 500px;
            padding: 15px;
            margin: auto;
        }
        .form-signup .form-floating:focus-within {
            z-index: 2;
        }
        .form-signup input[type="text"],
        .form-signup input[type="email"],
        .form-signup input[type="password"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signup input[type="password"]:last-of-type {
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

    <main class="form-signup w-100 m-auto">
        <form class="needs-validation" novalidate>
            <div class="d-flex justify-content-center">
              <img class="img-fluid" src="../assets/brand/green_haven_memorial_park_logo.png" alt="" width="300" height="150">
            </div>
            <hr>
            <h1 class="h3 mb-3 fw-normal text-center">Please sign up</h1>

            <div class="row">
                <div class="col-md-6">
                    <p class="form-text">Personal Information</p>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingFirstName" placeholder="First Name" required>
                        <label for="floatingFirstName">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingMiddleName" placeholder="Middle Name (Optional)">
                        <label for="floatingMiddleName">Middle Name (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingLastName" placeholder="Last Name" required>
                        <label for="floatingLastName">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSuffix">
                            <option value=""></option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                        </select>
                        <label for="floatingSuffix">Suffix (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingContactNumber" placeholder="Contact Number" required>
                        <label for="floatingContactNumber">Contact Number</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="form-text">Signin Credentials</p>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Email Address" required>
                        <label for="floatingInput">Email Address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="Confirm Password" required>
                        <label for="floatingConfirmPassword">Confirm Password</label>
                    </div>
                </div>
            </div>

            <button class="btn btn-primary w-100 py-2" type="submit">Sign up</button>
            <small class="text-body-secondary">By clicking Sign up, you agree to the <a href="">terms of use</a>.</small>
        </form>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/form-validation.js"></script>
</body>
</html>