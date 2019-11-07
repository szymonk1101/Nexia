
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Przerwy
                                    <div class="page-title-subheading"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">   
                                    <div class="card-body">
                                        <h5 class="card-title">Dodaj przerwę</h5>

                                        <?php $this->load->view('admin/partials/alerts'); ?>

                                        <form class="" method="POST" action="<?= base_url('admin/breaks/add'); ?>">

                                            <?php if(isset($term_not_free) && !empty($term_not_free)): ?>
                                            <input type="hidden" name="confirm_error" value="1" />
                                            <div class="alert alert-success" role="alert">
                                                <p><?= $term_not_free; ?></p>
                                                <hr>
                                                <button class="btn btn-success">Utwórz rezerwację mimo wszystko</button>
                                            </div>
                                            <?php endif; ?>
      
                                            <div class="position-relative row form-group"><label for="date" class="col-sm-2 col-form-label">Data</label>
                                                <div class="col-sm-10">
                                                    <input name="date" id="date" placeholder="" type="text" class="form-control" value="<?= set_value('date'); ?>" data-toggle="datepicker" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="time_from" class="col-sm-2 col-form-label">Godzina rozpoczęcia</label>
                                                <div class="col-sm-10">
                                                    <input name="time_from" id="time_from" placeholder="HH:MM" type="text" class="form-control timepicker" value="<?= set_value('time_from'); ?>" />
                                                </div>
                                            </div>
                                            <div class="position-relative row form-group"><label for="time_to" class="col-sm-2 col-form-label">Godzina zakończenia</label>
                                                <div class="col-sm-10">
                                                    <input name="time_to" id="time_to" placeholder="HH:MM" type="text" class="form-control timepicker" value="<?= set_value('time_to'); ?>" />
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