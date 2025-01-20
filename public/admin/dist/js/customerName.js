document.getElementById('customer_id').addEventListener('change', function () {
  const customerId = this.value;
  const fetchUrl = this.dataset.fetchUrl;
  const csrfToken = this.dataset.csrf;

  if (customerId) {
    fetch(fetchUrl, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-CSRF-TOKEN": csrfToken
      },
      body: JSON.stringify({ customer_id: customerId })
    })
      .then(response => response.json())
      .then(data => {
        if (data) {
          document.getElementById('customerDetails').style.display = 'block';
          document.getElementById('customerName').textContent = data.name || 'N/A';
          document.getElementById('customerEmail').textContent = data.email || 'N/A';
          document.getElementById('customerPhone').textContent = data.phone || 'N/A';
          document.getElementById('customerAddress').textContent = data.address || 'N/A';
        }
      })
      .catch(error => console.error('Error:', error));
  } else {
    document.getElementById('customerDetails').style.display = 'none';
  }
});
