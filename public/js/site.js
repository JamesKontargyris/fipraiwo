(function(){
	
	// Call max_upload_error function
	max_upload_error();

	// Show all elements with a class of showjs
	$('.showjs').css('display', 'block');
    // Hide all elements with a class of hidejs
    $('.hidejs').css('display', 'none');
	// Show all help buttons
	$('.help').css('display', 'inline-block');

    $('.euro-field').keydown(function(e)
    {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
                // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57) || e.altKey) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

	// Hide all help boxes
	$('.help-box').css('display', 'none');

    //jQuery UI Datepicker for IWO start/end dates
    //Ensure only today's date or dates in the future are selectable
    //Once a start date is selected, onSelect ensures expiry dates are the same day or in the future
    var dateToday = new Date();
    var dates = $("#internal_work_order_start_date, #internal_work_order_expiry_date").datepicker({
        dateFormat: "dd-mm-yyyy",
        numberOfMonths: 1,
        onSelect: function(selectedDate) {
            var option = this.id == "internal_work_order_start_date" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);

        }
    });

    //jQuery UI Datepicker for EDT IWO required completion date
    //Ensure only today's date or dates in the future are selectable
    var dateToday = new Date();
    $(".datepicker").datepicker({
        dateFormat: "dd-mm-yyyy",
        numberOfMonths: 1,
        minDate:dateToday
    });

    // Make sure the agreed fee element details field is displayed
    // when the page reloads after a failed validation and the
    // agreed fee element dropdown is set to "Yes"
    if($('select.agreed-fee-element').val() == "Yes")
    {
        $('#agreed-fee-element-reveal').show();
    }
    else
    {
        //otherwise disable the input fields so they are not passed through
        $('#agreed-fee-element-reveal textarea').attr('disabled', true);
    }
    // Show/hide the agreed fee element details field depending
    // on the value in the agree fee element dropdown
    $('select.agreed-fee-element').on('change', function()
    {
        if($(this).val() == 'Yes') {
            $('#agreed-fee-element-reveal').slideDown();
            $('#agreed-fee-element-reveal textarea').attr('disabled', false);
        }
        else
        {
            $('#agreed-fee-element-reveal').slideUp(function()
            {
                $('#agreed-fee-element-reveal textarea').attr('disabled', true);
            });
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
    else
    {
        //Otherwise, disable the work cap input and select fields so they are not passed through
        $('#work-capped-each-month-reveal input, #work-capped-each-month-reveal select').attr('disabled', true);
    }

    // Show/hide the agreed fee element details field depending
    // on the value in the agree fee element dropdown
    $('select.work-capped-each-month').on('change', function()
    {
        if($(this).val() == 'Yes') {
            $('#work-capped-each-month-reveal').slideDown();
            $('#work-capped-each-month-reveal input, #work-capped-each-month-reveal select').attr('disabled', false);
        }
        else
        {
            $('#work-capped-each-month-reveal').slideUp(function()
            {
                $('#work-capped-each-month-reveal input, #work-capped-each-month-reveal select').attr('disabled', true);
            });

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

	// Show help box when help button is clicked
	$('a.help').on('click', function(e)
	{
		$(this).next('.help-box').slideToggle(300);
		return false;
	});
    // Show info on landing page when info button clicked
    $('i.info').on('click', function(e)
    {
        $(this).siblings('span').slideToggle(300);
        return false;
    });
	// Check if nav links exist. If not, hide the links toggle menu button
	// and reduce the top padding
	if($.trim($('nav ul').html()) == '')
	{
		$('.links-toggle').hide();
	}
	// Toggle display of menu on mobile devices when links-toggle is clicked
	$('.links-toggle').on('click', function(e)
	{
		linksMenuToggle();
		return false;
	});

	// Hide the form buttons and show a loading animation
	// when the submit button is clicked
	$('.swap-for-loading').on('click', function(e) {
		$('.buttons').hide();
		$('.loading').show();
	});

	// Smooth scroll to top of page when "back to top" page is clicked
	$('a.back-to-top').on('click', function()
	{
		$("html, body").animate({scrollTop: 0}, 700);
		return false;
	});

	// Add another file input field
	$('.add-new-file-upload').on('click', function()
	{
		var new_file_input = $('.file-field .formfield .formgroup').clone();
		new_file_input.prepend('<div class="file-upload-close"><a href="#"><i class="fa fa-times-circle fa-lg"></i></a></div>');
		new_file_input.appendTo($('.file-field')).css('display', 'none').slideDown();

		$('.file-upload-close').on('click', function(e)
		{
			console.log('Click!');
			$(this).parent('.formgroup').slideUp(function()
			{
				$(this).remove();	
			});
			e.preventDefault();
		});
		// Call max_upload_error to include the new file field
		max_upload_error();
	});

//    Add "This field cannot be edited." message to all "readonly" input fields
    $('input[readonly=readonly], input[disabled=disabled]').attr('title', 'This field cannot be edited.');

//  Autocomplete functionality
    $(".account_director_autocomplete").autocomplete({
        source: '/ac/account_directors',
        minLength:1,
        select: function(event, ui) {
            $(this).val(ui.item.value);
            $('input[name=' + $(this).data('email-field') + ']').val(ui.item.email);
        }
    });

    $(".unit_reps_autocomplete").autocomplete({
        source: '/ac/unit_reps',
        minLength:1,
        select: function(event, ui) {
            $(this).val(ui.item.value);
            $('select[name=' + $(this).data('rep-field') + ']').val(ui.item.rep);
        }
    });

    $(".spad_reps_autocomplete").autocomplete({
        source: '/ac/spad_reps',
        minLength:1,
        select: function(event, ui) {
            $(this).val(ui.item.value);
            $('input[name=' + $(this).data('email-field') + ']').val(ui.item.email);
            $('select[name=' + $(this).data('rep-field') + ']').val(ui.item.rep);
        }
    });

    $(".unit_lead_contact_rep_autocomplete").autocomplete({
        source: '/ac/unit_lead_contacts_and_reps',
        minLength:1,
        select: function(event, ui) {
            $(this).val(ui.item.value);
            $('input[name=' + $(this).data('name-field') + ']').val(ui.item.name);
            $('input[name=' + $(this).data('email-field') + ']').val(ui.item.email);
            $('select[name=' + $(this).data('rep-field') + ']').val(ui.item.rep);
        }
    });


	// When a file is selected for upload, compare its size
	// to the max upload size and display an alert if the file
	// is too large.
	function max_upload_error()
	{
		var max_upload_size = parseInt($('#max_upload_size').val());
		$('input[type=file]').on('change', function() {
			var t = $(this);
		 	//this.files[0].size gets the size of your file.
		 	var file_size = precise_round(this.files[0].size / 1048576,2);
		 	if(file_size > max_upload_size)
		 	{
		  		alert("ERROR: file is too large. Your file's size is " +file_size+ "mb, maximum upload size is " +max_upload_size+ "mb. Please send your file via email or a file sharing service to edt@fipra.com once you have submitted your request, quoting the project details and replicon code.");
		  		t.val('');
		 	}
		});
	}

	function linksMenuToggle()
	{
		$('nav ul').slideToggle();
		var buttonText = ($('.but-toggle').html() == '<i class="fa fa-caret-down"></i> SHOW MENU') ? '<i class="fa fa-caret-up"></i> HIDE MENU' : '<i class="fa fa-caret-down"></i> SHOW MENU';
		$('.but-toggle').html(buttonText);
	}

	// Return num rounded to decimals.
	function precise_round(num,decimals){
		return Math.round(num*Math.pow(10,decimals))/Math.pow(10,decimals);
	}
})();