/*$(document).ready(function() {
  $('#search-input').on('keyup', function() {
    let query = $(this).val();

    $.ajax({
      url: '/invoice/search',
      method: 'GET',
      data: { query: query },
      success: function(response) {
        let tableBody = $('#invoiceTable tbody');
        tableBody.empty();

        response.forEach(invoice => {
          tableBody.append(`
            <tr>
               <td>${invoice.invoice_number}</td>
               <td>${invoice.date}</td>

               <td>${invoice.total}</td>
               <td>${invoice.actions}</td>
            </tr>
          `);
        });
      }
    });
  });

});

$(document).ready(function() {
  function fetchInvoices(query = '', sortField = 'invoice_number') {
    $.ajax({
      url: '/invoice/search',
      method: 'GET',
      data: { query: query, sort_field: sortField,  sort_order: sortOrder },
      success: function(response) {
        let tableBody = $('#invoiceTable tbody');
        tableBody.empty();

        response.forEach(invoice => {
          tableBody.append(`
                        <tr>
                            <td>${invoice.invoice_number}</td>
                            <td>${invoice.date}</td>

                            <td>${invoice.total}</td>
                            <td>${invoice.actions}</td>
                        </tr>
                    `);
        });
      },
      error: function(xhr) {
        console.error(xhr.responseText);
        alert('An error occurred. Please try again.');
      }
    });
  }

  let sortField = 'invoice_number';
  //let sortOrder = 'asc';

  // Sort buttons
  $('#categoryFilter').on('change', function() {
    const [field, order] = $(this).val().split('-');
    sortField = field;
    sortOrder = order;
    fetchInvoices($('#search-input').val(), sortField, sortOrder);
  });

  $('#search-input').on('keyup', function() {
    fetchInvoices($(this).val(), sortField, sortOrder);
  });

  // Initial fetch
  fetchInvoices();
});

// Invoice list filtration
$(document).ready(function() {

  let sortField = 'invoice_number';
  let sortOrder = 'asc';
  function fetchInvoices(query = '', startDate = '', endDate = '', sortField = 'invoice_number', sortOrder = 'asc') {
    $.ajax({
      url: '/invoice/search',
      method: 'GET',
      data: {
        query: query,
        start_date: startDate,
        end_date: endDate,
        sort_field: sortField,
        sort_order: sortOrder
      },
      success: function(response) {
        let tableBody = $('#invoiceTable tbody');
        tableBody.empty();

        response.forEach(invoice => {
          tableBody.append(`
                        <tr>
                            <td>${invoice.invoice_number}</td>
                            <td>${invoice.date}</td>

                            <td>${invoice.total}</td>
                            <td>${invoice.actions}</td>
                        </tr>
                    `);
        });
      },
      error: function(xhr) {
        console.error(xhr.responseText);
        alert('An error occurred. Please try again.');
      }
    });
  }

  const today = new Date().toISOString().split('T')[0];
  $('#start-date').val(today);
  $('#end-date').val(today);


  // Handle date filter
  $('#filter-date').on('click', function() {
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();

    if (startDate && endDate && startDate > endDate) {
      alert('Start date cannot be later than the end date.');
      return;
    }
    fetchInvoices($('#search-input').val(), startDate, endDate, sortField, sortOrder);
  });

  // Handle search input filter
  $('#search-input').on('keyup', function() {
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();
    fetchInvoices($(this).val(), startDate, endDate, sortField, sortOrder);
  });

  $('#reset-filter').on('click', function() {
    $('#start-date').val('');
    $('#end-date').val('');
    $('#search-input').val('');
    fetchInvoices(); // Fetch all invoices without filters
  });
});*/

$(document).ready(function() {
  let sortField = 'invoice_number';
  let sortOrder = 'asc';

  function fetchInvoices(query = '', startDate = '', endDate = '', sortField = 'invoice_number', sortOrder = 'asc') {
    $.ajax({
      url: '/invoice/search',
      method: 'GET',
      data: {
        query: query,
        start_date: startDate,
        end_date: endDate,
        sort_field: sortField,
        sort_order: sortOrder
      },
      success: function(response) {
        let tableBody = $('#invoiceTable tbody');
        tableBody.empty();

        response.forEach(invoice => {
          tableBody.append(`
            <tr>
              <td>${invoice.invoice_number}</td>
              <td>${invoice.date}</td>
              <td>${invoice.customer_name}</td>
              <td>${invoice.total}</td>
              <td>${invoice.actions}</td>
            </tr>
          `);
        });
      },
      error: function(xhr) {
        console.error(xhr.responseText);
        alert('An error occurred. Please try again.');
      }
    });
  }

  // Handle search input
  $('#search-input').on('keyup', function () {

    fetchInvoices($(this).val(), $('#start-date').val(), $('#end-date').val(), sortField, sortOrder);
  });

  // Handle date filter
  $('#filter-date').on('click', function() {
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();

    if (startDate && endDate && startDate > endDate) {
      alert('Start date cannot be later than the end date.');
      return;
    }
    fetchInvoices($('#search-input').val(), startDate, endDate, sortField, sortOrder);
  });

  $('#reset-filter').on('click', function() {
    $('#start-date').val('');
    $('#end-date').val('');
    $('#search-input').val('');
    fetchInvoices(); // Fetch all invoices without filters
  });

  // Handle sorting
  $('#categoryFilter').on('change', function() {
    const [field, order] = $(this).val().split('-');
    sortField = field;
    sortOrder = order;

    const query = $('#search-input').val();
    const startDate = $('#start-date').val();
    const endDate = $('#end-date').val();

    fetchInvoices(query, startDate, endDate, sortField, sortOrder);
  });

  // Initial fetch
  fetchInvoices();
});

