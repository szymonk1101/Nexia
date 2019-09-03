
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Rezerwacje
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
                                        <h5 class="card-title">Utwórz nową rezerwację</h5>

                                        <?php $this->load->view('admin/partials/alerts'); ?>

                                        <form class="" method="POST" action="<?= base_url('admin/reservations/create'); ?>">
                                            <div class="position-relative row form-group"><label for="service_ref" class="col-sm-2 col-form-label">Usługa</label>
                                                <div class="col-sm-10">
                                                    <select name="service_ref" id="service_ref" class="form-control">
                                                    <option value="">Wybierz..</option>
                                                    <?php foreach($services as $s): ?>
                                                        <option value="<?= $s->id; ?>" data-duration="<?= $s->duration; ?>"><?= $s->name; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="date" class="col-sm-2 col-form-label">Data</label>
                                                <div class="col-sm-10">
                                                    <input name="date" id="date" placeholder="" type="text" class="form-control" value="<?= set_value('date'); ?>" data-toggle="datepicker" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="time" class="col-sm-2 col-form-label">Godzina</label>
                                                <div class="col-sm-10">
                                                    <input name="time" id="time" placeholder="HH:MM" type="text" class="form-control timepicker" value="<?= set_value('time'); ?>" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="duration" class="col-sm-2 col-form-label">Czas trwania</label>
                                                <div class="col-sm-10">
                                                    <input name="duration" id="duration" placeholder="" type="number" class="form-control" value="<?= set_value('duration'); ?>" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="user_ref" class="col-sm-2 col-form-label">Klient</label>
                                                <div class="col-sm-10">
                                                    <input name="user_ref" id="user_ref" placeholder="" type="text" class="form-control" value="<?= set_value('user_ref'); ?>" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="staff_ref" class="col-sm-2 col-form-label">Pracownik</label>
                                                <div class="col-sm-10">
                                                    <select name="staff_ref" id="staff_ref" class="form-control">
                                                    <option value="">Brak</option>
                                                    <?php foreach($staff as $s): ?>
                                                        <option value="<?= $s->id; ?>"><?= $s->email; ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="confirmed" class="col-sm-2 col-form-label">Potwierdzona</label>
                                                <div class="col-sm-10">
                                                    <div class="position-relative form-check">
                                                        <label class="form-check-label"><input name="confirmed" id="confirmed" type="checkbox" class="form-check-input" /> &nbsp;</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="paid" class="col-sm-2 col-form-label">Opłacona</label>
                                                <div class="col-sm-10">
                                                    <div class="position-relative form-check">
                                                        <label class="form-check-label"><input name="paid" id="paid" type="checkbox" class="form-check-input" /> &nbsp;</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="position-relative row form-check mt-5">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-primary">Utwórz</button>
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
    'web/admin/plugins/datepicker.min.js',
    'web/admin/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js',
    'web/admin/scripts/views/reservations_create.js'
)); 
?>

<?php $this->load->view('admin/partials/footer'); ?>