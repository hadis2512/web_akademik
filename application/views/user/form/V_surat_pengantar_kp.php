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
                                    <h3 class=" font-weight-bold">Formulir Pengajuan Surat Pengantar Kerja Praktik</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3 grid-margin transparent">
                            <div class="container">
                                <div class="card">
                                    <div class="card-body">
                                        <form class="forms-sample" action="<?= base_url('Buat-Surat/') . $jenis_permohonan; ?>" method="post">
                                            <div class="form-group row  ">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Nama Perusahaan</label>
                                                    <input type="text" class="form-control" name="nama_perusahaan" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Alamat Perusahaan</label>
                                                    <input type="text" class="form-control" name="alamat_perusahaan" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                            </div>
                                            <div class="form-group row  ">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Perwakilan Perusahaan</label>
                                                    <input type="text" class="form-control" name="perwakilan" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Jabatan Perwakilan</label>
                                                    <input type="text" class="form-control" name="jabatan_perwakilan" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                            </div>
                                            <div class="form-group ">

                                                <label for="exampleInputUsername1">No Telepon Perusahaan</label>
                                                <input type="text" class="form-control" name="no_telp_perusahaan" id="exampleInputUsername1" placeholder="Entry Here's">

                                            </div>
                                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                            <button class="btn btn-light">Cancel</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-center">
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