
$(document).ready(() => {
    
    $('#reservations_datatable').DataTable({
        responsive: true,
        ajax: {
            url: reservations_datatable_ajax_url
        },
        language: { url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json' },
        columns: [
            {
                data: 'id',
            },
            {
                data: 'date',
            },
            {
                data: 'time_from',
                render: (data,type,row) => {
                    return row.time_from + ' - ' + row.time_to;
                }
            },
            {
                data: 'user_ref',
            },
            {
                data: 'service_name',
            },
            {
                data: 'staff_email',
            },
            {
                data: 'confirmed',
                render: (data,type,row) => {
                    return (data) ? '<div class="badge badge-success">'+LANG.Yes+'</div>' : '<div class="badge badge-danger">'+LANG.No+'</div>';
                }
            },
            {
                data: 'paid',
            },
            {
                data: 'status',
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
