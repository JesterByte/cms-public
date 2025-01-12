<?php 
    require_once "../utils/helpers.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $pageTitle = "Home";
        include_once "../components/head.php";
    ?>
</head>
<body>
    <?php 
        include_once "../components/theme.html"; 
        include_once "../components/navbar.php";
    ?>

    <main>
        <!-- Hero Section -->
        <div class="hero rounded text-white text-center d-flex flex-column justify-content-center align-items-center" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../assets/img/ghmp_aerial_view.png') no-repeat center center / cover; height: 60vh;">
            <img class="mb-4 img-fluid" src="../assets/brand/green_haven_memorial_park_logo.png" alt="Green Haven Logo" width="300">
            <h1 class="display-4 fw-bold">Discover Green Haven Memorial Park</h1>
            <p class="lead">A serene resting place to honor the memory of your loved ones.</p>
        </div>

        <div class="container mt-5">
            <!-- Announcements Section -->
            <section id="announcements" class="mt-5">
                <h2 class="text-center mb-4">Announcements</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Upcoming Memorial Service</h5>
                                <p class="card-text">Join us for a special memorial service on November 15th at 10:00 AM in the main chapel. All are welcome.</p>
                                <p class="card-text text-muted">Posted on October 25, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Community Clean-Up Day</h5>
                                <p class="card-text">Join us on December 5th at 9:00 AM to help keep our park beautiful. Refreshments will be provided.</p>
                                <p class="card-text text-muted">Posted on November 10, 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Business Services Section -->
            <section id="business-services" class="mt-5">
                <h2 class="text-center mb-4">Our Services</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-umbrella-fill text-primary fs-1"></i>
                                </div>
                                <h5 class="card-title">Burial Services</h5>
                                <p class="card-text">Providing dignified burial services.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-people-fill text-success fs-1"></i>
                                </div>
                                <h5 class="card-title">Memorial Services</h5>
                                <p class="card-text">Honoring the memory of your loved ones.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-map-fill text-warning fs-1"></i>
                                </div>
                                <h5 class="card-title">Plot Reservations</h5>
                                <p class="card-text">Reserve a plot for future needs.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Website Features Section -->
            <section id="website-features" class="mt-5">
                <h2 class="text-center mb-4">What You Can Do Online</h2>
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-search text-info fs-1"></i>
                                </div>
                                <h5 class="card-title">Search Plot Availability</h5>
                                <p class="card-text">Find available lots easily with our online search tool.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-pencil-square text-secondary fs-1"></i>
                                </div>
                                <h5 class="card-title">Reserve Lots</h5>
                                <p class="card-text">Secure your lot reservation online.</p>
                                <!-- Sign Up Reminder -->
                                <p class="text-muted mt-2"><strong>Note:</strong> You must <a href="../sign-up/" class="text-decoration-underline">sign up</a> to reserve a lot.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-center">
                            <div class="card-body">
                                <div class="mb-3">
                                    <i class="bi bi-credit-card text-danger fs-1"></i>
                                </div>
                                <h5 class="card-title">Make Payments</h5>
                                <p class="card-text">Pay for your chosen lot securely through our website.</p>
                                <!-- Sign Up Reminder -->
                                <p class="text-muted mt-2"><strong>Note:</strong> You must <a href="../sign-up/" class="text-decoration-underline">sign up</a> to make a payment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>      

            <!-- Contact Section -->
            <section id="contact" class="mt-5">
                <h2 class="text-center mb-4">Contact Us</h2>
                <div class="text-center">
                    <p>For more information, please <a href="../contact-us/" class="text-decoration-underline">contact us</a>.</p>
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe class="rounded embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2309.6913888265135!2d120.97563774232235!3d14.87118729820643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397abf61bed6905%3A0x803cc12c18f09187!2sGreen%20Haven%20Memorial%20Park!5e1!3m2!1sen!2sph!4v1736360517204!5m2!1sen!2sph" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
