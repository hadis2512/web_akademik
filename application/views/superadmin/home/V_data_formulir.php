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
                        <h1 class="h3 mb-0 text-gray-800">Data Formulir</h1>
                        <?= $this->session->flashdata('msg'); ?>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('admin-data-formulir'); ?>">Data Formulir</a></li>
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
                                                <th>No Form</th>
                                                <th>Jenis Permohonan</th>
                                                <th>Nama Mahasiswa/Program Studi</th>
                                                <th>Status Formulir</th>
                                                <th>Status Surat</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data_formulir as $a) {
                                                $no++;
                                                if ($a['approval_admin'] == 0) {
                                                    $admin_approve = 'Not approve yet';
                                                    $tag = 'badge badge-warning';
                                                } elseif ($a['approval_admin'] == 1) {
                                                    $admin_approve = 'Approve';
                                                    $tag = 'badge badge-success';
                                                } elseif ($a['approval_admin'] == 2) {
                                                    $admin_approve = 'Ditolak';
                                                    $tag = 'badge badge-danger';
                                                }
                                                if ($a['status_surat'] == 0) {
                                                    $approve_surat = 'Not ready';
                                                    $color = 'badge badge-warning';
                                                } elseif ($a['status_surat'] == 1) {
                                                    $approve_surat = 'Ready';
                                                    $color = 'badge badge-success';
                                                }
                                            ?>

                                                <tr class="text-center">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $a['no_form']; ?></td>
                                                    <td><?= $a['jenis_permohonan']; ?></td>
                                                    <td><?= $a['nama_mahasiswa'] . '<b>(' . $a['nama_prodi'] . ')</b>'; ?></td>
                                                    <td><span class="<?= $tag; ?>"><?= $admin_approve; ?></span></td>
                                                    <td><span class="<?= $color; ?>"><?= $approve_surat; ?></span></td>
                                                    <td><span class=""><?= date('d F Y', strtotime($a['created_at'])); ?></span></td>
                                                    <td><a href="<?= base_url('superadmin/master_data/detail/') . $a['id_jenis_p'] . '/' . $a['id_formulir']; ?>"><i class="fas fa-info-circle"></i></a></td>
                                                </tr>

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