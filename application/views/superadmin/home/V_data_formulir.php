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

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item">Forms</li>
                            <li class="breadcrumb-item active" aria-current="page">Form Basics</li>
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
                                                <th>Status</th>
                                                <!-- <th>Jenis Kelamin</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 0;
                                            foreach ($data_formulir as $a) {
                                                $no++;
                                                $status = $a['approval'];
                                                if ($status == 0) {
                                                    $stats = 'Not Approval';
                                                    $warning = 'text-warning';
                                                } elseif ($status == 1) {
                                                    $stats = 'Approval';
                                                    $warning = 'text-success';
                                                } elseif ($status == 2) {
                                                    $stats = 'Duplicate';
                                                    $warning = 'text-danger';
                                                }
                                            ?>
                                                <tr class="text-center clickable" data-toggle="collapse" data-target="#accordion<?= $a['id_formulir']; ?>">
                                                    <td><?= $no; ?></td>
                                                    <td><?= $a['no_form']; ?></td>
                                                    <td><?= $a['jenis_permohonan']; ?></td>
                                                    <td class="<?= $warning; ?>"><?= $stats; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <div id="accordion<?= $a['id_formulir']; ?>" class="collapse">
                                                            <div class="card">
                                                                <div class="card-body ">
                                                                    <div class="d-flex justify-content-around font-weight-bold">
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">NIM : </label>
                                                                            <p class=""><?= $a['nim']; ?></p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">Nama Lengkap : </label>
                                                                            <p class=""><?= $a['nama_mahasiswa']; ?></p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">Program Studi : </label>
                                                                            <p class=""><?= $a['nama_prodi']; ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-around font-weight-bold">
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">NIM : </label>
                                                                            <p class=""><?= $a['nim']; ?></p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">Nama Lengkap : </label>
                                                                            <p class=""><?= $a['nama_mahasiswa']; ?></p>
                                                                        </div>
                                                                        <div class="d-flex justify-content-around">
                                                                            <label for="nim" class="mr-3">Program Studi : </label>
                                                                            <p class=""><?= $a['nama_prodi']; ?></p>
                                                                        </div>
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