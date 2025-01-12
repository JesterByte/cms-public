<?php 
    require_once "../utils/helpers.php"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $pageTitle = "Contact Us";
        include_once "../components/head.php";
    ?>
</head>
<body>
    <?php 
        include_once "../components/theme.html"; 
        include_once "../components/navbar.php";
    ?>

    <main class="container mt-5">
        <h1 class="text-center mb-4">Contact Us</h1>
        <p class="text-center mb-5">If you have any questions or need further information, please feel free to contact us. We are here to help you.</p>
        
        <div class="row">
            <div class="col-md-6">
                <h2>Contact Information</h2>
                <p><strong>Address:</strong> VXCG+FJF, Magasawang Sapa Rd, Santa Maria, Bulacan
                </p>
                <p><strong>Phone:</strong> +63933-816-3494</p>
                <p><strong>Email:</strong> greenhaven.memorialpark@gmail.com</p>
                <p><strong>Office Hours:</strong> Monday - Saturday, 8:00 AM - 5:00 PM</p>
                <div class="ratio ratio-16x9 my-4">
                    <iframe class="rounded" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2309.6913888265135!2d120.97563774232235!3d14.87118729820643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397abf61bed6905%3A0x803cc12c18f09187!2sGreen%20Haven%20Memorial%20Park!5e1!3m2!1sen!2sph!4v1736360517204!5m2!1sen!2sph" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>           
                </div>
            </div>
            <div class="col-md-6">
                <h2>Contact Form</h2>
                <form action="submit-contact-form.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </main>

    <?php include_once "../components/footer.php"; ?>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>