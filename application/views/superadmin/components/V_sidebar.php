<?php
$uri = $this->uri->segment(1);
?>
<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("admin-home") ?>">
        <!-- <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/data/') ?>img/kalbis_logo.png">
        </div> -->
        <div class="sidebar-brand-text mx-3">Admin </div>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item <?php if ($uri == "admin-home") {
                            echo "active";
                        } ?>">
        <a class="nav-link" href="<?= base_url('admin-home'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Features
    </div>

    <li class="nav-item <?php if ($uri == "admin-add-mahasiswa") {
                            echo "active";
                        } elseif ($uri == "admin-add-ttd") {
                            echo "active";
                        } ?>">
        <a class="nav-link collapsed drop-add" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true" aria-controls="collapseForm">
            <i class="fas fa-fw fa-plus-square"></i>
            <span>Master Add</span>
        </a>
        <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Add</h6>
                <a class="collapse-item <?php if ($uri == "admin-add-mahasiswa") {
                                            echo "active";
                                        } ?>" href="<?= base_url('admin-add-mahasiswa'); ?>">Add Data Mahasiswa</a>
                <a class="collapse-item <?php if ($uri == "admin-add-ttd") {
                                            echo "active";
                                        } ?>" href="<?= base_url('admin-add-ttd'); ?>">Add Data Tanda Tangan</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?php if ($uri == "admin-data-mahasiswa") {
                            echo "active";
                        } elseif ($uri == "admin-data-ttd") {
                            echo "active";
                        } elseif ($uri == "admin-data-formulir") {
                            echo "active";
                        } elseif ($uri == "admin-data-surat") {
                            echo "active";
                        } ?>">
        <a class="nav-link collapsed drop-data" href="#" data-toggle="collapse" data-target="#collapseBootstrap" aria-expanded="true" aria-controls="collapseBootstrap">
            <i class="far fa-fw fa-bookmark"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data User</h6>
                <a class="collapse-item <?php if ($uri == "admin-data-mahasiswa") {
                                            echo "active";
                                        } ?> " href="<?= base_url('admin-data-mahasiswa'); ?>">Data Mahasiswa</a>

                <a class="collapse-item <?php if ($uri == "admin-data-ttd") {
                                            echo "active";
                                        } ?>" href="<?= base_url('admin-data-ttd'); ?>">Data Tanda Tangan </a>

                <h6 class="collapse-header">Master Data Surat</h6>
                <a class="collapse-item <?php if ($uri == "admin-data-formulir") {
                                            echo "active";
                                        } ?>" href="<?= base_url('admin-data-formulir'); ?>">Data Formulir</a>
                <a class="collapse-item <?php if ($uri == "admin-data-surat") {
                                            echo "active";
                                        } ?>" href="<?= base_url('admin-data-surat'); ?>">Data Surat</a>

            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
</ul>