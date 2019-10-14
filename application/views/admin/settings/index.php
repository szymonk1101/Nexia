
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Ustawienia
                                    <div class="page-title-subheading">Lorem ipsum.</div>
                                </div>
                            </div>
                            <div class="page-title-actions">
                                <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom" class="btn-shadow mr-3 btn btn-dark">
                                    <i class="fa fa-star"></i>
                                </button>
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
                                <a role="tab" class="nav-link" id="tab-staff" data-toggle="tab" href="#tab-content-staff">
                                    <span>Pracownicy</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a role="tab" class="nav-link" id="tab-hours" data-toggle="tab" href="#tab-content-hours">
                                    <span>Godziny</span>
                                </a>
                            </li>
                        </ul>

                        <?php $this->load->view('admin/partials/alerts'); ?>

                        <div class="tab-content">

                            <div class="tab-pane tabs-animation fade show active" id="tab-content-main" role="tabpanel">
                                <form action="<?= base_url('admin/settings/save'); ?>" method="POST" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">   
                                                <div class="card-body">
                                                    <h5 class="card-title">Informacje ogólne</h5>
                                                    
                                                    <div class="position-relative row form-group">
                                                        <label for="company_name" class="col-sm-2 col-form-label">Nazwa</label>
                                                        <div class="col-sm-10">
                                                            <input name="company_name" id="company_name" placeholder="" type="text" class="form-control" value="<?= isset($setting['company_name']) ? $setting['company_name']->value_str : ''; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group">
                                                        <label for="company_shortname" class="col-sm-2 col-form-label">Skrócona nazwa</label>
                                                        <div class="col-sm-10">
                                                            <input name="company_shortname" id="company_shortname" placeholder="" type="text" class="form-control" value="<?= isset($setting['company_shortname']) ? $setting['company_shortname']->value_str : ''; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group">
                                                        <label for="company_logo" class="col-sm-2 col-form-label">Logo</label>
                                                        <div class="col-sm-10">
                                                            <input name="company_logo" id="company_logo" type="file" class="form-control-file" value="<?= set_value('company_logo'); ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="position-relative row form-group">
                                                        <label for="company_active" class="col-sm-2 col-form-label">Aktywna</label>
                                                        <div class="col-sm-10">
                                                            <select name="company_active" id="company_active" class="form-control">
                                                                <option value="1" <?= (isset($setting['company_active']) && $setting['company_active']->value == 1) ? 'selected' : ''; ?> >Tak</option>
                                                                <option value="0" <?= (isset($setting['company_active']) && $setting['company_active']->value == 0) ? 'selected' : ''; ?> >Nie</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="d-block text-right card-footer">
                                                    <button class="btn btn-success btn-lg">Zapisz</button>
                                                </div>
                                            </div>
                                        </div>
								    </div>
                                </form>
                            </div>
							
                            <div class="tab-pane tabs-animation fade" id="tab-content-staff" role="tabpanel">
								<div class="row">
									<div class="col-md-12">
										<div class="main-card mb-3 card">   
											<div class="card-body">
												<h5 class="card-title">G</h5>
												
												<div class="position-relative row form-group">
													<label for="staff_multi_reservations" class="col-sm-2 col-form-label">Zezwalaj na kilka rezerwacji w jednej chwili</label>
													<div class="col-sm-10">
														<select name="staff_multi_reservations" id="staff_multi_reservations" class="form-control">
															<option value="1" <?= set_select('staff_multi_reservations', 1, TRUE); ?> >Tak</option>
															<option value="0" <?= set_select('staff_multi_reservations', 0); ?> >Nie</option>
														</select>
													</div>
												</div>
												<div class="position-relative row form-group">
													<label for="staff_breaks" class="col-sm-2 col-form-label">Zezwalaj na przerwy</label>
													<div class="col-sm-10">
														<select name="staff_breaks" id="staff_breaks" class="form-control">
															<option value="1" <?= set_select('staff_breaks', 1, TRUE); ?> >Tak</option>
															<option value="0" <?= set_select('staff_breaks', 0); ?> >Nie</option>
														</select>
													</div>
												</div>
												
												
												
											</div>
										</div>
									</div>
								</div>
                            </div>
							
                            <div class="tab-pane tabs-animation fade" id="tab-content-hours" role="tabpanel">
                                Godziny
                            </div>

                        </div>
                    </div>
                </div>

<?php $this->load->view('admin/partials/footer'); ?>