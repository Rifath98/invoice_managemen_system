document.addEventListener("DOMContentLoaded", () => {
  updateRowNumbers();
  updateTotal();
  updateDiscount();
});
// Select the table
const table = document.getElementById("invoiceTable");

// Add an event listener to handle row cloning and deletion
table.addEventListener("click", (event) => {
    const target = event.target;

    // Clone Row
    if (target.classList.contains("cloneRow")) {
        const currentRow = target.closest("tr");
        const clonedRow = currentRow.cloneNode(true);

        // Clear input values in the cloned row
        clonedRow.querySelectorAll("input").forEach((input) => {
            input.value = "";
        });

      clonedRow.querySelectorAll("output").forEach((output) => {
        output.textContent = "";
      });

      const discountAmountInput = clonedRow.querySelector(".discount_amount");
      const discountPercentageInput = clonedRow.querySelector(".discount_percentage");

      if (discountAmountInput) discountAmountInput.value = "0.00";
      if (discountPercentageInput) discountPercentageInput.value = "0.00";

        const currentIndex = currentRow.dataset.index || 0;
        const newIndex = parseInt(currentIndex) + 1;

        clonedRow.dataset.index = newIndex; // Assign new index to the cloned row

        clonedRow.querySelectorAll("input").forEach((input) => {
        input.name = input.name.replace(/\[(\d+)\]/, `[${newIndex}]`); // Update array index
      });

        // Append the cloned row to the table
        currentRow.parentNode.insertBefore(clonedRow, currentRow.nextSibling);

        // Update row numbers
        updateRowNumbers();
      updateTotal();
      updateDiscount();
    }

    // Delete Row
    if (target.classList.contains("deleteRow")) {
        const currentRow = target.closest("tr");

        // Ensure there is always at least one row in the table
        if (table.querySelectorAll("tbody tr").length > 1) {
            currentRow.remove();
            updateRowNumbers();
            updateTotal();
          updateDiscount();
        } else {
            alert("At least one row must remain!");
        }
    }
});

// Function to update row numbers
function updateRowNumbers() {
    const rows = table.querySelectorAll("tbody tr");
    rows.forEach((row, index) => {
        row.children[0].textContent = index + 1; // Update the row number
    });
}

document.addEventListener('input', (event)=>{
  const target = event.target;

  if (
    target.classList.contains('quantity') ||
    target.classList.contains('unit_price') ||
    target.classList.contains('discount_percentage') ||
    target.classList.contains('discount_amount') ||
    target.classList.contains('totalSubtotal-hidden')
  ){
    const row = target.closest('tr');
    const quantityInput = row.querySelector(".quantity");
    const unitPriceInput = row.querySelector(".unit_price");
    const discountAmountInput = row.querySelector(".discount_amount");
    const discountPercentageInput = row.querySelector(".discount_percentage");
    const totalSubtotalHidden = row.querySelector(".totalSubtotal-hidden");
    const subtotalOutput = row.querySelector(".subtotal");
    const subtotalHidden = row.querySelector(".subtotal-hidden");

    const quantity = quantityInput ? parseFloat(quantityInput.value) || 0 : 0;
    const unit_price = unitPriceInput ? parseFloat(unitPriceInput.value) || 0 : 0;

    const totalBeforeDiscount = unit_price * quantity;

    if (totalSubtotalHidden) {
      totalSubtotalHidden.value = totalBeforeDiscount.toFixed(2);
    }

    if (totalBeforeDiscount === 0) {
      discountAmountInput.value = "0.00";
      discountPercentageInput.value = "0.00";
      subtotalOutput.textContent = "0.00";
      subtotalHidden.value = "0.00";
      updateDiscount();
      updateTotal();
      return;
    }

    if (target.classList.contains('discount_percentage')){
      const discountPercentage = discountPercentageInput ? parseFloat(discountPercentageInput.value) || 0 : 0;
      const discountAmount = (totalBeforeDiscount * discountPercentage) / 100;
      discountAmountInput.value = discountAmount.toFixed(2);
    }
    else if (target.classList.contains('discount_amount')){
      const discountAmount = discountAmountInput ? parseFloat(discountAmountInput.value) || 0 : 0;
      const discountPercentage = (discountAmount / totalBeforeDiscount) * 100;
      discountPercentageInput.value = discountPercentage.toFixed(2);
    }

    const discountAmount = discountAmountInput ? parseFloat(discountAmountInput.value) || 0 : 0;
    const subtotal = totalBeforeDiscount - discountAmount;

    subtotalOutput.textContent = subtotal.toFixed(2);
    subtotalHidden.value = subtotal.toFixed(2);

    updateDiscount();
    updateTotal();
  }
});

function updateDiscount(){
  const rows = document.querySelectorAll('#invoiceTable tbody tr');
  let totalDiscount = 0;

  rows.forEach((row)=>{
    const discountHidden = row.querySelector('.discount_amount');
    totalDiscount += parseFloat(discountHidden.value) || 0;
  });

  const discountOutput = document.querySelector('#totalDiscount');
  const discountHiddenInput = document.querySelector('#discount-hidden');

  discountOutput.textContent = totalDiscount.toFixed(2);
  discountHiddenInput.value = totalDiscount.toFixed(2);
}
function updateTotal(){
  let total = 0;
  let totalBeforeDiscount = 0;

  document.querySelectorAll('#invoiceTable tbody tr').forEach((row)=>{
    const subtotalHidden = row.querySelector('.subtotal-hidden');
    const subtotalBeforeInput = row.querySelector('.totalSubtotal-hidden');

    const subtotalHiddenValue = subtotalHidden ? parseFloat(subtotalHidden.value) || 0 : 0;
    const subtotalBeforeValue = subtotalBeforeInput ? parseFloat(subtotalBeforeInput.value) || 0 : 0;

    total += subtotalHiddenValue;
    totalBeforeDiscount += subtotalBeforeValue;

  });

  const totalOutput = document.querySelector('#totalAmount');
  const totalHiddenInput = document.querySelector('#total-hidden');

  const totalSubtotalBefore = document.querySelector('#totalSubtotal');
  const totalBeforeOutput = document.querySelector('#totalSubtotal-hidden');

  if (totalOutput) totalOutput.textContent = total.toFixed(2);
  if (totalHiddenInput) totalHiddenInput.value = total.toFixed(2);

  if (totalSubtotalBefore) totalSubtotalBefore.textContent = totalBeforeDiscount.toFixed(2);
  if (totalBeforeOutput) totalBeforeOutput.value = totalBeforeDiscount.toFixed(2);

}
