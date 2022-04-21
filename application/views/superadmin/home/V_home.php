<?php $this->load->view('superadmin/components/V_header'); ?>

<body id="page-top">
    <div id="wrapper">
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
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>

                    <div class="row mb-3">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pengajuan Formulir</div>

                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $jumlah_formulir; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-copy fa-2x text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Form Pengantar Riset</div>
                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $form_riset; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New User Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Form Pengantar KP</div>
                                            <div class="h5 mb-0 mr-3 my-3 text-gray-800"><b><?= $form_kp; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-alt fa-2x text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pengajuan Tertunda</div>
                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $form_tertunda; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clock fa-2x text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- baris 2 -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Formulir Duplikasi</div>

                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $form_duplikasi; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clone fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Earnings (Annual) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Formulir Ditolak</div>
                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $form_tolak; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- New User Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Surat Pengantar Riset</div>
                                            <div class="h5 mb-0 mr-3 my-3 text-gray-800"><b><?= $surat_riset; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-pdf fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Surat Pengantar KP</div>
                                            <div class="h5 mb-0 my-3  text-gray-800"><b><?= $surat_kp; ?></b> Pengajuan</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-file-pdf fa-2x text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Invoice Example -->
                        <div class="col-xl-12 col-lg-7 mb-4">
                            <div class="card">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pengajuan Terbaru</h6>
                                    <a class="m-0 float-right btn btn-info btn-sm" href="<?= base_url('admin-data-formulir') ?>">View More <i class="fas fa-chevron-right"></i></a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>No</th>
                                                <th>No Form</th>
                                                <th>Jenis Permohonan</th>
                                                <th>Mahasiswa Pengaju</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($latest_form as $a) {
                                                $no++;
                                                if ($a['approval_admin'] == 0) {
                                                    $stats = "Not Approval";
                                                    $tag = 'badge badge-warning';
                                                } elseif ($a['approval_admin'] == 1) {
                                                    $stats = "Approval";
                                                    $tag = 'badge badge-success';
                                                } elseif ($a['approval_admin'] == 2) {
                                                    $stats = "Duplicate";
                                                    $tag = 'badge badge-danger';
                                                }
                                            ?>

                                                <tr>
                                                    <td><?= $no; ?></td>
                                                    <td><?= $a['no_form']; ?></td>
                                                    <td><?= $a['jenis_permohonan']; ?></td>
                                                    <td><?= $a['nama']; ?></td>
                                                    <td><span class="<?= $tag; ?>"><?= $stats; ?></span></td>
                                                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                        </div>
                        <!-- Message From Customer-->

                    </div>
                    <!--Row-->

                    <!-- <div class="row">
                        <div class="col-lg-12 text-center">
                            <p>Do you like this template ? you can download from <a href="https://github.com/indrijunanda/RuangAdmin" class="btn btn-primary btn-sm" target="_blank"><i class="fab fa-fw fa-github"></i>&nbsp;GitHub</a></p>
                        </div>
                    </div> -->

                    <!-- Modal Logout -->


                </div>
                <!---Container Fluid-->
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy; <script>
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

    <?php $this->load->view('superadmin/components/V_footer'); ?>