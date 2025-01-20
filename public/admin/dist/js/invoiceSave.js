$(document).on("submit", "#invoiceForm", function (e) {
  e.preventDefault(); // Prevent form submission

  // Show confirmation dialog
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to update this invoice?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, save it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Proceed with saving or updating
      $.ajax({
        url: $(this).attr("action"),
        method: "POST",
        data: $(this).serialize(),
        success: function (response) {
          Swal.fire("Success!", response.message, "success").then(() => {
            // Redirect after confirmation
            window.location.href = "/invoice-list";
          });
        },
        error: function (xhr) {
          const errorResponse = xhr.responseJSON;
          Swal.fire(
            "Error!",
            errorResponse.message || "Something went wrong. Please try again.",
            "error"
          );
          console.log(errorResponse.details); // Debugging
        },
      });
    }
  });
});

$(document).on("submit", "#saveForm", function (e) {
  e.preventDefault(); // Prevent form submission

  // Show confirmation dialog
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to Save this invoice?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Save it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Proceed with saving or updating
      $.ajax({
        url: $(this).attr("action"),
        method: "POST",
        data: $(this).serialize(),
        success: function (response) {
          Swal.fire("Success!", response.message, "success").then(() => {
            // Redirect after confirmation
            window.location.href = "/";
          });
        },
        error: function (xhr) {
          const errorResponse = xhr.responseJSON;
          Swal.fire(
            "Error!",
            errorResponse.message || "Something went wrong. Please try again.",
            "error"
          );
          console.error("Error Details:", errorResponse.details); // Debugging
        },
      });
    }
  });
});

$(document).on("submit", "#deleteInvoice", function (e) {
  e.preventDefault(); // Prevent form submission

  // Show confirmation dialog
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to delete this invoice?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Save it!",
  }).then((result) => {
    if (result.isConfirmed) {
      // Proceed with saving or updating
      $.ajax({
        url: $(this).attr("action"),
        method: "POST",
        data: $(this).serialize(),
        success: function (response) {
          Swal.fire("Success!", response.message, "success").then(() => {
            // Redirect after confirmation
            window.location.href = "/invoice-list";
          });
        },
        error: function (xhr) {
          const errorResponse = xhr.responseJSON;
          Swal.fire(
            "Error!",
            errorResponse.message || "Something went wrong. Please try again.",
            "error"
          );
          console.error("Error Details:", errorResponse.details);
        },
      });
    }
  });
});

