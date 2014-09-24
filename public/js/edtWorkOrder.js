(function()
{
    $('select#person-commissioning-work-is-account-director-responsible').on('change', function()
    {
        if($(this).val() == 'No') {
            $('#person-commissioning-work-is-account-director-responsible-reveal').slideDown();
        }
        else
        {
            $('#person-commissioning-work-is-account-director-responsible-reveal').slideUp();
        }
    });

    //jQuery UI Datepicker for EDT IWO required completion date
    //Ensure only today's date or dates in the future are selectable
    var dateToday = new Date();
    $("#required_completion_date").datepicker({
        dateFormat: "dd-mm-yy",
        numberOfMonths: 1,
        minDate:dateToday
    });
})();