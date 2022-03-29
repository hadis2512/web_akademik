<?php $this->load->view('user/components/V_header'); ?>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);"><b>Login</b></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" action="<?= base_url('user/u_auth/auth'); ?>" method="POST">
                    <div class="msg"><?= $this->session->flashdata('msg'); ?></div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="">
                        <div class="">
                            <button class=" btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-6">
                            <a href="sign-up.html">Register Now!</a>
                        </div>
                        <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
    <div class="text-center">

        <div class="w-100">
            <h3 id="waktu"></h3>
        </div>
    </div>
    <?php $this->load->view('user/components/V_footer'); ?>