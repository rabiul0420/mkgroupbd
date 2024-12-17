$(function () {
    "use strict";
    let base_url = $('meta[name="base-url"]').attr('base_url');
    const submit_mode = $('#submit_mode').val();
       if(submit_mode == "edit") {
           setSerial();
       }
    // Check if product already exists in the invoice list
    $(document).on('change', '#product_id', function() {
        const product_id = $('#product_id').val();
        if (productExistsInInvoice(product_id)) {
             alert('Already added in invoice list!');
        } else {
           $.ajax({
                method: 'GET',
                url: base_url + "/api/get-product-record/" + product_id,
                success: function(response){
                     $("#invoice_table").find("tbody").append(response);
                     setSerial();

                     // Automatically add price and quantity and trigger calculation
                     let lastRow = $("#invoice_table").find("tbody tr:last");
                     let unit_price = lastRow.find('.unit_price').val();
                     let quantity = lastRow.find('.quantity').val();
                     if (unit_price && quantity) {
                         let amount = unit_price * quantity;
                         lastRow.find('.amount').val(amount.toFixed(2));
                         calculateTotal(); // Trigger the calculation for the whole invoice
                     }
                }
            });
        }
    });

    // Check if the product is already in the invoice
    function productExistsInInvoice(product_id) {
        let exists = false;
        // Loop through the rows to check if product_id already exists
        $('#invoice_table tbody tr').each(function() {
            let row_product_id = $(this).find('.product_id').val();
            if (row_product_id == product_id) {
                exists = true;
                return false;  // Break the loop if found
            }
        });
        return exists;
    }

    // Check if at least one product exists in the table before form submission
    $(document).on('submit', '#invoice_add', function(e) {
        if ($('#invoice_table tbody tr').length === 0) {
            e.preventDefault();  // Prevent form submission
            alert('Please add at least one product to the invoice!');
            return false;
        }
        return true; // Allow form submission if there's at least one product
    });

    // Update serial numbers
    function setSerial() {
        let serial = $('.serial');
        serial.each(function(index)  {
            $(this).text(index + 1);
        });
    }

    // Remove row and update price
    $(document).on('click','.ds_remove_row',function () {
        const amount = $(this).parent().parent().find('.amount').val();
        setPrice(amount);
        $(this).parent().parent().remove();
    });

    // Calculate price on keyup
    $(document).on('keyup','.unit_price, .quantity',function (){
        calculateRowTotal(this);
    });

    // Calculate grand total on tax change
    $(document).on('keyup','.tax',function (){
        calculateGrandTotal();
    });

    // Set row price based on unit price and quantity
    function calculateRowTotal(event) {
        let unit_price = $(event).parent().parent().find('.unit_price').val();
        let quantity = $(event).parent().parent().find('.quantity').val();
        if (unit_price !== undefined && unit_price > 0 && quantity !== undefined) {
            let amount = unit_price * quantity;
            $(event).parent().parent().find('.amount').val(amount.toFixed(2));
            calculateTotal();
        }
    }

    // Calculate the total invoice price
    function calculateTotal() {
        let total_amount = 0;
        $('.amount').each(function(i, obj)  {
            total_amount += parseFloat($.trim(obj.value));
        });
        let sub_total = total_amount.toFixed(2);
        $('.sub_total').val(sub_total);
        calculateGrandTotal();
    }

    // Calculate grand total including tax
    function calculateGrandTotal() {
        let sub_total = parseFloat($('.sub_total').val()) || 0;
        let tax = parseFloat($('.tax').val()) || 0;
        let grand_total = sub_total + tax;
        $('.grand_total').val(grand_total.toFixed(2));
    }

    // Update total after removing a row
    function setPrice(amount) {
        let sub_total = parseFloat($('.sub_total').val()) - parseFloat(amount);
        $('.sub_total').val(sub_total.toFixed(2));
        calculateGrandTotal();
    }

});
