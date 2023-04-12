<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="<?= base_url("assets/image/tasik.png");?>" />
    <title><?= $title;?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/modules/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/modules/fontawesome/css/all.min.css" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/modules/datatables/datatables.min.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>assets/admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?= base_url(); ?>assets/admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/modules/summernote/summernote-bs4.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/style.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/admin/css/components.css" />
    <!-- Start GA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script> <!-- capthca -->
    
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag("js", new Date());

    gtag("config", "UA-94034622-3");
    </script>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">