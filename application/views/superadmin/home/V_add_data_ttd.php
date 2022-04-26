<?php $this->load->view('superadmin/components/V_header') ?>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <?php $this->load->view('superadmin/components/V_sidebar'); ?>
        <!-- Sidebar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <?php $this->load->view('superadmin/components/V_topbar'); ?>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Mahasiswa</h1>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Forms</li>
                            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
                        </ol>
                    </div>
                    <?= $this->session->flashdata('msg'); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"></h6>
                                </div> -->
                                <div class="card-body">
                                    <form action="<?= base_url('superadmin/Master_data/save_ttd'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group row">
                                            <label for="nama_lengkap" class="col-sm-2 col-form-label ">Nama Lengkap</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Enter nama lengkap">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label ">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="email" name="jabatan" placeholder="Enter the jabatan">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">Jenis Permohonan</legend>
                                                <?php
                                                foreach ($jenis_permohonan as $a) { ?>
                                                    <div class="col-sm-3">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pilihan<?= $a['id'] ?>" name="jenis_permohonan" value="<?= $a['id'] ?>" class="custom-control-input">
                                                            <label class="custom-control-label" for="pilihan<?= $a['id'] ?>"><?= $a['nama'] ?></label>
                                                        </div>
                                                    </div>
                                                <?php }
                                                ?>
                                            </div>
                                        </fieldset>
                                        <div class="form-group">
                                            <label for="foto" class="col-sm-2  col-form-label">Tanda Tangan</label>
                                            <div class="custom-file col-sm-9">
                                                <input type="file" name="foto" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile">Choose File</label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group d-flex justify-content-center ">

                                            <button type="submit" class="px-5 mt-2 btn btn-primary">Save</button>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!--Row-->

                    <!-- Documentation Link -->

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                    <a href="login.html" class="btn btn-primary">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <?php $this->load->view('superadmin/components/V_footer') ?>