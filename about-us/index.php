<?php 
    require_once "../utils/helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $pageTitle = "About Us";
        include_once "../components/head.php";
    ?>
</head>
<body>
    <?php 
        include_once "../components/theme.html"; 
        include_once "../components/navbar.php";
    ?>

    <main class="container mt-5">
        <h1 class="text-center mb-4">About Us</h1>
        
        <section id="history" class="mb-5 text-bg-secondary p-4 rounded shadow-sm">
            <h2>Our History</h2>
            <p>Green Haven Memorial Park was established in [Year] with the mission to provide a serene and respectful resting place for loved ones. Over the years, we have grown to become a trusted name in the community, known for our compassionate services and beautiful grounds.</p>
        </section>

        <section id="mission-vision" class="mb-5">
            <h2>Mission & Vision</h2>
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>Mission:</strong></h4>
                    <p>Our mission is to offer dignified and compassionate funeral services, ensuring that every family receives the support and care they need during their time of loss.</p>
                </div>
                <div class="col-md-6">
                    <h4><strong>Vision:</strong></h4>
                    <p>Our vision is to be the leading memorial park in the region, known for our exceptional services, beautiful grounds, and commitment to the community.</p>
                </div>
            </div>
        </section>

        <section id="staff" class="mb-5">
            <h2>Meet Our Team</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <img src="../assets/img/staff-male.png" class="card-img-top" alt="Staff Member 1">
                        <div class="card-body">
                            <h5 class="card-title">John Doe</h5>
                            <p class="card-text">John is the founder and director of Green Haven Memorial Park. With over 20 years of experience in the funeral services industry, he is dedicated to providing compassionate care to every family.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <img src="../assets/img/staff-female.png" class="card-img-top" alt="Staff Member 2">
                        <div class="card-body">
                            <h5 class="card-title">Jane Smith</h5>
                            <p class="card-text">Jane is our lead funeral director. She has a background in grief counseling and is committed to supporting families through every step of the funeral planning process.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3 shadow-sm">
                        <img src="../assets/img/staff-male-2.png" class="card-img-top" alt="Staff Member 3">
                        <div class="card-body">
                            <h5 class="card-title">Michael Johnson</h5>
                            <p class="card-text">Michael is our groundskeeper. He takes great pride in maintaining the beauty and tranquility of Green Haven Memorial Park, ensuring that it remains a peaceful place for reflection.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Optional Testimonial Section -->
        <section id="testimonials" class="mb-5 bg-light p-4 rounded shadow-sm">
            <h2>What Our Families Say</h2>
            <div class="row">
                <div class="col-md-6">
                    <blockquote class="blockquote">
                        <p class="mb-0">"The team at Green Haven made an incredibly difficult time easier. Their care, attention to detail, and respect were truly comforting." – Sarah L.</p>
                    </blockquote>
                </div>
                <div class="col-md-6">
                    <blockquote class="blockquote">
                        <p class="mb-0">"The grounds are beautiful, and we felt so supported throughout the entire process. Thank you, Green Haven." – The Mendoza Family</p>
                    </blockquote>
                </div>
            </div>
        </section>

        <section id="contact" class="text-center mb-5">
            <h3>Get In Touch</h3>
            <p>If you have any questions or would like to learn more about our services, feel free to <a href="../contact-us">contact us</a>.</p>
        </section>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
