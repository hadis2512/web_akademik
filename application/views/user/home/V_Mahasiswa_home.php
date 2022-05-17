<?php $this->load->view('user/components/V_header'); ?>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php $this->load->view('user/components/V_navbar'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <?php $this->load->view('user/components/V_sidebar_m'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Selamat Datang,</h3>
                                    <h3 class="font-weight-bold"><?= $this->session->userdata('nama'); ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="my-4 d-flex flex-row-reverse">
                        <?= $view_more; ?>
                    </div>


                    <div class="row">
                        <?php
                        foreach ($form as $a) {
                            if ($a['approval'] == 0) {
                                $approval = '<div class="badge badge-warning align-self-start">Not Approve</div>';
                                if ($a['approval_admin'] == 2) {
                                    $approval = '<div class="badge badge-danger">Reject</div>';
                                }
                            } elseif ($a['approval'] == 1) {
                                $approval = '<div class="badge badge-success">Approve</div>';
                                if ($a['approval_admin'] == 2) {
                                    $approval = '<div class="badge badge-danger">Reject</div>';
                                }
                            } elseif ($a['approval'] == 2 && $a['approval_admin'] == 2) {
                                $approval = '<div class="badge badge-danger">Reject</div>';
                            }
                        ?>
                            <div class="col-md-4 mb-2 stretch-card transparent">
                                <div class="card card-light-blue">
                                    <div class="card-header d-flex justify-content-between">
                                        <p class="mb-0"><?= $a['no_form']; ?></p>
                                        <?= $approval; ?>

                                    </div>
                                    <div class="card-body">
                                        <h4 class="mb-2"><?= $a['jenis_permohonan']; ?></h4>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between">
                                        <p class="mb-0">
                                            <?php
                                            $now = date('d F y');
                                            $tgl_lapor = date('d F y  ', strtotime($a['created_at']));
                                            $datediff = $User->dateDifference($tgl_lapor, $now);
                                            echo $datediff . ' hari yang lalu';

                                            ?>
                                        </p>
                                        <a href="#" id="modal_detail" data-toggle="modal" data-target="#modalDetail_form" name="" data-jenis="<?= $a['id_jenis_permohonan']; ?>" data-formulir="<?= $a['id_formulir']; ?>" class="test font-weight-bold text-light float-right">details<i class="ml-2 icon-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>
                    <div class="modal fade bd-example-modal-lg modalDetail_form" id="modalDetail_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content" id="data_modal">

                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">

                    <div class="d-sm-flex justify-content-center ">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright Kalbis Institute © 2021.</span>

                    </div>

                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php $this->load->view('user/components/V_footer'); ?>