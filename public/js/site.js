(function(){
	
	// Call max_upload_error function
	max_upload_error();

	// Show all elements with a class of showjs
	$('.showjs').css('display', 'block');
    // Hide all elements with a class of hidejs
    $('.hidejs').css('display', 'none');
	// Show all help buttons
	$('.help').css('display', 'inline-block');
    //If select-all button is clicked, select all checkboxes on page
    $('button.select-all, a.select-all').on('click', function()
    {
        $('body input[type=checkbox]').prop("checked", !$(this).prop("checked"));
        return false;
    });
    //If deselect-all button is clicked, deselect all checkboxes on page
    $('button.deselect-all, a.deselect-all').on('click', function()
    {
        $('body input[type=checkbox]').removeAttr('checked');
        return false;
    });

    // Hide all help boxes
	$('.help-box').css('display', 'none');

    //jQuery UI Datepicker for IWO start/end dates
    //Ensure only today's date or dates in the future are selectable
    //Once a start date is selected, onSelect ensures expiry dates are the same day or in the future
    var dateToday = new Date();
    var dates = $("#internal_work_order_start_date_datepicker, #internal_work_order_expiry_date_datepicker").datepicker({
        dateFormat: "dd-mm-yy",
        numberOfMonths: 1,
        onSelect: function(selectedDate) {
            var option = this.id == "internal_work_order_start_date_datepicker" ? "minDate" : "maxDate",
                instance = $(this).data("datepicker"),
                date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
            dates.not(this).datepicker("option", option, date);

        }
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
    if($('select.work-capped-at-maximum-level').val() == "Yes")
    {
        $('#work-capped-at-maximum-level-reveal').show();
    }
    else
    {
        //Otherwise, disable the work cap input and select fields so they are not passed through
        $('#work-capped-at-maximum-level-reveal input, #work-capped-at-maximum-level-reveal select').attr('disabled', true);
    }

    // Show/hide the agreed fee element details field depending
    // on the value in the agree fee element dropdown
    $('select.work-capped-at-maximum-level').on('change', function()
    {
        if($(this).val() == 'Yes') {
            $('#work-capped-at-maximum-level-reveal').slideDown();
            $('#work-capped-at-maximum-level-reveal input, #work-capped-at-maximum-level-reveal select').attr('disabled', false);
        }
        else
        {
            $('#work-capped-at-maximum-level-reveal').slideUp(function()
            {
                $('#work-capped-at-maximum-level-reveal input, #work-capped-at-maximum-level-reveal select').attr('disabled', true);
            });

        }
    });
    // Make sure the work cap field is displayed
    // when the page reloads after a failed validation and the
    // work cap dropdown is set to "Yes"
    if($('select.work-capped-at-maximum-level').val() == "Yes")
    {
        $('#work-capped-at-maximum-level-reveal').show();
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
            var copy_contact_field = $('input[name=also_send_work_order_to]');

            //Set text box to the label value
            $(this).val(ui.item.value);
            //Set the email field to the email value
            $('input[name=' + $(this).data('email-field') + ']').val(ui.item.email);

            if($.trim(ui.item.copy_contacts) != '')
            {
                if(copy_contact_field.val() == '')
                {
                    copy_contact_field.val(ui.item.copy_contacts);
                }
                else
                {
                    var existing_copy_contacts = copy_contact_field.val();
                    if (existing_copy_contacts.indexOf(ui.item.copy_contacts) === -1)
                    {
                        copy_contact_field.val(existing_copy_contacts + ', ' + ui.item.copy_contacts);
                    }
                }
            }
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
            $('input[name=' + $(this).data('rate-band-field') + ']').val(ui.item.rate_band);
        }
    });

    // Load rating stars
    $('.starrr').starrr({
        change: function(e, value){
            $('input[name=rating]').val(value);
            $('.rating-stars-reveal').slideDown();
            $('.rating-submit').prop("disabled", false).val('Add ' + value + ' out of 5 Rating');
        }
    });
    // hide until needed
    $('.rating-stars-reveal').hide();


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

    function clean_copy_contacts(string)
    {
        var a = [],
            contacts = string.split(',');

        console.log(contacts);

        contacts.each(function() {
            if($.trim($(this).val()).length > 0)
            {
                a.push($.trim($(this).val()));
            }
        });

        return a.join(', ');
    }

    // Format money function
    Number.prototype.formatMoney = function(c, d, t){
        var n = this,
            c = isNaN(c = Math.abs(c)) ? 2 : c,
            d = d == undefined ? "." : d,
            t = t == undefined ? "," : t,
            s = n < 0 ? "-" : "",
            i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
            j = (j = i.length) > 3 ? j % 3 : 0;
        return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
    };

})();