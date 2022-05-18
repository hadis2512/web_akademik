<?php $this->load->view('superadmin/components/V_header') ?>

<body id="page-top" oncontextmenu="return false">
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
                        <h1 class="h3 mb-0 text-gray-800">Data Surat</h1>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Data Surat</a></li>
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
                                                <th>No Surat</th>
                                                <th>No Form</th>
                                                <th>Nama Pengaju</th>
                                                <th>Program Studi</th>
                                                <th>Jenis Permohonan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data_surat as $a) {
                                                $no++;
                                            ?>

                                                <tr class="text-center">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $a['no_surat']; ?></td>
                                                    <td><?= $a['no_form']; ?></td>
                                                    <td><?= $a['nama_mahasiswa']; ?></td>
                                                    <td><?= $a['nama_prodi']; ?></td>
                                                    <td><?= $a['jenis_permohonan']; ?></td>
                                                    <td class="d-flex justify-content-around align-self-start">
                                                        <!-- <a href="<?= base_url('superadmin/master_data/lihat_surat/') . $a['id_jenis_p'] . '/' . $a['id_surat']; ?>" class="btn btn-info btn-sm mr-2"><i class="fas fa-info-circle"></i></a> -->
                                                        <a href="#" data-target="#lihat_modal<?= $a['id_surat']; ?>" data-toggle="modal" class="btn btn-info btn-sm mr-2"><i class="fas fa-info-circle"></i></a>
                                                        <a href="<?= base_url('superadmin/master_data/download_surat/') . $a['id_jenis_p'] . '/' . $a['id_surat']; ?>" class="btn btn-success btn-sm"><i class="fas fa-arrow-alt-circle-down"></i></a>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="lihat_modal<?= $a['id_surat']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h6 class="modal-title" id="exampleModalLabelLogout">
                                                                    <b><?= $a['nama_file']; ?></b>
                                                                </h6>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <object type="application/pdf" data="<?= base_url() . $a['path_file'] ?>" height="750" style="width:100%;"></onject>
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