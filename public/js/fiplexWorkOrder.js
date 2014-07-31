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
})();