function  fetchInvoiceNumber() {
  $.ajax({
    url: '/invoices/generate-number',
    type: 'GET',
    success: function (data) {
      $('#invoice_number').val(data.invoice_number);
    },
    error: function () {
      alert('Error generating invoice number');
    }
  });
}
$(document).ready(function () {
  fetchInvoiceNumber();
});
