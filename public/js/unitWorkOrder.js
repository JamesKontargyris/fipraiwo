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
    // Show/hide the agreed fee element details field depending
    // on the value in the agree fee element dropdown
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

    $('.add-new-person').on('click', function()
    {
        var clone_row = $('.fees-person-clone'),
            tr_clone = $('.fees-person-clone').clone();
        tr_clone.removeClass('fees-person-clone').addClass('fees-person');
        clone_row.before(tr_clone);
        return false;
    });

    $('.remove-row').on('click', function()
    {
        console.log('click');
        return false;
    });

    function show_fees_people_form(selection)
    {
        var rate_labels = new Array();
        rate_labels['at the standard Fipra hourly rates'] = 'Hourly Rate';
        rate_labels['at a different Fipra hourly rate'] = 'Hourly Rate';
        rate_labels['at a day rate'] = 'Day Rate';
        rate_labels['at a flat or project rate'] = 'Flat/Project Rate';

        if(selection != '') {
            $('.fees-people').slideDown();
            $('.rate-label').text(rate_labels[selection]);
        } else {
            $('.fees-people').slideUp();
        }
        return true;
    }
})();