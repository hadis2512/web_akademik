<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="<?= base_url('assets/user/') ?>images/logo.png" class="mr-2" alt="logo"></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= base_url('assets/user/skydash/') ?>images/logo-mini.svg" alt="logo"></a>

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle " href="#" data-toggle="dropdown" id="profileDropdown">
                    <img class="mr-2" src="<?= base_url($this->session->userdata('foto')); ?>" alt="profile" />
                    <span class="mr-2"><?= $this->session->userdata('email'); ?></span>
                    <i class="ti-more"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?= base_url('user/User/profileM/') . $this->session->userdata('idadmin'); ?>">
                        <i class="ti-user text-primary"></i>
                        My Profile
                    </a>

                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#mhs_logout">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
<div class="modal fade" id="mhs_logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to logout <b><?= $this->session->userdata("nama") ?></b>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                <a href="<?= base_url('user/U_auth/logout'); ?>" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </div>
</div>