(function() {
	// Make sure the agreed fee element details field is displayed
	// when the page reloads after a failed validation and the
	// agreed fee element dropdown is set to "Yes"
	if($('select.agreed-fee-element').val() == "Yes")
	{
		$('#agreed-fee-element-reveal').show();
	}
	// Show/hide the agreed fee element details field depending
	// on the value in the agree fee element dropdown
	$('select.agreed-fee-element').on('change', function()
	{
		if($(this).val() == 'Yes') {
			$('#agreed-fee-element-reveal').slideDown();
		}
		else
		{
			$('#agreed-fee-element-reveal').slideUp();	
		}
	});

    // Make sure the green sheet required confirmation checkbox is displayed
    // when the page reloads after a failed validation and the
    // green sheet required dropdown is set to "Yes"
    if($('select.green-sheet-required').val() == "Yes")
    {
        $('#green-sheet-required-reveal').show();
    }
    // Show/hide the green sheet details field depending
    // on the value in the green sheet required element dropdown
    $('select.green-sheet-required').on('change', function()
    {
        if($(this).val() == 'Yes') {
            $('#green-sheet-required-reveal').slideDown();
        }
        else
        {
            $('#green-sheet-required-reveal').slideUp();
        }
    });

    // Make sure the work cap field is displayed
    // when the page reloads after a failed validation and the
    // work cap dropdown is set to "Yes"
    if($('select.work-capped-each-month').val() == "Yes")
    {
        $('#work-capped-each-month-reveal').show();
    }
    // Show/hide the agreed fee element details field depending
    // on the value in the agree fee element dropdown
    $('select.work-capped-each-month').on('change', function()
    {
        if($(this).val() == 'Yes') {
            $('#work-capped-each-month-reveal').slideDown();
        }
        else
        {
            $('#work-capped-each-month-reveal').slideUp();
        }
    });
    // Make sure the work cap field is displayed
    // when the page reloads after a failed validation and the
    // work cap dropdown is set to "Yes"
    if($('select.work-capped-each-month').val() == "Yes")
    {
        $('#work-capped-each-month-reveal').show();
    }

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

    $('.lead_unit_account_director').focusout('change', function()
    {
        var name = $(this).val();
        $('.autofill').val(name);
    });



    function show_fees_people_form(selection)
    {
        var rate_labels = new Array();
        rate_labels['at the standard Fipra hourly rates'] = 'Final Hourly Rate';
        rate_labels['at a different Fipra hourly rate'] = 'Final Hourly Rate';
        rate_labels['at a day rate'] = 'Final Day Rate';
        rate_labels['at a flat or project rate'] = 'Final Flat/Project Rate';

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
        return true;
    }
})();