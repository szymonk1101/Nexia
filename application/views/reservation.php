<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nexia - Zarezerwuj usługę</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components." />
    <meta name="msapplication-tap-highlight" content="no" />
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="<?= base_url('web/admin/main.css'); ?>" rel="stylesheet"></head>

    <link href='<?= base_url('web/plugins/packages/core/main.css'); ?>' rel='stylesheet' />
    <link href='<?= base_url('web/plugins/packages/daygrid/main.css'); ?>' rel='stylesheet' />
    <link href='<?= base_url('web/plugins/packages/timegrid/main.css'); ?>' rel='stylesheet' />
    <script src='<?= base_url('web/plugins/packages/core/main.js'); ?>'></script>
    <script src='<?= base_url('web/plugins/packages/interaction/main.js'); ?>'></script>
    <script src='<?= base_url('web/plugins/packages/daygrid/main.js'); ?>'></script>
    <script src='<?= base_url('web/plugins/packages/timegrid/main.js'); ?>'></script>
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-sm-12">
                Wybierz usługę:
                <select id="Service" class="form-control">
                    <?php foreach($services as $s): ?>
                    <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                Wybierz osobę:
                <select id="Staff" class="form-control">
                    <option value="">Dowolna</option>
                    <option value="1">Heniek Szefuncio</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                Wybierz dzień:
                
                <div id='calendar'></div>
            </div>

            <div class="col-sm-6">
                Wybierz godzinę:
                
                <div id="FreeHours">

                </div>

            </div>
        </div>

    </div>

    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script type="text/javascript">

    $(document).ready(() => {

        let date = '<?= date('Y-m-d'); ?>';

        let reload = () => {

            let service_ref = $('#Service').val();
            let staff_ref = $('#Staff').val();

            $('#FreeHours').html('');

            $.ajax({
                url: '<?= base_url('api/hours/getOpenHoursByDate'); ?>',
                method: 'POST',
                dataType: 'json',
                data: {
                    'date': date,
                    'company_ref': 1,
                    'staff_ref': staff_ref,
                    'service_ref': service_ref
                }
            })
            .done((data) => {

                data.forEach((el) => {

                    $('#FreeHours').append('<a href="#">'+el[0]+' - '+el[1]+'</a>&nbsp;&nbsp;&nbsp;');

                });
                

            });
        }
        reload();

        $('#Staff, #Service').on('change', reload);


        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'interaction', 'dayGrid' ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: ''
        },
        defaultDate: '<?= date('Y-m-d'); ?>',
        navLinks: false, // can click day/week names to navigate views
        selectable: true,
        selectMirror: false,
        select: function(arg) {
            console.log(arg);
            date = arg.startStr;
            reload();
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: [


        ]
        });

        calendar.render();
    });

    </script>

</body>
</html>