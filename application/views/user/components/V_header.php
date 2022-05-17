<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= $pageTitle; ?></title>
    <!-- Favicon-->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/user/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url('') ?>assets/user/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= base_url('') ?>assets/user/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('') ?>assets/user/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('') ?>assets/user/images/favicon.png" />
    <style>
        .btn-input1 {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 67%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }


        .btn-input1:hover {
            opacity: 1;
        }

        .btn-input1:hover .al {
            opacity: 0.5;
        }




        /* #btn_ganti_poto {
            border-radius: 50%;
            margin-left: -112px;
            margin-top: 45px !important;

            position: absolute;
        } */
    </style>
</head>