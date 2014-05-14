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
})();