<?php 
  session_start();
  require_once "../utils/autoload.php";
  autoloadUtils(__DIR__ . "/../utils");
  require_once "../content/payment-options.php";

  if (!isset($_SESSION["customer_id"])) {
    serverRedirect("../");
  }
?>

<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <?php 
      $pageTitle = "Payment Options";
      include_once "../components/dashboard-head.php";   
    ?>
  </head>
  <body>
    <?php 
      include_once "../components/theme.html"; 
      include_once "../components/symbols.html";
      include_once "../components/dashboard-navbar.html";
    ?>
    
    <div class="container-fluid">
      <div class="row">
        <?php include_once "../components/sidebar.php"; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Payment Options</h1>
          </div>

          <div class="row">
            <div class="col d-flex justify-content-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../my-reservations">My Reservations</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Payment Options</li>
                </ol>
              </nav>
            </div>
          </div>

          <div class="card shadow rounded mb-4">
            <div class="card-body">
              <h4 class="card-title">Payment Options for <?= displayPhaseLocation($paymentOptionsRow["reserved_lot"]); ?></h4>
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Lot Type: <strong><?= $paymentOptionsRow["lot_type"] ?></strong></li>
                <li class="list-group-item">Number of Lot(s): <strong><?= $paymentOptionsRow["number_of_lots"] ?></strong></li>
                <li class="list-group-item">Lot Price (Base Price per Lot): <strong><?= formatToPeso($paymentOptionsRow["lot_price"]) ?></strong></li>
                <li class="list-group-item">Total Purchase Price (VAT & Miscellaneous Fees Included): <strong><?= formatToPeso($paymentOptionsRow["total_purchase_price"]) ?></strong></li>
              </ul>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="card shadow rounded mb-4">
                <div class="card-body">
                  <h5 class="card-title">Option 1: Cash Sale</h5>
                  <p>10% Discount</p>
                  <p><strong>Amount Payable:</strong> <?= formatToPeso($paymentOptionsRow["cash_sale_10_discount"]) ?></p>
                  <button class="btn btn-primary payment-btn" type="button" data-bs-toggle="modal" data-bs-target="#paymentOptionModal"
                          data-payment-option="Cash Sale: 10% Discount"
                          data-amount-payable="<?= formatToPeso($paymentOptionsRow["cash_sale_10_discount"]) ?>">
                    Choose This Option
                  </button>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card shadow rounded mb-4">
                <div class="card-body">
                  <h5 class="card-title">Option 2: 6 Months</h5>
                  <p>5% Discount</p>
                  <p><strong>Amount Payable:</strong> <?= formatToPeso($paymentOptionsRow["6_months_5_discount"]) ?></p>
                  <button class="btn btn-primary payment-btn" type="button" data-bs-toggle="modal" data-bs-target="#paymentOptionModal"
                          data-payment-option="6 Months: 5% Discount"
                          data-amount-payable="<?= formatToPeso($paymentOptionsRow["6_months_5_discount"]) ?>">
                    Choose This Option
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div class="card shadow rounded mb-4">
            <div class="card-body">
              <h5 class="card-title">Option 3: Installment</h5>
              <p><strong>Down Payment (20% of Total Purchase Price):</strong> <?= formatToPeso($paymentOptionsRow["down_payment_20"]) ?></p>

              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>Duration</th>
                      <th>Interest</th>
                      <th>Amount Payable</th>
                      <th>Monthly Payment</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $durations = [1, 2, 3, 4, 5];
                      $interests = [0, 0.10, 0.15, 0.20, 0.25];
                      $monthlyPayments = [$paymentOptionsRow["monthly_amortization_1yr"], $paymentOptionsRow["monthly_amortization_2yrs_10_interest"], $paymentOptionsRow["monthly_amortization_3yrs_15_interest"], $paymentOptionsRow["monthly_amortization_4yrs_20_interest"], $paymentOptionsRow["monthly_amortization_5yrs_25_interest"]];

                      foreach ($durations as $key => $duration) {
                        $interest = $interests[$key];
                        $monthlyPayment = $monthlyPayments[$key];
                        $amountPayable = $paymentOptionsRow["balance"] * (1 + $interest);
                        $monthlyPayment = $amountPayable / ($duration * 12);

                        if ($duration == 1) {
                          $durationYears = "$duration Year";
                          $paymentOption = "Installment: $duration Year (" . ($interest * 100) . "% Interest)";
                        } else {
                          $durationYears = "$duration Years";
                          $paymentOption = "Installment: $duration Years (" . ($interest * 100) . "% Interest)";
                        }
                        
                        echo "<tr>
                                <td>$durationYears</td>
                                <td>" . ($interest * 100) . "%</td>
                                <td>" . formatToPeso ($amountPayable) . "</td>
                                <td>" . formatToPeso($monthlyPayment) . "</td>
                                <td>
                                  <button class=\"btn btn-primary payment-btn\" type=\"button\" data-bs-toggle=\"modal\" data-bs-target=\"#paymentOptionModal\"
                                          data-payment-option=\"$paymentOption\"
                                          data-amount-payable=\"" . formatToPeso($monthlyPayment) . "\">
                                    Choose This Option
                                  </button>
                                </td>
                              </tr>";
                      }
                    ?>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <?php 
      include_once "../components/modals/modal-sign-out.html"; 
      include_once "../components/modals/modal-confirmation-payment-option.php";
    ?>

  </body>
</html>
