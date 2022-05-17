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
                                    <h3 class=" font-weight-bold">Data Surat</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 grid-margin transparent">


                            <hr>



                            <div class="row" id="suratM" data-pengguna="<?= $id_pengguna; ?>">


                            </div>
                            <div class="modal fade bd-example-modal-lg modalDetail_form" id="modalDetail_form" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content" id="data_modal">

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center my-3">
                                <button type="button" class="btn btn-inverse-info" id="loadmore1">Load More</button>
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