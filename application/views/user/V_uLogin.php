<?php $this->load->view('user/components/V_header'); ?>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <h3 class="text-center">Login Mahasiswa</h3>

                            <form id="sign_in" class="pt-3" action="<?= base_url('user/u_auth/auth'); ?>" method="POST">
                                <div class="msg"><?= $this->session->flashdata('msg'); ?></div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" required>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <div class="text-center">

        <div class="w-100">
            <h3 id="waktu"></h3>
        </div>
    </div>
    <?php $this->load->view('user/components/V_footer'); ?>