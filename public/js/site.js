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

    $( ".datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });

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