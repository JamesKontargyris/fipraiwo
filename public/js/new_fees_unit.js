(function() {

    // Make sure the "work will be done" section is displayed
    // when the page reloads after a failed validation and the
    // dropdown is set
    if($('select#rate-type').val() != '')
    {
        show_fees_people_form($('select#rate-type').val());
        update_fees_form();
        update_all_totals();
    }

    // When a level of seniority is changed or a day total is entered/changed, update that person's total
    $('.fees-person .level-select select, .fees-person .days-text-input input, .flat-rate-text-input input').on('change blur', function()
    {
        update_person_total($(this));
        update_grand_total();
    });

    // When the rate band is changed or a day total is entered/changed, update that person's total
    $('.rate-band-select').on('change blur', function()
    {
        update_all_totals($(this));
    });

    // When the rate type is changed...
    $('select#rate-type').on('change', function()
    {
        update_grand_total();

        update_fees_form();

        show_fees_people_form($(this).val());
    });

//    Set up remove-row functionality
    $('.remove-row').on('click', function()
    {
        $(this).closest('.fees-person').remove();
        return false;
    });
//    Hide the first remove-row button on the form,
//    so the first name/rate entry row can't be removed
    $('.remove-row').first().hide();

    $('.remove-row').on('click', function()
    {
        $(this).closest('.fees-person').remove();
        update_grand_total();

        return false;
    });

//    When the add new person button is clicked...
    $('.add-new-person').on('click', function()
    {
//        Set up variables for the clone row, the last person row,
//        the current person count and the new person count
        var tr_clone = $('.fees-person').first().clone(),
            last_row = $('.fees-people .fees-person').last(),
            count_field = $('.person-count'),
            person_count = parseInt($('.person-count').val()) + 1;

//        Remove input values in the cloned row
        tr_clone.find('input').val('');
        // Make total 0 in clone
        tr_clone.find('.person-total').text('€0');
//        Update the person and rate ids in the name attributes
        tr_clone.find('.person-field input').attr('name', 'team[' + person_count + '][person]').removeClass('autofill');
        tr_clone.find('.level-select select').attr('name', 'team[' + person_count + '][level]');
        tr_clone.find('.days-text-input input').attr('name', 'team[' + person_count + '][days]');
        tr_clone.find('.rate-type-flat-rate input').attr('name', 'team[' + person_count + '][flatrate]');
        tr_clone.find('.hidden-total').attr('name', 'team[' + person_count + '][persontotal]');
        tr_clone.find('.hidden-rate-type').attr('name', 'team[' + person_count + '][ratetype]').val($('.fees-person').first().find('.hidden-rate-type').val());
//        Display the remove-row button
        tr_clone.find('.remove-row').show();
//        Add the cloned row after the final existing row
        last_row.after(tr_clone);
//        Update the person-count hidden field
        count_field.val(person_count);

        $('.remove-row').on('click', function()
        {
            $(this).closest('.fees-person').remove();
            update_grand_total();

            return false;
        });

        // When a level of seniority is changed or a day total is entered/changed, update that person's total
        $('.fees-person .level-select select, .fees-person .days-text-input input, .flat-rate-text-input input').on('change blur', function()
        {
            update_person_total($(this));
            update_grand_total();
        });

        return false;

    });

    $('.sub_contracted_unit_correspondent_affiliate_account_director').focusout('change', function()
    {
        var name = $(this).val();
        $('.autofill').val(name);
    });

    function show_fees_people_form(selection)
    {
        var rate_labels = new Array();
        rate_labels['Fipra day rate'] = 'Day Rate';
        rate_labels['at a flat or project rate'] = 'Flat/Project Rate';

        if(selection != '')
        {
            $('.fees-people').slideDown();
            $('.rate-label').text(rate_labels[selection]);
        } else {
            $('.fees-people').slideUp();
        }

        //If standard Fipra hourly rates have been selected,
        //display the dropdown boxes with rates
        if(selection == 'Fipra day rate')
        {
            $('.fees-text input').attr('disabled', true);
            $('.fees-text').hide();
            $('.fees-select select').attr('disabled', false);
            $('.fees-select').show();
        }
        else
        {
            //Otherwise display standard text inputs
            $('.fees-text input').attr('disabled', false);
            $('.fees-text').show();
            $('.fees-select select').attr('disabled', true);
            $('.fees-select').hide();
        }

        if(selection == 'at a flat or project rate')
        {
            $('.total-project-fee').show();
            $('.total-project-fee input').attr('disabled', false);
        }
        else
        {
            $('.total-project-fee').hide();
            $('.total-project-fee input').attr('disabled', true);
        }
        return true;
    }

    function find_rate(rate_band, seniority_level)
    {
        if(rate_band && seniority_level)
        {
            var high_rates = [],
                standard_rates = [];

            high_rates['account_director'] = 2250;
            high_rates['account_manager'] = 1500;
            high_rates['account_executive'] = 750;
            standard_rates['account_director'] = 1500;
            standard_rates['account_manager'] = 1000;
            standard_rates['account_executive'] = 500;

            return rate_band == 'high' ? high_rates[seniority_level] : standard_rates[seniority_level];
        }

        return false;
    }

    function update_person_total(el)
    {

        var rate_band = $('.rate-band-select').val(),
            seniority_level = el.closest('.fees-person').find('.level-select select').val(),
            days = valid_days(el.closest('.fees-person').find('.days-text-input input'));

        days.val(valid_days(days.val()));

        if(rate_band && seniority_level && days) {
            var rate = find_rate(rate_band, seniority_level),
                rate_type = $('#rate-type').val();

            if(rate_type == 'Fipra day rate') {
                el.closest('.fees-person').find('.person-total').text('€' + (rate * days.val()).formatMoney(0));
                el.closest('.fees-person').find('.hidden-total').val('€' + (rate * days.val()).formatMoney(0));
            }

        }

    }

    function update_grand_total()
    {
        var grand_total = 0,
            rate_type = $('#rate-type').val();

        $('.fees-person').each(function()
        {
            if(rate_type == 'Fipra day rate') {
                var rate = $(this).find('.person-total').text().replace('€', '').replace(',', '');
                grand_total = grand_total + parseInt(rate == false ? 0 : rate);
            } else {
                var rate = $(this).find('.flat-rate-text-input input').val().replace('€', '').replace(',', '');
                grand_total = grand_total + parseInt(rate == false ? 0 : rate);
            }
        })

        $('.grand-total').text('Grand Total: €' + (grand_total).formatMoney(0));
        return grand_total;
    }

    function update_all_totals(el)
    {
        $('.fees-person').each(function()
        {
            var seniority_level = $(this).find('.level-select select').val(),
                days = valid_days($(this).find('.days-text-input input')),
                rate_band = $('.rate-band-select').val();

            days.val(valid_days(days.val()));

            if(rate_band && seniority_level && days) {
                var rate = find_rate(rate_band, seniority_level);

                if(rate) { $(this).find('.person-total').text('€' + (rate * days.val()).formatMoney(0)); }
            }
        });

        update_grand_total();
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