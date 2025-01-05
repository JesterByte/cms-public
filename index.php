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

  <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <img class="" src="assets/img/ghmp_sky_view.png" height="100%" width="100%" alt="Sky view at the Green Haven Memorial Park" aria-label="Sky view at the Green Haven Memorial Park">      
        <div class="container">
          <div class="carousel-caption text-start">
            <h1 class="">Discover Green Haven Memorial Park</h1>
            <p class="opacity-75 ">Take a serene aerial view of Green Haven Memorial Park and explore its beautiful layout, offering peace and harmony.</p>
            <p><a class="btn btn-lg btn-success" href="#">Learn More</a></p>          
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <img class="" src="assets/img/ghmp_aerial_view.png" height="100%" width="100%" alt="Aerial view of the Green Haven Memorial Park" aria-label="Aerial view of the Green Haven Memorial Park">      
        <div class="container">
          <div class="carousel-caption">
            <h1 class="">Interactive Cemetery Map</h1>
            <p class="">Get a detailed view of Green Haven Memorial Park's layout with our interactive map. Easily locate graves, available plots, and reserved spaces.</p>
            <p><a class="btn btn-lg btn-success" href="#">Explore the Map</a></p>          
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <!-- <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
        <img class="" src="assets/img/ghmp_street_view.png" height="100%" width="100%" alt="Street view at the Green Haven Memorial Park" aria-label="Street view at the Green Haven Memorial Park">      
        <div class="container">
          <div class="carousel-caption text-end">
            <h1 class="">Seamless Payment Verification</h1>
            <p class="">Upload proof of payment and manage your cemetery records with ease. Quick and secure payment verification made simple.</p>
            <p><a class="btn btn-lg btn-success" href="#">View More</a></p>          
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

  <!-- Three columns of text below the carousel -->
  <div class="row">
    <div class="col-lg-4">
      <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
      <img src="assets/img/map.png" height="140" width="140" alt="A map icon" aria-label="A map icon">      
      <h2 class="fw-normal">Explore Cemetery Map</h2>
      <p>Discover the layout of the cemetery and view lot statuses, including available and reserved plots.</p>
      <p><a class="btn btn-success" href="services/map/">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
      <img src="assets/img/cash-payment.png" height="140" width="140" alt="A cash payment icon" aria-label="A cash payment icon">      
      <h2 class="fw-normal">Manage Payments</h2>
      <p>Upload proof of payments or verify payment records associated with cemetery plots.</p>
      <p><a class="btn btn-success" href="services/payment/">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <!-- <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg> -->
      <img src="assets/img/reservation.png" height="140" width="140" alt="A cash payment icon" aria-label="A reserve icon">      
      <h2 class="fw-normal">Make a Reservation</h2>
      <p>Reserve a plot for a loved one or yourself, and ensure a spot is available when needed.</p>
      <p><a class="btn btn-success" href="services/reservation/">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->



    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Explore Cemetery Map. <span class="text-body-secondary">Your guide to navigating Green Haven Memorial Park.</span></h2>
        <p class="lead">Navigate through Green Haven Memorial Park with our interactive map. Quickly locate available plots, reserved spaces, and specific graves of your loved ones. Use zoom and section filters for an easy, detailed view to ensure you find your way around effortlessly.</p>
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
        <img class="img-fluid" src="assets/img/street-map.png" height="500" width="500" alt="Aerial view of the Green Haven Memorial Park" aria-label="Aerial view of the Green Haven Memorial Park">      
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 order-md-2">
        <h2 class="featurette-heading fw-normal lh-1">Find Your Loved Ones with Ease. <span class="text-body-secondary">Search for specific graves in a flash.</span></h2>
        <p class="lead">Looking for a loved one’s resting place? Our advanced search feature allows you to quickly locate graves by name, section, or even specific plot. Just type in the details, and let the system guide you to the exact location with pinpoint accuracy.</p>      
      </div>
      <div class="col-md-5 order-md-1">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
        <img class="img-fluid" src="assets/img/funeral.png" height="500" width="500" alt="Aerial view of the Green Haven Memorial Park" aria-label="Aerial view of the Green Haven Memorial Park">      

      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading fw-normal lh-1">Submit and Verify Payments Online. <span class="text-body-secondary">Convenient and secure payment verification made easy.</span></h2>
        <p class="lead">Handle all payment verifications online. Upload proof of payment directly through the system for a seamless process. Whether for plot reservations or maintenance fees, quickly upload your receipts, and let our system validate them so you can focus on what matters most.</p>      
      </div>
      <div class="col-md-5">
        <!-- <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-bg)"/><text x="50%" y="50%" fill="var(--bs-secondary-color)" dy=".3em">500x500</text></svg> -->
        <img class="img-fluid" src="assets/img/credit-card.png" height="500" width="500" alt="Aerial view of the Green Haven Memorial Park" aria-label="Aerial view of the Green Haven Memorial Park">      
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


  <?php include_once "footer.html"; ?>
</main>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>

    </body>
</html>
