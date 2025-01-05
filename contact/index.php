<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php include_once "head.html"; ?>
  </head>
  <body>
    <?php 
      include_once "theme.html"; 
      include_once "navbar.php";
    ?>
    
    <main>
      <div class="container py-5">
        <h1 class="display-4 text-center mb-4 py-3">Contact Us</h1>  `

        <!-- Contact Form -->
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h2>Get in Touch</h2>
            <p class="lead">Have a question or need assistance? Fill out the form below, and our team will get back to you as soon as possible.</p>
            <form action="submit-contact.php" class="needs-validation" novalidate method="POST">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                <label for="name" class="form-label">Full Name</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
                <label for="email" class="form-label">Email Address</label>
              </div>
              <div class="form-floating mb-3">
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="Message"  required></textarea>
                <label for="message" class="form-label">Message</label>
              </div>
              <button type="submit" class="btn btn-success" name="submit_button">Send Message</button>
            </form>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="row mt-5">
          <div class="col-md-6">
            <h2>Our Contact Information</h2>
            <p>If you prefer to reach out to us directly, you can contact us via the following methods:</p>
            <ul>
              <li><strong>Phone:</strong> +63933-816-3494</li>
              <li><strong>Email:</strong> <a href="mailto:greenhaven.memorialpark@gmail.com">greenhaven.memorialpark@gmail.com</a></li>
              <li><strong>Address:</strong> Mag-asawang Sapa Rd, Santa Maria, Bulacan</li>
            </ul>
          </div>

          <!-- Map Section (Optional, replace with your actual map integration) -->
          <div class="col-md-6">
            <h2>Visit Us</h2>
            <p>Come see us in person at our beautiful park. Below is a map showing our location:</p>
            <!-- You can replace this with an actual Google Map iframe or another map solution -->
            <iframe class="rounded ratio ratio-4x3" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2746.7068914409665!2d120.9753648933331!3d14.870758502843174!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397abf61bed6905%3A0x803cc12c18f09187!2sGreen%20Haven%20Memorial%20Park!5e1!3m2!1sen!2sph!4v1735977766901!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>          
          </div>
        </div>

      </div>
    </main>

    <?php include_once "footer.html"; ?>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (() => {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
      })()
    </script>
  </body>
  
  <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
</html>
