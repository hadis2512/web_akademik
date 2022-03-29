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
                        <h1 class="h3 mb-0 text-gray-800">Add Karyawan</h1>

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
                                    <form action="<?= base_url('superadmin/Master_data/save_karyawan'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group row">
                                            <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                                            <div class="col-sm-3">
                                                <input type="text" name="nip" class="form-control" id="nip" placeholder="Nomor Induk Pegawai">
                                            </div>

                                            <label for="email" class="col-sm-2 col-form-label ml-5">Email</label>
                                            <div class="col-sm-3">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama Lengkap</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap">
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

                                        <div class="form-group row">
                                            <label for="select_prodi" class="col-sm-2">Program Studi</label>
                                            <div class="col-sm-8">
                                                <select class="select2-single form-control" name="prodi" id="select_prodi">
                                                    <?php foreach ($prodi as $a) { ?>
                                                        <option value="<?= $a['id']; ?>"><?= $a['program_studi'] ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tempat" class="col-sm-2 col-form-label">Tempat/Tanggal lahir</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="nama_lengkap" name="tempat" placeholder="Tempat">
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
                                            <label for="jabatan" class="col-sm-2 ml-5 col-form-label">Alamat</label>
                                            <div class="col-sm-3">
                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="enter your address"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="foto" class="col-sm-2  col-form-label">Foto</label>
                                            <div class="custom-file col-sm-9">
                                                <input type="file" name="foto" class="custom-file-input" id="customFile">
                                                <label class="custom-file-label" for="customFile"></label>
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
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <p>For more documentations you can visit<a href="https://getbootstrap.com/docs/4.3/components/forms/" target="_blank">
                                    bootstrap forms documentations.</a> and <a href="https://getbootstrap.com/docs/4.3/components/input-group/" target="_blank">bootstrap input
                                    groups documentations</a></p>
                        </div>
                    </div>

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