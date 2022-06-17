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
                        <h1 class="h3 mb-0 text-gray-800">Add Tanda Tangan</h1>

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url("admin-add-ttd") ?>">Data Tanda Tangan</a></li>
                            <li class="breadcrumb-item active">Add Tanda Tangan</li>
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
                                    <form action="<?= base_url('superadmin/Master_data/save_ttd'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                        <div class="form-group row">
                                            <label for="nama_lengkap" class="col-sm-2 col-form-label ">Nama Lengkap</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Enter nama lengkap">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-2 col-form-label ">Jabatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="email" name="jabatan" placeholder="Enter the jabatan">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="foto" class="col-sm-2 col-form-label ">Tanda Tangan</label>
                                            <div class="col-sm-2">
                                                <img class="poto_add_ttd" style="width:150px;height:150px;border: 1px solid black;" id="poto_ttd" src="<?= base_url('assets/user/images/user.jpg'); ?>" alt="asd" />
                                            </div>
                                            <div class="custom-file  col-sm-6 ">
                                                <input type="file" name="foto" class="custom-file-input" id="add_foto">
                                                <label class="custom-file-label nama_poto_add" for="customFile">Choose File</label>
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
            $(".drop-add").click();
            $("#add_foto").change((e) => {
                var input = $(e.currentTarget);
                var file = input[0].files[0];
                if (file) {
                    let reader = new FileReader();
                    let file_nama = file.name;
                    let name_file = file_nama.substr(0, 22)
                    reader.onload = function(event) {
                        $('.poto_add_ttd').attr('src', event.target.result);
                        $(".nama_poto_add").html(name_file)
                    }
                    reader.readAsDataURL(file);
                }
            })
        })
    </script>