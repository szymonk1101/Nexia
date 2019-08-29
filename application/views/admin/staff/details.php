
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="mr-4">
                                    <img width="80" class="rounded-circle" src="<?= base_url($this->config->item('avatars_path').$user->avatar); ?>" alt="" />
                                </div>
                                <div>
                                    <?= $user->email; ?>
                                    <div class="page-title-subheading"><?= $user->rank; ?></div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <a href="<?= base_url('admin/staff/add'); ?>">
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

                        <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                            <li class="nav-item">
                                <a role="tab" class="nav-link active" id="tab-main" data-toggle="tab" href="#tab-content-main">
                                    <span>Ogólne</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-hours" data-toggle="tab" href="#tab-content-hours">
                                    <span>Godziny</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-reservations" data-toggle="tab" href="#tab-content-reservations">
                                    <span>Rezerwacje</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-statistics" data-toggle="tab" href="#tab-content-statistics">
                                    <span>Statystyki</span>
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane tabs-animation fade show active" id="tab-content-main" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">   
                                            <div class="card-body">
                                                <h5 class="card-title">Podstawowe dane</h5>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>ID</th>
                                                        <td><?= $user->id; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>E-mail</th>
                                                        <td><?= $user->email; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Telefon</th>
                                                        <td><?= $user->telephone; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Data rejestracji</th>
                                                        <td><?= $user->created; ?></td>
                                                    </tr>
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane tabs-animation fade" id="tab-content-hours" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">   
                                            <div class="card-body">
                                                <h5 class="card-title">Godziny</h5>
                                                <table style="width:100%" id="openhours_datatable" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nazwa</th>
                                                            <th>Ważny od</th>
                                                            <th>Ważny do</th>
                                                            <th>Akcje</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Nazwa</th>
                                                            <th>Ważny od</th>
                                                            <th>Ważny do</th>
                                                            <th>Akcje</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="main-card mb-3 card">   
                                            <div class="card-body">
                                                <h5 class="card-title">Wyjątki</h5>
                                                <table style="width:100%" id="exceptions_datatable" class="table table-hover table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data</th>
                                                            <th>Godziny otwarcia</th>
                                                            <th>Akcje</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Data</th>
                                                            <th>Godziny otwarcia</th>
                                                            <th>Akcje</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane tabs-animation fade" id="tab-content-reservations" role="tabpanel">
                                Rezerwacje
                            </div>
                            <div class="tab-pane tabs-animation fade" id="tab-content-statistics" role="tabpanel">
                                Staty
                            </div>

                        </div>

                        

                    </div>
                </div>

<script type="text/javascript">

var STAFF_ID = '<?= $staff_id; ?>';
var openhours_datatable_ajax_url = '<?= base_url('admin/hours/getStaffOpenHoursDataTable'); ?>';
var exceptions_datatable_ajax_url = '<?= base_url('admin/hours/getStaffExceptionsDataTable'); ?>';

</script>

<?php
JavascriptManager::add(array(
    'web/admin/scripts/views/staff_details.js'
)); 
?>

<?php $this->load->view('admin/partials/footer'); ?>