<?php $this->load->view('superadmin/V_header'); ?>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9 " style="margin-top: 100px;">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Superadmin Login</h1>
                                        <?= $this->session->flashdata('msg'); ?>
                                    </div>
                                    <form action="<?= base_url('superadmin/Login/auth'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="user">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter Username..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Enter Password..." required>
                                        </div>
                                        <hr>
                                        <div class="form-group ">
                                            <button type="submit" class="btn btn-primary btn-block ">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $this->load->view('superadmin/V_footer'); ?>