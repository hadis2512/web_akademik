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
                                        <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                                        <?= $this->session->flashdata('msg'); ?>
                                    </div>
                                    <form action="#" method="post" enctype="multipart/form-data" accept-charset="utf-8" class="user">
                                        <div class="form-group">
                                            <input type="text" id="username" name="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter Username..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter Password..." required>
                                        </div>
                                        <hr>
                                        <div class="form-group ">
                                            <button id="login" type="button" class="btn btn-primary btn-block ">Login</button>
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $("#login").click(() => {
            let username = $("#username").val();
            let password = $("#password").val();
            $.ajax({
                type: 'POST',
                url: `<?= base_url('superadmin/Login/LoginViaAjax/') ?>${username}/${password}`,
                success: function(data) {
                    let parsed = JSON.parse(data);
                    console.log(parsed);
                    swal({
                        title: "Login Berhasil!",
                        text: `Halo, ${username}`,
                        icon: "success",
                    }).then(() => {

                        window.location = `<?= base_url("superadmin/Login/berhasilLoginAjax/") ?>`;
                    })
                },
            })

        })
    </script>