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
                                <div class="col-12 col-xl-8 mb-4 mb-xl-3">
                                    <h3 class=" font-weight-bold">Data Formulir</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 grid-margin transparent">
                            <div class="container">
                                <div class="header d-flex justify-content-between">
                                    <h3 class="font-weight-light ">Latest Data</h3>
                                    <a class="btn btn-inverse-dark" href="#" data-target="#createF" data-toggle="modal"><i class="icon-plus mr-3 "></i><b>Buat Pengajuan</b></a>
                                </div>
                                <hr>
                                <div class="my-4 d-flex flex-row-reverse">
                                    <a href="" class="btn btn-inverse-info btn-sm "><i class="icon-grid mr-3"></i>View More</a>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="createF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="width: 1000px;" role="document">
                                        <div class="modal-content">
                                            <!-- <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Pengajuan Form</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div> -->
                                            <div class="modal-body d-flex justify-content-around">
                                                <?php foreach ($jenis_p as $a) { ?>
                                                    <div class="card border">
                                                        <a class="card btn btn-outline-info m-1" style="height: 250px;width:250px;" href="createSurat/<?= $a['id']; ?>">
                                                            <span class="my-auto"><?= $a['nama']; ?></span>
                                                        </a>
                                                    </div>
                                                <?php } ?>

                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>


                                <div class="row">

                                    <?php
                                    foreach ($form as $a) {
                                        if ($a['approval'] == 0) {
                                            $approval = '<p class="mb-0" class="card" style="background: yellow;width:25px;height:20px;"></p>';
                                        } elseif ($a['approval'] == 1) {
                                            $approval = '<p class="mb-0" class="card" style="background: green;width:25px;height:20px;"></p>';
                                        } elseif ($a['approval'] == 2) {
                                            $approval = '<p class="mb-0" class="card" style="background: success;width:25px;height:20px;"></p>';
                                        }
                                    ?>
                                        <div class="col-md-4 mb-2 stretch-card transparent">
                                            <div class="card card-tale">
                                                <div class="card-header d-flex justify-content-between">
                                                    <p class="mb-0"><?= $a['no_form']; ?></p>
                                                    <?= $approval . ' ' . $a['approval']; ?>

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
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
                    </div>
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span>
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