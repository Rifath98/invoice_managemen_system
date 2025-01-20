$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$("#invoice-submit").on("submit", function (e) {
    e.preventDefault();

    const formData = $(this).serializeArray();

    $.ajax({
        url:"/invoice-save",
        method: "POST",
        data: formData,
        success: function (response) {
            alert("Invoice Saved Successfully !");
            console.log(response);
        },
        error: function (xhr, status, error) {
            alert("An error occurred while saving the invoice.");
            console.error(error);
        },
    });
});
