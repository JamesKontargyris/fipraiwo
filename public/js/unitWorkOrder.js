(function() {
    // Make sure the "work will be done" section is displayed
    // when the page reloads after a failed validation and the
    // dropdown is set
    if($('select#the-work-will-be-done').val() != '')
    {
        show_fees_people_form($('select#the-work-will-be-done').val());
        if($('select#the-work-will-be-done').val() == 'at the standard Fipra hourly rates') {
            $('#the-work-will-be-done').next('.help-box').slideDown();
        }
    }
    // When "The work will be done" box is changed...
    $('select#the-work-will-be-done').on('change', function()
    {
        // If "at the standard Fipra hourly rates" is selected in the fees section,
        // show the hourly rates info drop down
        if($(this).val() == 'at the standard Fipra hourly rates') {
            $(this).next('.help-box').slideDown();
        }
        else
        {
            $(this).next('.help-box').slideUp();
        }

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
//        Update the person and rate ids in the name attributes
        tr_clone.find('.person-field input').attr('name', 'team[' + person_count + '][person]').removeClass('autofill');
        tr_clone.find('.rate-field input').attr('name', 'team[' + person_count + '][rate]');
        tr_clone.find('.rate-field select').attr('name', 'team[' + person_count + '][rate]');
//        Display the remove-row button
        tr_clone.find('.remove-row').show();
//        Add the cloned row after the final existing row
        last_row.after(tr_clone);
//        Update the person-count hidden field
        count_field.val(person_count);

        $('.remove-row').on('click', function()
        {
            $(this).closest('.fees-person').remove();
            return false;
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
        rate_labels['at the standard Fipra hourly rates'] = 'Hourly Rate';
        rate_labels['at a different Fipra hourly rate'] = 'Hourly Rate';
        rate_labels['at a day rate'] = 'Day Rate';
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
        if(selection == 'at the standard Fipra hourly rates')
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
})();