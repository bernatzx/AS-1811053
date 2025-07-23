<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>WEBGIS <?= isset($label) ? ' | ' . $label : '' ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('_assets/css/style.css') ?>" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />


    <style>
        .form-pencarian-custom {
            border: 1px solid rgba(0, 0, 0, 0.085);
            border-radius: 4px;
            display: flex;
            align-items: center;
        }

        .form-pencarian-custom input {
            padding-left: 10px;
            border: none;
            outline: none;
            background-color: transparent;
        }

        #map {
            height: 400px;
            width: 100%x;
        }

        .user-icon {
            color: #fff;
            overflow: hidden;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 4px solid gray;
            background-color: gray;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .custom-relative {
            position: relative;
        }

        .custom-footer {
            position: absolute;
            right: 20px;
            bottom: 2px;
            font-size: 0.50rem;
            font-weight: bold;
        }

        .custom-footer a:hover {
            color: blue;
            text-decoration: none;
        }

        .custom-footer a {
            color: gray;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="wrapper custom-relative d-flex align-items-stretch">


        <nav id="sidebar">
            <div class="logo ">
                <a href="#">WebGis</a>
            </div>
            <div class="d-flex flex-column flex-auto my-2">
                <div class="flex-auto">

                    <?php $halamanAktif = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    foreach ($menu as $men) {
                        if (!has_akses($men['akses'] ?? [])) {
                            continue;
                        }
                        $u = (strpos($halamanAktif, $men["url"]) === 0); ?>
                        <a href="<?= $men['url'] ?>" class="sidebar-item <?= $u ? 'active' : '' ?>">
                            <div class="mr-3 ikon">
                                <i class="<?= $men['icon'] ?>"></i>
                            </div>
                            <div>
                                <?= $men['label'] ?>
                            </div>
                        </a>
                        <?php
                    } ?>

                </div>
                <?php if (valid()) { ?>
                    <div class="sidebar-item">
                        <div class="mr-3 ikon">
                            <i class="fas fa-right-from-bracket"></i>
                        </div>
                        <div>
                            <a href="<?= base_url('logout.php') ?>">Logout</a>
                        </div>
                    </div>
                <?php } ?>
            </div>

        </nav>

        <!-- Page Content  -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-custom-bg">
                <div class="container-fluid" style="display: flex; justify-content: end;">
                    <button type="button" id="sidebarCollapse" class="btn">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
            </nav>
            <div class="p-4 p-md-5">