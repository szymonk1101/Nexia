<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Nexia - Zarezerwuj usługę</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">

    <!-- Disable tap highlight on IE -->
    <meta name="msapplication-tap-highlight" content="no">

    <link href="<?= base_url('web/admin/plugins/jquery.timepicker/jquery.timepicker.min.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('web/admin/plugins/fullcalendar/core/main.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('web/admin/plugins/fullcalendar/daygrid/main.css'); ?>" rel="stylesheet" />

    <link href="<?= base_url('web/main.8d288f825d8dffbbe55e.css'); ?>" rel="stylesheet" />
    <link href="<?= base_url('web/admin/app.css'); ?>" rel="stylesheet" />

    <style type="text/css">
      #kanaly div.selected {
         border: 2px solid #1E63A9;
         border-radius: 4px 4px 4px 4px;
         margin: 3px 3px -1px -1px;
      }
      #kanaly div {
         /*background-position: left top;
         background-repeat: no-repeat;
         border: 1px solid #DADADA;
         cursor: pointer;
         float: left;
         height: 88px;
         margin-right: 4px;
         margin-top: 4px;
         padding: 5px;
         position: relative;
         width: 127px;
         z-index: 4;*/
         background-color: white;
         background-position: center center;
         background-repeat: no-repeat;
         background-size: contain;
         border: 1px solid #b2b2b2;
         border-radius: 0.2em;
         cursor: pointer;
         display: inline-block;
         width: 120px;
         height:70px;
         margin-right: 4px;
         margin-top: 4px;
      }

      #kanaly div p.label {
         display:none;
      }
   </style>

</head>
<body>

    <div class="container mt-5 mb-5">

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body">

                        <div id="smartwizard" class="sw-main sw-theme-dots">
                            <ul class="forms-wizard">
                                <li>
                                    <a href="#step-1">
                                        <em>1</em><span>Usługa</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-2">
                                        <em>2</em><span>Szczegół płatności</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#step-3">
                                        <em>3</em><span>Potwierdzenie</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="form-wizard-content">
                                <div id="step-1">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="Service">Wybierz usługę:</label>
                                                <select id="Service" name="service" class="form-control">
                                                    <?php foreach($services as $s): ?>
                                                    <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="Staff">Wybierz pracownika:</label>
                                                <select id="Staff" name="staff" class="form-control">
                                                    <option value="">Dowolna</option>
                                                    <option value="1">Heniek Szefuncio</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row mt-3">
                                        <div class="col-md-6">
                                            <div id="calendar"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="Hours">Wybierz godzinę:</label>
                                                <select id="Hours" name="hours" class="form-control">
                                                    
                                                </select>
                                            </div>

                                            <h4>Podsumowanie:</h4>
                                            <p id="ChooseSummary"></p>

                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="step-2">
                                    <div id="accordion" class="accordion-wrapper mb-3">
                                        <div class="card">
                                            <div id="headingOne" class="card-header">
                                                <button type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block">
                                                    <span class="form-heading">Twoje dane<p>Podaj swoje dane kontaktowe</p></span>
                                                </button>
                                            </div>
                                            <div data-parent="#accordion" id="collapseOne" aria-labelledby="headingOne" class="collapse show">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group">
                                                                <label for="telephone">Numer telefonu</label>
                                                                <input name="telephone" id="telephone" placeholder="" type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group">
                                                                <label for="email">E-mail</label>
                                                                <input name="email" id="email" type="email" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group">
                                                                <label for="firstname">Imię</label>
                                                                <input name="firstname" id="firstname" type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group">
                                                                <label for="lastname">Nazwisko</label>
                                                                <input name="lastname" id="lastname" type="text" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 
                                                    <div class="form-row">
                                                        <div class="col-md-6">
                                                            <div class="position-relative form-group"><label for="exampleCity">City</label><input name="city" id="exampleCity" type="text" class="form-control"></div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="position-relative form-group"><label for="exampleState">State</label><input name="state" id="exampleState" type="text" class="form-control"></div>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="position-relative form-group"><label for="exampleZip">Zip</label><input name="zip" id="exampleZip" type="text" class="form-control"></div>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card">
                                            <div id="headingTwo" class="card-header">
                                                <button type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="text-left m-0 p-0 btn btn-link btn-block">
                                                    <span class="form-heading">Płatność<p>Wybierz sposób płatności</p></span>
                                                </button>
                                            </div>
                                            <div data-parent="#accordion" id="collapseTwo" aria-labelledby="headingTwo" class="collapse show">
                                                <div class="card-body">
                                                    <div class="form-row">
                                                        <div class="col-md-12">
                                                            <fieldset class="position-relative form-group">
                                                                <div class="position-relative form-check">
                                                                    <label class="form-check-label">
                                                                        <input name="paymentmethod" type="radio" class="form-check-input" value="<?= PAYMENT_METHOD_CASH; ?>" checked="1" />
                                                                        Gotówka w lokalu
                                                                    </label>
                                                                </div>
                                                                <div class="position-relative form-check">
                                                                    <label class="form-check-label">
                                                                        <input name="paymentmethod" type="radio" class="form-check-input" value="<?= PAYMENT_METHOD_TPAY; ?>" />
                                                                        Płatność internetowa (Tpay)
                                                                    </label>
                                                                </div>
                                                            </fieldset>
                                                            <div id="tpay_banks" style="display:none;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div id="step-3">
                                    <div class="no-results">
                                        <div class="swal2-icon swal2-success swal2-animate-success-icon">
                                            <div class="swal2-success-circular-line-left" style="background-color: rgb(255, 255, 255);"></div>
                                            <span class="swal2-success-line-tip"></span>
                                            <span class="swal2-success-line-long"></span>
                                            <div class="swal2-success-ring"></div>
                                            <div class="swal2-success-fix" style="background-color: rgb(255, 255, 255);"></div>
                                            <div class="swal2-success-circular-line-right" style="background-color: rgb(255, 255, 255);"></div>
                                        </div>
                                        <div class="results-subtitle mt-4">Finished!</div>
                                        <div class="results-title">You arrived at the last form wizard step!</div>
                                        <div class="mt-3 mb-3"></div>
                                        <div class="text-center">
                                            <button class="btn-shadow btn-wide btn btn-success btn-lg">Finish</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="clearfix">
                            <button type="button" id="next-btn" class="btn-shadow btn-wide float-right btn-pill btn-hover-shine btn btn-primary">Next</button>
                            <button type="button" id="prev-btn" class="btn-shadow float-right btn-wide btn-pill mr-3 btn btn-outline-secondary">Previous</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/popper.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/tooltip.min.js'); ?>"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" src="<?= base_url('web/admin/plugins/jquery.blockUI.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/slick/slick.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/circle-progress.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/jquery.dataTables.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/dataTables.bootstrap4.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js'); ?>"></script>

    <script type="text/javascript" src="<?= base_url('web/admin/plugins/jquery-ui.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/sizzle.min.js'); ?>"></script>
    
    
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/metisMenu.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/toastr.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/push.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/plugins/serviceWorker.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('web/admin/scripts/notifications.js'); ?>"></script> 

    <script src="<?= base_url('web/admin/plugins/smartwizard/js/jquery.smartWizard.min.js'); ?>"></script>
    <script src="<?= base_url('web/admin/plugins/fullcalendar/core/main.js'); ?>"></script>
    <script src="<?= base_url('web/admin/plugins/fullcalendar/interaction/main.js'); ?>"></script>
    <script src="<?= base_url('web/admin/plugins/fullcalendar/daygrid/main.js'); ?>"></script>

    <script type="text/javascript" src="<?= base_url('web/admin/app.js'); ?>"></script> 

    <script type="text/javascript" src="https://secure.tpay.com/groups-<?= $this->config->item('tpay_merchant_id'); ?>1.js"></script>


    <script type="text/javascript">

    $(document).ready(() => {

        let service = '';
        let date = '<?= date('Y-m-d'); ?>';
        let payment_method = 0;
        let bank_channel = false;

        let reload = () => {

            let service_ref = $('#Service').val();
            let staff_ref = $('#Staff').val();

            $('#Hours').html('');

            $.ajax({
                url: '<?= base_url('api/hours/getOpenHoursByDateToWizard'); ?>',
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
                        
                    $('#Hours').append('<option value="'+el[0]+'">'+el[0]+'</option>');                  

                });
                

            });
        }
        reload();

        $('#Staff, #Service').on('change', reload);

        $('input[name="paymentmethod"]').on('click', () => {

            payment_method = $('input[name="paymentmethod"]:checked').val();

            if(payment_method == <?= PAYMENT_METHOD_TPAY; ?>) {
                $('#tpay_banks').slideDown();
            } else {
                $('#tpay_banks').slideUp();
            }

        });

        $('#smartwizard').smartWizard({
            selected: 0,
            useURLhash: false,
            keyNavigation: false,
            cycleSteps: false,
            toolbarSettings: {
                showNextButton: true,
                showPreviousButton: true
            },
            anchorSettings: {
                anchorClickable: true
            }
        });

        $("#smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            
            let sendData = {
                'step': stepNumber
            };

            if(stepNumber == 0)
            {
                sendData.service_ref = $('#Service').val();
                sendData.staff_ref = $('#Staff').val();
                sendData.date = date;
                sendData.time = $('#Hours').val();
            }

            return confirm("Do you want to leave the step "+stepNumber+"?");

            // walidacja w JS

            /*$.ajax({
                url: '<?= base_url('api/reservations/verifyWizardDataStep'); ?>',
                method: 'POST',
                dataType: 'json',
                data: sendData
            })
            .done((data) => {


                console.log(data);
            });*/

            //return false;

        });

        var calendarEl = document.getElementById('calendar');

        var today = new Date();

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
            unselectAuto: false,
            select: function(arg) {
                //this.select(arg.start);
                if(arg.start < today) {
                    date = false;
                    this.unselect(arg.jsEvent);
                    return;
                }

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

    function ShowChannels()
    {
        var str = '<div id="kanaly">';
       
        for(var i = 0; i < tr_groups.length; i++)
        {
            var id = 'bank'+tr_groups[i][0];
            var width_style = '';
            var idi = 'i_'+id;
            if(tr_groups[i][0] == 40) width_style = 'width:270px'; else width_style = '';
            str +='<div id="'+id+'" onclick=\'document.getElementById("'+idi+'").checked=true;bank_channel='+tr_groups[i][0]+';\' style="background-position:center;background-image:url('+tr_groups[i][3]+');'+width_style+'">';
            str +='<input id="'+idi+'" type="radio" value="'+tr_groups[i][0]+'" name="grupa" '; if (i==0) str +='checked="checked"  />'; else str += ' />';
            str += '<p class="label">'+
            '<label for="'+idi+'">'+tr_groups[i][1]+'</label>'+
            '</p>'+
            '</div>';
        }
        str += '</div>';
        document.getElementById('tpay_banks').innerHTML = str;
    }

    window.onload = ShowChannels;

    </script>

</body>
</html>