
$(document).ready(() => {
    
    $('#valid_from').inputmask();
    $('#valid_to').inputmask();

    

    $('.timepicker').timepicker({
        showMeridian: false,
        defaultTime: false
    });
    
});
