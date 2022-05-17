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


                            <hr>

                            <div class="my-4 d-flex justify-content-end">
                                <a class="btn btn-inverse-dark mr-3" href="#" data-target="#createF" data-toggle="modal"><i class="icon-plus mr-3 "></i><b>Buat Pengajuan</b></a>
                                <!-- <a href="" class="btn btn-inverse-info "><i class="icon-grid mr-3"></i>View More</a> -->
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


                            <div class="row" id="formulirM" data-pengguna="<?= $id_pengguna; ?>">



                            </div>
                            <div class="modal fade bd-example-modal-lg modalDetail_form" id="modalDetail_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="data_modal">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-3">
                                <button type="button" class="btn btn-inverse-info" id="loadmore">Load More</button>
                            </div>
                            <hr>

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