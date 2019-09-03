
$(document).ready(() => {
    
    $('[data-toggle="datepicker"]').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.timepicker').timepicker({
        showMeridian: false,
        defaultTime: false
    });

    $('#service_ref').on('change', () => {

        let duration = $('#service_ref option[value="'+($('#service_ref').val())+'"]').data('duration');

        if(duration) {
            $('#duration').val(duration);
        }

    });
    
});
