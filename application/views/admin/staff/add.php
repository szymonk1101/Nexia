
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Dodaj pracownika
                                    <div class="page-title-subheading">Lorem ipsum.</div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">   
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        
                                        <?php $this->load->view('admin/partials/alerts'); ?>

                                        <form class="" method="POST" action="<?= base_url('admin/staff/add'); ?>">
                                            <div class="position-relative row form-group">
                                                <label for="name" class="col-sm-2 col-form-label">E-mail</label>
                                                <div class="col-sm-10">
                                                    <input name="email" id="email" placeholder="Podaj e-mail nowego pracownika" type="email" class="form-control" />
                                                </div>
                                            </div>

                                            <div class="position-relative row form-check mt-5">
                                                <div class="col-sm-12 text-center">
                                                    <button class="btn btn-success">Dodaj</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

<script type="text/javascript">

var staff_datatable_ajax_url = '<?= base_url('admin/staff/getStaffDataTable'); ?>';
var staff_details_url = '<?= base_url('admin/staff/details/'); ?>';

</script>

<?php
JavascriptManager::add(array(
    
    'web/admin/scripts/views/staff_index.js'
)); 
?>

<?php $this->load->view('admin/partials/footer'); ?>