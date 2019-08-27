
$(document).ready(() => {
    
    $('#services_datatable').DataTable({
        responsive: true,
        ajax: {
            url: services_datatable_ajax_url
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
                data: 'category_ref'
            },
            {
                data: 'price',
            },
            {
                data: 'duration',
            },
			{
                data: null,
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
