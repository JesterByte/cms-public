document.getElementById('reservationNotes').addEventListener('input', function() {
  const remainingChars = 500 - this.value.length;
  document.getElementById('charCount').textContent = remainingChars + " characters remaining";
});
