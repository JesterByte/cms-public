document.getElementById('phone').addEventListener('focus', function(e) {
    if (e.target.value === '') {
      e.target.value = '+639'; // Automatically add +639 when the user focuses on the input field
    }
  });

  document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove any non-numeric characters
    
    // Ensure the number starts with +639 and limit input length to 13 characters
    if (value.length <= 3) {
      e.target.value = '+639' + value.slice(3);
    } else {
      let formatted = '+639' + value.slice(3, 5); // The +639 stays fixed
      if (value.length > 5) {
        formatted += '-' + value.slice(5, 8); // Add hyphen after the 5th digit
      }
      if (value.length > 8) {
        formatted += '-' + value.slice(8, 12); // Add hyphen after the 7th digit
      }
      e.target.value = formatted.slice(0, 15); // Limit the length to 13 characters (including hyphens)
    }
  });