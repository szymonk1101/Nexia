
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
                data: 'user_email',
                render: (data,type,row) => {
                    return (data) ? '<a href="#">'+data+'</a>' : '';
                }
            },
            {
                data: 'service_name',
            },
            {
                data: 'staff_email',
                render: (data,type,row) => {
                    return (data) ? '<a href="'+staff_details_url+row.staff_ref+'">'+data+'</a>' : '';
                }
            },
            {
                data: 'confirmed',
                render: (data,type,row) => {
                    return (data==1) ? '<div class="badge badge-success">'+LANG.Yes+'</div>' : '<div data-id="'+row.id+'" class="confirm_res badge badge-danger pointer">'+LANG.No+'</div>';
                },
                className: 'text-center'
            },
            {
                data: 'paid',
                render: (data,type,row) => {
                    return (data==1) ? '<div data-id="'+row.id+'" class="unpaid_res badge badge-success pointer">'+LANG.Yes+'</div>' : '<div data-id="'+row.id+'" class="paid_res badge badge-danger pointer">'+LANG.No+'</div>';
                },
                className: 'text-center'
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

    var TOCONFIRM = false;

    $(document).on('click', '.confirm_res', (ev) => {
    
        let sendConfirmAjax = (resid, confirm) => {

            $.ajax({
                url: confirm_reservation_url,
                method: 'POST',
                dataType: 'json',
                data: {
                    'resid': resid,
                    'confirm': (TOCONFIRM == resid) ? 1 : 0
                }
            })
            .done((data) => {
                if(data.status == 2) {
                    TOCONFIRM = resid;
                    alert(data.message);
                } else {
                    alert(data.message);
                    if(data.status == 1) {
                        location.reload();
                    }
                }
            });
        };

        let resid = $(ev.currentTarget).data('id');

        if(confirm("Czy na pewno chcesz zatwierdzić rezerwacje nr "+resid+"?")) {
            sendConfirmAjax(resid, 0);
        }

    });

    $(document).on('click', '.paid_res', (ev) => {

        let resid = $(ev.currentTarget).data('id');

        if(confirm("Czy na pewno chcesz oznaczyć rezerwacje nr "+resid+" jako opłaconą?")) {
            $.ajax({
                url: set_paid_reservation_url,
                method: 'POST',
                dataType: 'json',
                data: {
                    'resid': resid,
                    'paid': 1
                }
            })
            .done((data) => {
                alert(data.message);
                if(data.status == 1) {
                    location.reload();
                }
            });
        }

    });

    $(document).on('click', '.unpaid_res', (ev) => {

        let resid = $(ev.currentTarget).data('id');

        if(confirm("Czy na pewno chcesz oznaczyć rezerwacje nr "+resid+" jako nieopłaconą?")) {
            $.ajax({
                url: set_paid_reservation_url,
                method: 'POST',
                dataType: 'json',
                data: {
                    'resid': resid,
                    'paid': 0
                }
            })
            .done((data) => {
                alert(data.message);
                if(data.status == 1) {
                    location.reload();
                }
            });
        }

    });

});
