(function() {

    // Make sure the fees section is fully displayed
    // when the page reloads after a failed validation and the
    // dropdown is set
    if($('select#rate-type').val() != '')
    {
        show_fees_field($('select#rate-type').val());
        update_fees_form();
        update_grand_total();
    }

    // When a day total is entered/changed, update the grand total
    $('.fee-days input').on('change blur', function()
    {
        $(this).val(valid_days($(this).val()));
        update_grand_total();
    });

    // When the rate type is changed...
    $('select#rate-type').on('change', function()
    {
        show_fees_field($(this).val());
    });

    function show_fees_field(selection)
    {
        var rate_labels = new Array();
        rate_labels['Fipra day rate'] = 'Day Rate';
        rate_labels['at a flat or project rate'] = 'Flat/Project Rate';

        //display the correct field
        if(selection == 'Fipra day rate')
        {
            $('.fee-flatrate input').attr('disabled', true);
            $('.fee-flatrate').hide();
            $('.fee-days input').attr('disabled', false);
            $('.fee-days').show();
        }
        else
        {
            $('.fee-flatrate input').attr('disabled', false);
            $('.fee-flatrate').show();
            $('.fee-days input').attr('disabled', true);
            $('.fee-days').hide();
        }

        if(selection == '')
        {
            $('.fee-days, .fee-flatrate').hide();
        }

        return true;
    }

    // Autofill relevant fields when billing entity is selected
    $('.billing_entity').on('change', function () {
        var unit = $(this).val(),
            field = $(this);
        $.ajax({
            method: "GET",
            url: "/ac/unit_dropdown",
            data: {selected: unit},
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(xhr.responseText);
                console.log(thrownError);
            }
        })
            .done(function (data) {
                data = JSON.parse(data);
                if (data.additional_info) {
                    var newline = String.fromCharCode(13, 10);
                    $('textarea[name=' + field.data('additional-info-field') + ']').val(data.additional_info.replaceAll('\\n', newline));
                } else {
                    $('textarea[name=' + field.data('additional-info-field') + ']').val('None');
                }
            });
    });

    function update_grand_total()
    {
        var grand_total = 0,
            days = $('.fee-days .no_of_days').val(),
            day_rate = $('.day_rate').val();

        $('.grand-total').text('Total: €' + (days * day_rate).formatMoney(0));
        $('.day_rate_total').val((days * day_rate).formatMoney(0));
        return grand_total;
    }

    function update_fees_form()
    {
        var rate_type = $('select#rate-type');

        // If "at the Fipra day rate" is selected in the fees section,
        // show the hourly rates info drop down
        if(rate_type.val() == 'Fipra day rate') {
            rate_type.next('.help-box').slideDown();
            $('.rate-type-days').show();
            $('.rate-type-flat-rate').hide();
            $('.person-total-row').show();
            $('.hidden-rate-type').val('dayrate');
        }
        else
        {
            rate_type.next('.help-box').slideUp();
            $('.rate-type-days').hide();
            $('.rate-type-flat-rate').show();
            $('.person-total-row').hide();
            $('.hidden-rate-type').val('flatrate');
        }
    }

    // Ensure days is a valid number
    function valid_days(days_entry)
    {
        var day_fraction = 0.25;
        if(days_entry % day_fraction){              //Check if there is a remainder
            var remainder = days_entry % day_fraction; //Get remainder
            days_entry -= remainder;
        }

        return days_entry;
    }

})();