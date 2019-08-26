
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
                data: 'name',
            },
            {
                data: null,
                render: (data,type,row) => {
                    return ((row.company_ref) ? '<div class="mr-2 badge badge-primary">Firma</div>':'')
                        +((row.staff_ref) ? '<div class="mr-2 badge badge-secondary">Pracownik</div>':'')
                        +((row.service_ref) ? '<div class="mr-2 badge badge-info">Usługa</div>':'');
                }
            },
            {
                data: 'valid_from',
            },
            {
                data: 'valid_to',
            },
            {
                data: null,
                render: (data,type,row) => {
                    return '<a href="#" class="btn-icon btn-icon-only btn-pill btn btn-sm btn-outline-primary"><i class="pe-7s-tools btn-icon-wrapper"></i></a>';
                },
                className: 'text-center'
            }
        ]
    });

});
