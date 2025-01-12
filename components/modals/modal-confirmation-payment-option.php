<!-- Modal HTML -->
<div class="modal fade" id="paymentOptionModal" tabindex="-1" aria-labelledby="paymentOptionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentOptionModalLabel">Confirm Payment Option</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p><strong>Payment Option for:</strong> <?= displayPhaseLocation($paymentOptionsRow["reserved_lot"]) ?></p>
        <p><strong>Lot Type:</strong> <?= $paymentOptionsRow["lot_type"] ?></p>
        <p><strong>Number of Lots:</strong> <?= $paymentOptionsRow["number_of_lots"] ?></p>
        <p><strong>Total Purchase Price:</strong> <?= formatToPeso($paymentOptionsRow["total_purchase_price"]) ?></p>
        <p><strong>Chosen Payment Option:</strong> <span id="chosenPaymentOption"></span></p>
        <p><strong>Amount Payable:</strong> <span id="amountPayable"></span></p>
        <!-- Add more details as needed -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="../process/process-payment-option.php" method="post">
          <input type="hidden" name="payment_option" id="inputPaymentOption" value="">
          <button type="submit" class="btn btn-primary" name="confirm_payment_option">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- <script>
  document.querySelectorAll('.payment-btn').forEach(button => {
    button.addEventListener('click', function () {
      const paymentOption = this.getAttribute('data-payment-option');
      const amountPayable = this.getAttribute('data-amount-payable');

      // Populate modal content
      document.getElementById('chosenPaymentOption').textContent = paymentOption;
      document.getElementById('amountPayable').textContent = amountPayable;

      // Show modal
      new bootstrap.Modal(document.getElementById('paymentOptionModal')).show();
    });
  });

  document.getElementById('confirmPaymentBtn').addEventListener('click', () => {
    alert('Payment confirmed!');
    // Add backend processing or navigation logic here
  });
</script> -->

<script>
  document.querySelectorAll('.payment-btn').forEach(button => {
    button.addEventListener('click', function () {
      const paymentOption = this.getAttribute('data-payment-option');
      const amountPayable = this.getAttribute('data-amount-payable');
      const downPayment = this.getAttribute('data-down-payment'); // Assuming down payment is provided in a data attribute.

      // Populate modal content
      document.getElementById('chosenPaymentOption').textContent = paymentOption;
      document.getElementById('amountPayable').textContent = amountPayable;
      document.getElementById("inputPaymentOption").value =paymentOption;

      // Add down payment information if "Installment" is in the payment option
      const modalBody = document.querySelector('#paymentOptionModal .modal-body');
      const existingDownPaymentTag = document.getElementById('downPaymentTag');

      if (paymentOption.includes('Installment')) {
        if (!existingDownPaymentTag) {
          // Create a new <p> tag for down payment
          const downPaymentTag = document.createElement('p');
          downPaymentTag.id = 'downPaymentTag';
          downPaymentTag.innerHTML = `<strong>Down Payment:</strong> <?= formatToPeso($paymentOptionsRow["down_payment_20"]) ?>`;
          modalBody.appendChild(downPaymentTag);
        } else {
          // Update the existing down payment tag
          existingDownPaymentTag.innerHTML = `<strong>Down Payment:</strong> <?= formatToPeso($paymentOptionsRow["down_payment_20"]) ?>`;
        }
      } else {
        // Remove down payment tag if it exists
        if (existingDownPaymentTag) {
          existingDownPaymentTag.remove();
        }
      }

      // Show modal
      new bootstrap.Modal(document.getElementById('paymentOptionModal')).show();
    });
  });

  // document.getElementById('confirmPaymentBtn').addEventListener('click', () => {
  //   alert('Payment confirmed!');
  //   // Add backend processing or navigation logic here
  // });
</script>
