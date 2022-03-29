<?php $this->load->view('user/components/V_header'); ?>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <?php $this->load->view('user/components/V_navbar'); ?>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <?php $this->load->view('user/components/V_sidebar_m'); ?>
        <!-- #END# Left Sidebar -->

    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Pengajuan Form</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <!-- Task Info -->

                <div class="card col-xs-12 col-sm-12 col-md-8 col-lg-12 rounded">
                    <div class="header text-center">
                        <h2>Pengajuan Form</h2>
                    </div>
                    <div class="card row ">
                        <div class="card col-lg-5 ">asd</div>
                        <div class="card col-lg-5">asd</div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-12 text-center">
                    <div class="col-lg-4 ">
                        <div class="card w-50">
                            <div class="header">
                                <h2>hai</h2>
                            </div>
                            <div class="body">
                                <h1>1</h1>
                            </div>
                            <hr>
                            <div class="footer">
                                <h2>see details</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 ">
                        <div class="card w-50">
                            <div class="header">
                                <h2>hai</h2>
                            </div>
                            <div class="body">
                                <h1>1</h1>
                            </div>
                            <hr>
                            <div class="footer">
                                <h2>see details</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card w-50">
                            <div class="header">
                                <h2>hai</h2>
                            </div>
                            <div class="body">
                                <h1>1</h1>
                            </div>
                            <hr>
                            <div class="footer">
                                <h2>see details</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Task Info -->
        <!-- Browser Usage -->
        <!-- #END# Browser Usage -->
    </section>
    <?php $this->load->view('user/components/V_footer'); ?>