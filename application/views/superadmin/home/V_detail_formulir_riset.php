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
                    <div class="d-sm-flex align-items-center justify-content-between ml-1 mb-4">
                        <?php if ($surat_riset['approval_admin'] == 0) {
                            $status = '<h4 class="text-warning ">(Not Approval)</h4>';
                        } elseif ($surat_riset['approval_admin'] == 1) {
                            $status = '<h4 class="text-success">(Approval)</h4>';
                        } elseif ($surat_riset['approval_admin'] == 2) {
                            $status = '<h4 class="text-danger">(Duplicate)</h4>';
                        } ?>
                        <div>
                            <h4 class=" mb-0 text-gray"> <b><?= $surat_riset['no_form']; ?></b></h4><?= $status; ?>
                        </div>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin-data-formulir') ?>">Data Formulir</a></li>
                            <li class="breadcrumb-item">Data Formulir Riset</li>
                        </ol>

                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-center ">
                                <div class="card w-100">
                                    <form class="forms-sample col-lg-12">

                                        <div id="accordion">
                                            <p id="akordion" class="akordion-child my-4 " style="cursor:pointer;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <b>Data Mahasiswa</b> <i class="fas fa-arrow-right ml-2"></i>
                                            </p>


                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1">NIM</label>
                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['nim']; ?>" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1" class="">Nama</label>
                                                        <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['nama_lengkap']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1">Program</label>
                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Program" value="<?= $surat_riset['nama_program']; ?>" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1" class="">Program Studi</label>
                                                        <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Prodi" value="<?= $surat_riset['nama_prodi']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label for="tempat">Tempat</label>
                                                        <input type="text" class="form-control" id="tempat" placeholder="Tempat" value="<?= $surat_riset['tempat']; ?>" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="tgl">Tanggal Lahir</label>
                                                        <input type="text" class="form-control" id="tgl" placeholder="tgl_lahir" value="<?= $surat_riset['tgl_lahir']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1">Alamat</label>
                                                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['alamat']; ?>" readonly>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label for="exampleInputUsername1" class="">No Telepon</label>
                                                        <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['no_telp']; ?>" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group row ">
                                            <div class="col-lg-6">
                                                <label for="exampleInputUsername1">Jenis Permohonan</label>
                                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['jenis_permohonan']; ?>" readonly>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="exampleInputUsername1" class="">Jenis Tugas</label>
                                                <input type="text" class="form-control " id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['jenis_tugas']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label for="exampleInputUsername1">Judul Tugas</label>
                                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Username" value="<?= $surat_riset['judul_tugas']; ?>" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group d-flex justify-content-center">
                                            <?php if ($surat_riset['approval_admin'] == 0) { ?>
                                                <a href="<?= base_url('superadmin/master_data/duplicate/') . $surat_riset['id_formulir'] . '/' . $id_jenis_p; ?>" type="button" class="btn btn-danger mr-2" class="tolak">Duplicate</a>
                                                <a href="<?= base_url('superadmin/master_data/validate/') . $surat_riset['id_formulir'] . '/' . $id_jenis_p; ?>" type="button" class="btn btn-success" class="setuju">Validate</a>
                                            <?php } elseif ($surat_riset['approval_admin'] == 2) { ?>
                                                <button type="button" class="btn btn-danger mr-2" class="tolak" disabled>Duplicate</button>
                                                <a href="<?= base_url('superadmin/master_data/validate/') . $surat_riset['id_formulir'] . '/' . $id_jenis_p; ?>" type="button" class="btn btn-success" class="setuju">Validate</a>
                                            <?php } elseif ($surat_riset['approval'] && $surat_riset['approval_admin'] == 1) { ?>
                                                <a href="<?= base_url('superadmin/master_data/create_surat/') . $surat_riset['id_formulir'] . '/' . $id_jenis_p; ?>" type="button" class="btn btn-success" class="setuju">Buat Surat</a>
                                            <?php } ?>


                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--Row-->


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