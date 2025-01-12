<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Green Haven Memorial Park</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Dashboard") ?>" aria-current="page" href="../dashboard/">
            <i class="bi bi-house<?= fillIcon($pageTitle, "Dashboard") ?>"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Plot Locator") ?>" aria-current="page" href="../dashboard-plot-locator/">
            <i class="bi bi-search"></i> Plot Locator
          </a>
        </li>
        <?php $reservationsList = ["My Reservations", "Lot Reservation", "Burial Reservation"]; ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reservationsSubmenu" role="button" aria-expanded="<?= isPageTitleInList($pageTitle, $reservationsList) ? "true" : "false"; ?>" aria-controls="reservationsSubmenu">
            <i class="bi bi-calendar-check<?= isPageTitleInList($pageTitle, $reservationsList) ? "-fill" : ""; ?>"></i> Reservation <i class="bi bi-caret-down<?= isPageTitleInList($pageTitle, $reservationsList) ? "-fill" : ""; ?>"></i>
          </a>
          <div class="collapse <?= isPageTitleInList($pageTitle, $reservationsList) ? "show" : ""; ?>" id="reservationsSubmenu">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="../my-reservations" class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "My Reservations") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "My Reservations") ?>"></i> My Reservations</a></li>
              <li><a href="../reservation-lot" class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Lot Reservation") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Lot Reservation") ?>"></i> Lot Reservation</a></li>
              <li><a href="../reservation-burial" class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Burial Reservation") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Burial Reservation") ?>"></i> Burial Reservation</a></li>
            </ul>
          </div>
        </li>
        <?php $myFinancesList = ["Balances", "Payments"]; ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#myFinancesSubmenu" role="button" aria-expanded="<?= isPageTitleInList($pageTitle, $myFinancesList) ? "true" : "false"; ?>" aria-controls="myFinancesSubmenu">
            <i class="bi bi-credit-card<?= isPageTitleInList($pageTitle, $myFinancesList) ? "-fill" : ""; ?>"></i> My Finances <i class="bi bi-caret-down<?= isPageTitleInList($pageTitle, $myFinancesList) ? "-fill" : ""; ?>"></i>
          </a>
          <div class="collapse <?= isPageTitleInList($pageTitle, $myFinancesList) ? "show" : ""; ?>" id="myFinancesSubmenu">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                <li><a href="../balances/" class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Balances") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Balances") ?>"></i> Balances</a></li>
              <li><a href="../payments" class="nav-link d-flex align-items-center gap-2 <?= isActiveSidebarPage($pageTitle, "Payments") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Payments") ?>"></i> Payments</a></li>
            </ul>
          </div>
        </li>
        
      <hr class="my-3">
      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
            Settings
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="modal" data-bs-target="#signOutModal">
            <svg class="bi"><use xlink:href="#door-closed"/></svg>
            Sign out
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>