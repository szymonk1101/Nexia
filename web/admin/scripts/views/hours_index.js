
$(document).ready(() => {
    
    $('#openhours_datatable').DataTable({
        responsive: true,
        ajax: {
            url: openhours_datatable_ajax_url
        },
        language: { url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json' },
        columns: [
            {
                data: 'id',
            },
            {
                data: 'valid_from',
            },
            {
                data: 'valid_to',
            },
            {
                data: 'company_ref',
            },
            {
                data: 'staff_ref',
            },
            {
                data: 'service_ref',
            }
        ]
    });

});
