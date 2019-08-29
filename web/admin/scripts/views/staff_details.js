var openhours_datatable_drawed = false;

$(document).ready(() => {
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

        if(e.target.id == 'tab-hours') {
            
            if(!openhours_datatable_drawed) {
                openhours_datatable_drawed = true;
                
                $('#openhours_datatable').DataTable({
                    responsive: true,
                    ajax: {
                        url: openhours_datatable_ajax_url,
                        type: 'POST',
                        data: {
                            'staff_id': STAFF_ID
                        }
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

                $('#exceptions_datatable').DataTable({
                    responsive: true,
                    ajax: {
                        url: exceptions_datatable_ajax_url,
                        type: 'POST',
                        data: {
                            'staff_id': STAFF_ID
                        }
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
                            data: null,
                            render: (data,type,row) => {
                                return (row.fullday == 1) ? LANG.DontWork : row.time_from+' - '+row.time_to;
                            }
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
            }
        }
    });

    

});
