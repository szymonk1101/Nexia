
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Usługi
                                    <div class="page-title-subheading">Wszystko na temat oferowanych usług.</div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="<?= base_url('admin/services/add'); ?>">
                                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-success">
                                    <i class="fa fa-plus"></i>
                                </button></a>
                                <div class="d-inline-block dropdown">
                                    <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn-shadow dropdown-toggle btn btn-info">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="fa fa-business-time fa-w-20"></i>
                                        </span>
                                        Buttons
                                    </button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link">
                                                    <i class="nav-link-icon lnr-inbox"></i>
                                                    <span>
                                                        Inbox
                                                    </span>
                                                    <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link">
                                                    <i class="nav-link-icon lnr-book"></i>
                                                    <span>
                                                        Book
                                                    </span>
                                                    <div class="ml-auto badge badge-pill badge-danger">5</div>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link">
                                                    <i class="nav-link-icon lnr-picture"></i>
                                                    <span>
                                                        Picture
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a disabled class="nav-link disabled">
                                                    <i class="nav-link-icon lnr-file-empty"></i>
                                                    <span>
                                                        File Disabled
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="main-card mb-3 card">   
                                    <div class="card-body">
                                        <h5 class="card-title"></h5>
                                        <table style="width:100%" id="services_datatable" class="table table-hover table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nazwa</th>
                                                    <th>Kategoria</th>
                                                    <th>Cena</th>
                                                    <th>Czas trwania</th>
                                                    <th>Status</th>
                                                    <th>Akcje</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nazwa</th>
                                                    <th>Kategoria</th>
                                                    <th>Cena</th>
                                                    <th>Czas trwania</th>
                                                    <th>Status</th>
                                                    <th>Akcje</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                    </div>
                </div>

<script type="text/javascript">

var services_datatable_ajax_url = '<?= base_url('admin/services/getServicesDataTable'); ?>';

</script>

<?php
JavascriptManager::add(array(
    
    'web/admin/scripts/views/services_index.js'
)); 
?>

<?php $this->load->view('admin/partials/footer'); ?>