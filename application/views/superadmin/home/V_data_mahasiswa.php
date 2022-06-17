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
                        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="<?= base_url('admin-data-mahasiswa'); ?>">Data Mahasiswa</a></li>
                        </ol>
                    </div>
                    <?= $this->session->flashdata('msg'); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>NIM</th>
                                                <th>Email</th>
                                                <th>Nama Lengkap</th>
                                                <th>Tempat/Tgl Lahir</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Action</th>
                                                <!-- <th>Jenis Kelamin</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data_mahasiswa as $a) {
                                                $no++;
                                                $id = $a['id'];
                                                $nim = $a['nim'];
                                                $email = $a['email'];
                                                $nama_lengkap = $a['nama_lengkap'];
                                                $tempat = $a['tempat'];
                                                $tgl_lahir = $a['tgl_lahir'];
                                                $jenis_kelamin = $a['jenis_kelamin'];
                                                $no_telp = $a['no_telp'];
                                                $alamat = $a['alamat'];
                                                $nama_program = $a['nama'];
                                                $prodi = $a['program_studi'];

                                            ?>
                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $nim; ?></td>
                                                    <td><?= $email; ?></td>
                                                    <td><?= $nama_lengkap; ?></td>
                                                    <td><?= $tempat; ?>, <?= date('d-m-Y', strtotime($tgl_lahir)); ?></td>
                                                    <td><?= $jenis_kelamin; ?></td>
                                                    <td>
                                                        <div class="d-flex ">
                                                            <a href="#" data-toggle="modal" data-target="#details<?= $id; ?>" id="#modalCenter" class="btn btn-info btn-sm">
                                                                <i class="fas fa-info-circle"></i>
                                                            </a>
                                                            <a href="#" data-toggle="modal" data-target="#delete<?= $id; ?>" id="#modalCenter" class="btn btn-danger btn-sm"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                                        </div>
                                                    </td>

                                                </tr>


                                                <div class="modal  fade" id="delete<?= $id; ?>" tabindex="-1" role="dialog" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Data </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete data <b><?= $nama_lengkap; ?></b> ?</p>
                                                            </div>
                                                            <form action="<?= base_url('superadmin/Master_data/delete_mahasiswa/' . $id); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal  fade" id="details<?= $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Details </h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="<?= base_url('superadmin/Master_data/update_mahasiswa/' . $id); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="nim" class="col-sm-3 col-form-label">NIM </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" name="nim" class="form-control" id="nim" value="<?= $nim; ?>" placeholder="Nomor Induk Mahasiswa">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="email" class="form-control" id="email" name="email" value="<?= $email; ?>" placeholder="Enter the email">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $nama_lengkap; ?>" placeholder="Nama Lengkap">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="inputPassword3" class="col-sm-3 col-form-label ">Password</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="tempat" class="col-sm-3 col-form-label">Tempat/Tgl lahir</label>
                                                                        <div class="col-sm-4">
                                                                            <input type="text" class="form-control" id="nama_lengkap" name="tempat" value="<?= $tempat; ?>" placeholder="Tempat">
                                                                        </div>
                                                                        <div class="col-sm-4 ">
                                                                            <input type="text" class="form-control" name="tgl_lahir" id="tgl" value="<?= $tgl_lahir; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <fieldset class="form-group">
                                                                        <div class="row">
                                                                            <legend class="col-form-label col-sm-3 pt-0">Jenis Kelamin</legend>
                                                                            <?php if ($jenis_kelamin == "Pria") { ?>
                                                                                <div class="col-sm-4">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="customRadio1" name="jenis_kelamin" value="Pria" class="custom-control-input" checked>
                                                                                        <label class="custom-control-label" for="customRadio1">Pria</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="customRadio2" name="jenis_kelamin" value="Wanita" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="customRadio2">Wanita</label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } elseif ($jenis_kelamin == "Wanita") { ?>
                                                                                <div class="col-sm-4">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="customRadio1" name="jenis_kelamin" value="Pria" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="customRadio1">Pria</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-4">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="customRadio2" name="jenis_kelamin" value="Wanita" class="custom-control-input" checked>
                                                                                        <label class="custom-control-label" for="customRadio2">Wanita</label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>

                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset class="form-group">
                                                                        <div class="row">
                                                                            <legend class="col-form-label col-sm-3 pt-0">Program</legend>
                                                                            <?php
                                                                            foreach ($program as $a) { ?>
                                                                                <div class="col-sm-1">
                                                                                    <div class="custom-control custom-radio d-flex justify-content-around">
                                                                                        <input type="radio" id="pilihan<?= $a['id'] ?>" name="program" value="<?= $a['id'] ?>" class="custom-control-input" <?php if ($nama_program == $a['nama']) {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            } ?>>
                                                                                        <label class="custom-control-label" for="pilihan<?= $a['id'] ?>"><?= $a['nama'] ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php }
                                                                            ?>
                                                                            <div class="col-sm-5">
                                                                                <select class="select2-single form-control prodi" name="prodi" id="select_prodi">
                                                                                    <?php if ($a['id']) {
                                                                                        # code...
                                                                                    } ?>
                                                                                </select>
                                                                            </div>


                                                                        </div>
                                                                    </fieldset>
                                                                    <!-- <div class="form-group row">
                                                                        <label for="select_prodi" class="col-sm-3">Program Studi</label>

                                                                    </div> -->
                                                                    <div class="form-group row">
                                                                        <label for="no_telp" class="col-sm-3 col-form-label">Nomor Telepon</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="no_telp" value="<?= $no_telp; ?>" name="no_telp" placeholder="Nomor Telepon">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                                                                        <div class="col-sm-8">
                                                                            <!-- <input type="text" class="form-control" id="nama_lengkap" name="tempat" placeholder="Tempat"> -->
                                                                            <textarea name="alamat" id="alamat" class="form-control" placeholder="enter your address"><?= $alamat; ?></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="foto" class="col-sm-3  col-form-label">Foto</label>
                                                                        <div class="custom-file col-sm-8">
                                                                            <input type="file" name="foto" class="custom-file-input" id="upload">
                                                                            <label class="custom-file-label" for="customFile"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
                        <span>copyright Kalbis Institute &copy; <script>
                                document.write(new Date().getFullYear());
                            </script>

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
            $(".drop-data").click();
        })
    </script>