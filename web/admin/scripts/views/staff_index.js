
$(document).ready(() => {
    
    $('#staff_datatable').DataTable({
        responsive: true,
        ajax: {
            url: staff_datatable_ajax_url
        },
        language: { url: '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Polish.json' },
        columns: [
            {
                data: 'id',
                render: (data,type,row) => {
                    return '<a href="'+staff_details_url+data+'">'+data+'</a>';
                }
            },
            {
                data: 'email',
            },
            {
                data: 'rank',
            },
            {
                data: 'lastlogin',
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
