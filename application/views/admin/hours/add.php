
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Godziny dostępności
                                    <div class="page-title-subheading">Tutaj możesz zarządzać dostępnością firmy, poszczególnych usług oraz pracowników.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">   
                                    <div class="card-body">
                                        <h5 class="card-title">Dodaj nowe godziny</h5>

                                        <?php $this->load->view('admin/partials/alerts'); ?>

                                        <form class="" method="POST" action="<?= base_url('admin/hours/add'); ?>">
                                            <div class="position-relative row form-group"><label for="name" class="col-sm-2 col-form-label">Nazwa</label>
                                                <div class="col-sm-10"><input name="name" id="name" placeholder="" type="text" class="form-control"></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="valid_from" class="col-sm-2 col-form-label">Ważne od</label>
                                                <div class="col-sm-10">
                                                    <input name="valid_from" id="valid_from" placeholder="" type="text" class="form-control input-mask-trigger" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd hh:mm:ss" im-insert="false">
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="valid_to" class="col-sm-2 col-form-label">Ważne do</label>
                                                <div class="col-sm-10"><input name="valid_to" id="valid_to" placeholder="" type="text" class="form-control input-mask-trigger" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd hh:mm:ss" im-insert="false"></div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="staff_ref" class="col-sm-2 col-form-label">Przypisane do pracownika</label>
                                                <div class="col-sm-10">
                                                    <select multiple="" name="staff_ref[]" id="staff_ref" class="form-control">
                                                    <?php foreach($staff as $s): ?>
                                                        <option value="<?= $s->id; ?>"><?= $s->email; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="service_ref" class="col-sm-2 col-form-label">Przypisane do usługi</label>
                                                <div class="col-sm-10">
                                                    <select multiple="" name="service_ref[]" id="service_ref" class="form-control">
                                                    <?php foreach($services as $s): ?>
                                                        <option value="<?= $s->id; ?>"><?= $s->name; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Poniedziałek</label>
                                                        <div class="col-sm-5">
                                                            <input name="mon_from" id="mon_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="mon_to" id="mon_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Wtorek</label>
                                                        <div class="col-sm-5">
                                                            <input name="tue_from" id="tue_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="tue_to" id="tue_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Środa</label>
                                                        <div class="col-sm-5">
                                                            <input name="wed_from" id="wed_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="wed_to" id="wed_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Czwartek</label>
                                                        <div class="col-sm-5">
                                                            <input name="thu_from" id="thu_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="thu_to" id="thu_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Piątek</label>
                                                        <div class="col-sm-5">
                                                            <input name="fri_from" id="fri_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="fri_to" id="fri_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Sobota</label>
                                                        <div class="col-sm-5">
                                                            <input name="sat_from" id="sat_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="sat_from" id="sat_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="position-relative row form-group">
                                                        <label for="exampleFile" class="col-sm-2 col-form-label">Niedziela</label>
                                                        <div class="col-sm-5">
                                                            <input name="sun_from" id="sun_from" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <input name="sun_to" id="sun_to" placeholder="HH:MM" type="text" class="form-control timepicker">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-check mt-5">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-primary">Dodaj</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

<?php
JavascriptManager::add(array(
    'web/admin/plugins/jquery.inputmask.min.js',
    'web/admin/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js',
    'web/admin/scripts/views/hours_add.js'
)); 
?>

<?php $this->load->view('admin/partials/footer'); ?>