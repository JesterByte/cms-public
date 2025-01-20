<nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
      <a class="navbar-brand col-lg-3 me-0" href="#">Green Haven Memorial Park</a>
      <ul class="navbar-nav col-lg-6 justify-content-lg-center">
        <li class="nav-item">
          <a class="nav-link <?= isActivePage($pageTitle, "Home") ?>" <?= isAriaCurrentPage($pageTitle, "Home") ?> href="../home/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActivePage($pageTitle, "Lot Locator") ?>" <?= isAriaCurrentPage($pageTitle, "Lot Locator") ?> href="../lot-locator/">Lot Locator</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActivePage($pageTitle, "About Us") ?>" <?= isAriaCurrentPage($pageTitle, "About Us") ?> href="../about-us/">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= isActivePage($pageTitle, "Contact Us") ?>" <?= isAriaCurrentPage($pageTitle, "Contact Us") ?> href="../contact-us/">Contact Us</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
      </ul>
      <div class="d-lg-flex col-lg-3 justify-content-lg-end">
          <a href="../sign-in/" class="btn me-1">Sign in</a>
          <a href="../sign-up/" class="btn btn-primary">Sign up for free</a>
      </div>
    </div>
  </div>
</nav>
