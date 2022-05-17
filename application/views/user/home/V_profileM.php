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
                                    <h3 class="font-weight-bold">My Profile </h3>
                                    <!-- <h3 class="font-weight-bold"><?= $this->session->userdata('nama'); ?></h3> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>




                    <div class="row">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <?php foreach ($profile as $a) {

                                    ?>
                                        <?= $this->session->flashdata('msg'); ?>
                                        <form class="forms-sample " action="<?= base_url('user/User/edit_profile_m/') . $a['id']; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                            <div class="form-group row ">
                                                <div class="col-lg-12 text-center x">
                                                    <?= $foto; ?>
                                                    <a class="btn-input1">
                                                        <button type="button" id="btn_ganti_poto" class="btn btn-outline-secondary mt-3 al "><i class="fa-solid fa-camera ikon" style="font-size: 30px;"></i></button>
                                                        <input type="file" name="foto" id="uplod" style="display: none;">
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="form-group row  ">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">NIM</label>
                                                    <input type="text" class="form-control" name="nim" value="<?= $a['nim']; ?>" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Nama Lengkap</label>
                                                    <input type="text" class="form-control" name="nama_lengkap" value="<?= $a['nama_lengkap']; ?>" id="exampleInputUsername1" placeholder="Entry Here's">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <label for="exampleInputUsername1">Email</label>
                                                    <input type="email" class="form-control" name="email" value="<?= $a['email']; ?>" id="exampleInputUsername1" placeholder="Entry Here" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Old Password</label>
                                                    <input type="password" class="form-control" name="oldpass" id="exampleInputUsername1" placeholder="Entry old password here">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">New Password</label>
                                                    <input type="password" class="form-control" name="password" id="exampleInputUsername1" placeholder="Entry new password here">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Tempat</label>
                                                    <input type="tempat" class="form-control" name="tempat" value="<?= $a['tempat'] ?>" id="exampleInputUsername1" placeholder="Entry old password here">
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Tanggal Lahir</label>
                                                    <input type="text" class="form-control" name="tgl_lahir" value="<?= date('Y-m-d', strtotime($a['tgl_lahir'])); ?>" id="tgl" placeholder="Tanggal lahir">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Jenis Kelamin</label>
                                                    <select class="form-control" style="color: black ;" name="jenis_kelamin" id="exampleFormControlSelect1">
                                                        <?= $jenis_kelamin; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">No Telepon</label>
                                                    <input type="text" class="form-control" name="no_telp" id="exampleInputUsername1" value="<?= $a['no_telp']; ?>" placeholder="Entry new password here">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-12">
                                                    <label for="exampleInputUsername1">Alamat</label>
                                                    <textarea class="form-control" name="alamat" id="alamat" cols="" rows=""><?= $a['alamat']; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Program</label>
                                                    <select class="form-control" style="color: black ;" name="program" id="program_m">
                                                        <?php foreach ($program as $b) { ?>
                                                            <option value="<?= $b['id'] ?>" <?php if ($a['nama_program'] == $b['nama']) {
                                                                                                echo "selected='selected'";
                                                                                            } ?>><?= $b['nama']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="exampleInputUsername1">Program Studi</label>
                                                    <select class="form-control" name="prodi" id="select_prodi" style="color: black;">
                                                        <?php foreach ($prodi1 as $c) { ?>
                                                            <option value="<?= $c['id'] ?>" <?php if ($a['id_prodi'] == $c['id']) {
                                                                                                echo "selected='selected'";
                                                                                            } ?>><?= $c['program_studi'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button class="btn btn-dark">Cancel</button>
                                                <button type="submit" class="btn btn-inverse-primary ml-2">Save</button>
                                            </div>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal fade bd-example-modal-lg modalDetail_form" id="ganti_foto<?= $this->session->userdata('idadmin'); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ganti Foto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="forms-sample " action="" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group row ">
                                            <div class="col-lg-12 text-center">
                                                <?= $foto; ?>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <input type="file" class="form-control-sm mt-3 mb-0" name="poto" id="ganti_poto_p" placeholder="Upload Image">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
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