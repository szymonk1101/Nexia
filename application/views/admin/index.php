
<?php $this->load->view('admin/partials/header'); ?>

                <div class="app-main__inner">
                    <div class="app-page-title">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div class="page-title-icon">
                                    <i class="pe-7s-home icon-gradient bg-mean-fruit"></i>
                                </div>
                                <div>
                                    Kokpit
                                    <div class="page-title-subheading">Główne miejsce w systemie, wyświetlające najważniejsze informacje na bieżąco.</div>
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


                        <div class="row">
                            <div class="col-md-12">

                                <?php print_r($free); ?>

                                <?php

                                ?>

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Plan na dzisiaj</h5>
                                        <div class="scroll-area-lg">
                                            <div class="scrollbar-container">
                                                <div class="vertical-time-icons vertical-timeline vertical-timeline--animate vertical-timeline--one-column">
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-primary"><i class="lnr-license icon-gradient bg-night-fade"></i></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4>
                                                                <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-warning"><i class="lnr-cog fa-spin icon-gradient bg-happy-itmeo"></i></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Another meeting today, at <b class="text-danger">12:00 PM</b></p>
                                                                <p>Yet another one, at <span class="text-success">15:00 PM</span></p></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-success"><i class="lnr-cloud-upload icon-gradient bg-plum-plate"></i></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">Build the production release</h4>
                                                                <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-primary"><i class="lnr-license text-primary"></i></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">All Hands Meeting</h4>
                                                                <p>Lorem ipsum dolor sic amet, today at <a href="javascript:void(0);">12:00 PM</a></p></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-success bg-success"><svg aria-hidden="true" data-prefix="fas" data-icon="coffee"
                                                                                                                                                                                class="fa fa-coffee text-white"
                                                                                                                                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path
                                                                fill="currentColor"
                                                                d="M192 384h192c53 0 96-43 96-96h32c70.6 0 128-57.4 128-128S582.6 32 512 32H120c-13.3 0-24 10.7-24 24v232c0 53 43 96 96 96zM512 96c35.3 0 64 28.7 64 64s-28.7 64-64 64h-32V96h32zm47.7 384H48.3c-47.6 0-61-64-36-64h583.3c25 0 11.8 64-35.9 64z"></path></svg></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title text-success">FontAwesome Icons</h4>
                                                                <p>Lorem ipsum dolor sit amit,consectetur elit enim at minim veniam quis nostrud</p></div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon border-warning bg-warning"><svg aria-hidden="true" data-prefix="fas" data-icon="archive"
                                                                                                                                                                                class="fa fa-archive fa-w-16 text-white"
                                                                                                                                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path
                                                                fill="currentColor"
                                                                d="M32 448c0 17.7 14.3 32 32 32h384c17.7 0 32-14.3 32-32V160H32v288zm160-212c0-6.6 5.4-12 12-12h104c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H204c-6.6 0-12-5.4-12-12v-8zM480 32H32C14.3 32 0 46.3 0 64v48c0 8.8 7.2 16 16 16h480c8.8 0 16-7.2 16-16V64c0-17.7-14.3-32-32-32z"></path></svg></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><h4 class="timeline-title">Build the production release</h4>
                                                                <p>Lorem ipsum dolor sit amit,consectetur eiusmdd tempor incididunt ut labore et dolore magna elit enim at minim veniam quis nostrud</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="vertical-timeline-item vertical-timeline-element">
                                                        <div><span class="vertical-timeline-element-icon bounce-in"><div class="timeline-icon bg-danger border-danger"><i class="pe-7s-cloud-upload text-white"></i></div></span>
                                                            <div class="vertical-timeline-element-content bounce-in"><p>Another meeting today, at <b class="text-warning">12:00 PM</b></p>
                                                                <p>Yet another one, at <span class="text-dark">15:00 PM</span></p></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Nowe rezerwacje</h5>
                                        <div class="scroll-area-lg">
                                            <div class="scrollbar-container">
                                                <ul class="list-group">
                                                    <?php foreach($last_reservations as $res): ?>
                                                    <li class="list-group-item">
                                                        <div class="widget-content p-0">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left">
                                                                    <div class="widget-heading"><?= $res->service_name.' - <a href="#">'.$res->user_email.'</a>'; ?></div>
                                                                    <div class="widget-subheading">
                                                                        <?= $res->date.', '.cutTimeToMinutes($res->time_from).' - '.cutTimeToMinutes($res->time_to); ?>
                                                                        <?= ($res->staff_ref) ? ', '.$res->staff_email : ''; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="widget-content-right">
                                                                    <div role="group" class="btn-group-sm btn-group">
                                                                        <button type="button" class="btn-shadow btn btn-success">Potwierdź</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">   
                                    <div class="card-body">
                                        <h5 class="card-title">Kalendarzyk</h5>
                                        <div id="calendar-list"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <h5 class="card-title">Aktualnie w pracy</h5>
                                        <div class="table-responsive">
                                            <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th class="text-center">Status</th>
                                                        <th class="text-center">Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">John Doe</div>
                                                                        <div class="widget-subheading opacity-7">Web Developer</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="badge badge-warning">Zajęty</div>
                                                        </td>
                                                        <td class="text-center" style="width: 150px;">
                                                            <div class="pie-sparkline">2,4,6,9,4</div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="widget-content p-0">
                                                                <div class="widget-content-wrapper">
                                                                    <div class="widget-content-left mr-3">
                                                                        <div class="widget-content-left">
                                                                            <img width="40" class="rounded-circle" src="assets/images/avatars/3.jpg" alt="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="widget-content-left flex2">
                                                                        <div class="widget-heading">Ruben Tillman</div>
                                                                        <div class="widget-subheading opacity-7">Etiam sit amet orci eget</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="badge badge-success">Wolny</div>
                                                        </td>
                                                        <td class="text-center" style="width: 150px;">
                                                            <div id="sparkline-chart4"></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<?php $this->load->view('admin/partials/footer'); ?>