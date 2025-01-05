<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Green Haven Memorial Park</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="../../dashboard/">
            <i class="bi bi-house-fill"></i>
            Dashboard
          </a>
        </li>
      </ul>

      <hr class="my-3">

      <!-- Profile & Account -->
      <div class="accordion" id="profileAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="profileHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profileCollapse" aria-expanded="false" aria-controls="profileCollapse">
              <i class="bi bi-person-circle me-2"></i> Profile & Account
            </button>
          </h2>
          <div id="profileCollapse" class="accordion-collapse collapse" aria-labelledby="profileHeading" data-bs-parent="#profileAccordion">
            <div class="accordion-body">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../../profile-and-account/my-profile/">
                    <i class="bi bi-person"></i> My Profile
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../../profile-and-account/settings/">
                    <i class="bi bi-gear"></i> Settings
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <!-- Grave Management -->
      <div class="accordion" id="graveAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="graveHeading">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#graveCollapse" aria-expanded="true" aria-controls="graveCollapse">
              <i class="bi bi-map me-2"></i> Grave Management
            </button>
          </h2>
          <div id="graveCollapse" class="accordion-collapse collapse show" aria-labelledby="graveHeading" data-bs-parent="#graveAccordion">
            <div class="accordion-body">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-pin-map"></i> Grave Locator
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../my-reservations/">
                    <i class="bi bi-calendar-check"></i> My Reservations
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../maintenance-requests/">
                    <i class="bi bi-tools"></i> Maintenance Requests
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <!-- Payments -->
      <div class="accordion" id="paymentsAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="paymentsHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#paymentsCollapse" aria-expanded="false" aria-controls="paymentsCollapse">
              <i class="bi bi-credit-card me-2"></i> Payments
            </button>
          </h2>
          <div id="paymentsCollapse" class="accordion-collapse collapse" aria-labelledby="paymentsHeading" data-bs-parent="#paymentsAccordion">
            <div class="accordion-body">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../../payments/payment-history/">
                    <i class="bi bi-receipt"></i> Payment History
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="../../payments/upload-payment-proof/">
                    <i class="bi bi-upload"></i> Upload Payment Proof
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <!-- Support & Communication -->
      <div class="accordion" id="supportAccordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="supportHeading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#supportCollapse" aria-expanded="false" aria-controls="supportCollapse">
              <i class="bi bi-chat-dots me-2"></i> Support & Communication
            </button>
          </h2>
          <div id="supportCollapse" class="accordion-collapse collapse" aria-labelledby="supportHeading" data-bs-parent="#supportAccordion">
            <div class="accordion-body">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-bell"></i> Notifications
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-question-circle"></i> FAQs
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-megaphone"></i> Announcements
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-envelope"></i> Contact Support
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-3">

      <!-- Logout -->
      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <i class="bi bi-box-arrow-right"></i> Log Out
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>
