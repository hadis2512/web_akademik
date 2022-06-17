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
                            <li class="breadcrumb-item"><a href="<?= base_url("admin-data-mahasiswa"); ?>">Data Mahasiswa</a></li>
                            <li class="breadcrumb-item active">Add Mahasiswa</li>
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
                                    <form action="<?= base_url('superadmin/Master_data/save_mahasiswa'); ?>" id="form_add-mhs" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group row">
                                            <label for="nim" class="col-sm-2 col-form-label">NIM </label>
                                            <div class="col-sm-3">
                                                <input type="text" name="nim" class="form-control" id="nim" placeholder="Nomor Induk Mahasiswa">
                                            </div>

                                            <label for="nama_lengkap" class="col-sm-2 col-form-label ml-5">Nama Lengkap</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label ">Email</label>
                                            <div class="col-sm-3">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email">
                                            </div>
                                            <label for="inputPassword3" class="col-sm-2 col-form-label ml-5">Password</label>
                                            <div class="col-sm-3">
                                                <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">Jenis Kelamin</legend>
                                                <div class="col-sm-3">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio1" name="jenis_kelamin" value="Pria" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio1">Pria</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="customRadio2" name="jenis_kelamin" value="Wanita" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadio2">Wanita</label>
                                                    </div>
                                                </div>

                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">Program</legend>
                                                <?php
                                                foreach ($program as $a) { ?>
                                                    <div class="col-sm-3">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="pilihan<?= $a['id'] ?>" name="program" value="<?= $a['id'] ?>" class="custom-control-input">
                                                            <label class="custom-control-label" for="pilihan<?= $a['id'] ?>"><?= $a['nama'] ?></label>
                                                        </div>
                                                    </div>
                                                <?php }
                                                ?>


                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <label for="select_prodi" class="col-sm-2">Program Studi</label>
                                            <div class="col-sm-8">
                                                <select class="select2-single form-control" name="prodi" id="select_prodi">

                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tempat" class="col-sm-2 col-form-label">Tempat/Tanggal lahir</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Tempat">
                                            </div>
                                            <div class="my-auto ml-4">/</div>
                                            <div class="col-sm-3 ml-4">
                                                <input type="text" class="form-control" name="tgl_lahir" id="tgl" placeholder="Tanggal lahir">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_telp" class="col-sm-2 col-form-label">Nomor Telepon</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Nomor Telepon">
                                            </div>
                                            <label for="alamat" class="col-sm-2 ml-5 col-form-label">Alamat</label>
                                            <div class="col-sm-3">
                                                <!-- <input type="text" class="form-control" id="nama_lengkap" name="tempat" placeholder="Tempat"> -->
                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="enter your address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-sm-2  col-form-label">Foto</label>
                                            <img src="<?= base_url('assets/user/images/user.jpg'); ?>" alt="" style="width:150px;height:150px;border:1px solid;" class="poto_add mr-5">
                                            <div class="custom-file col-sm-6">
                                                <input type="file" name="foto" class="custom-file-input" id="upload_foto">
                                                <label class="custom-file-label " for="customFile"></label>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-sm-2  col-form-label"></label>

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
                        <span>copyright Kalbis Institute &copy; 2022
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
    <script>
        $(document).ready(() => {
            $(".drop-add").click();
        })
    </script>