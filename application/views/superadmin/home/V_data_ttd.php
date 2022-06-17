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
                        <h1 class="h3 mb-0 text-gray-800">Data Tanda Tangan</h1>
                        <?= $this->session->flashdata('msg'); ?>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin-data-ttd'); ?>">Data Tanda Tangan</a></li>
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Tanda Tangan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody class="text-center">
                                            <?php
                                            $no = 0;
                                            foreach ($data_ttd as $a) {
                                                $no++;
                                            ?>
                                                <td><?= $no; ?></td>
                                                <td><?= $a['nama'] ?></td>
                                                <td><?= $a['jabatan'] ?></td>
                                                <td class="lightgallery">
                                                    <a href="<?= base_url($a['tanda_tangan']); ?>">
                                                        <img style="width:80px;height:80px;" class="img-thumbnail width-1 " src="<?= base_url($a['tanda_tangan']); ?>" alt="" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href="#" data-toggle="modal" data-target="#details_ttd<?= $a['id_ttd']; ?>" id="#modalCenter" class="btn btn-info btn-sm">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#delete_ttd<?= $a['id_ttd']; ?>" id="#modalCenter" class="btn btn-danger btn-sm"><i class="fa fa-trash " aria-hidden="true"></i></a>
                                                    </div>
                                                </td>


                                                <div class="modal fade" id="delete_ttd<?= $a['id_ttd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabelLogout">Hapus data TTD</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="<?= base_url('superadmin/Master_data/delete_ttd/' . $a['id_ttd']); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                                                                    <p>Apakah anda yakin ingin menghapus data tanda tangan tersebut?</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                </div>
                                <div class="modal fade" id="details_ttd<?= $a['id_ttd']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabelLogout">Details data TTD</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="<?= base_url('superadmin/Master_data/update_ttd/' . $a['id_ttd']); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                                    <div class="modal-body">

                                                        <div class="form-group row">
                                                            <label for="nim" class="col-sm-3 col-form-label">Nama </label>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="nama" class="form-control" id="nama" value="<?= $a['nama']; ?>" placeholder="Nomor Induk Mahasiswa">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?= $a['jabatan']; ?>" placeholder="Jabatan">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row">
                                                                <label for="poto_ttd" class="col-sm-3  col-form-label">Foto</label>
                                                                <img class="col-sm-5 ml-5 poto_ttd" style="border: 1px solid black;" id="poto_ttd" src="<?= base_url($a['tanda_tangan']) ?>" alt="asd" />
                                                            </div>
                                                            <div class="row mt-2">
                                                                <label for="foto" class="col-sm-3  col-form-label"></label>
                                                                <div class="custom-file col-sm-8 ml-1">
                                                                    <input type="file" name="foto" class="custom-file-input " id="btn_poto_ttd">
                                                                    <label class="custom-file-label nama_poto" for="customFile"></label>
                                                                </div>
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