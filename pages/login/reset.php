<?php
require_once '../../config.php';

if (empty($_GET['token'])) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
} elseif (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];
    $sql = mysqli_query($db, "SELECT * FROM tb_user WHERE id_user = '$token'") or die(mysqli_error($db));
    if (mysqli_num_rows($sql) > 0) {

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $sandi = trim(mysqli_real_escape_string($db, $_POST['password']));
            $konfirmasi = trim(mysqli_real_escape_string($db, $_POST['konfirmasi']));
            if ($sandi == $konfirmasi) {
                // ENKRIPSI KATA SANDI LALU PERBARUI TABEL PENGGUNA DENGAN ID TERTEBNTU
                $enk = sha1($sandi);
                mysqli_query($db, "UPDATE tb_user SET password = '$enk' WHERE id_user = '$token'") or die(mysqli_error($db));

                echo "<script>window.location='" . base_url() . "'</script>";
                exit();
            } else {
                $err = "Kata sandi tidak cocok!";
            }
        }
        ?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reset Kata Sandi</title>
            <link rel="stylesheet" href="<?= base_url('_assets/css/style.css') ?>" />

            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 97vh;
                }

                form {
                    width: 400px;
                }

                .err {
                    background-color: #ED5F5F;
                    margin-bottom: 12px;
                    width: 400px;
                    color: #fff;
                    border: 2px solid red;
                    border-radius: 8px;
                }
            </style>
        </head>

        <body>
            <script src="<?= base_url('_assets/js/all.min.js') ?>"></script>

            <div style="border: 2px solid gray; border-radius: 10px;" class="p-5">
                <?php
                if (isset($err)) { ?>
                    <div class="err p-2 d-flex justify-content-between align-items-center text-center">
                        <?= $err ?>
                        <i class="fas fa-warning"></i>
                    </div>
                <?php }
                ?>
                <form method="post">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex gap-2">
                            <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                            <input class="form-control" type="password" placeholder="Password" name="password" id="" required autofocus>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                            <input class="form-control" type="konfirmasi" placeholder="Konfirmasi" name="konfirmasi" id="" required autofocus>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <a class="btn btn-sm" style="border: 2px solid green; display: flex; align-items: center;"
                            href="<?= base_url('pages/login/'); ?>">Batal</a>
                        <input type="submit" class="py-2 px-4 btn btn-info btn-sm pull-right" value="Reset">
                    </div>
                </form>
            </div>
        </body>

        </html>

    <?php } else {
        echo "<script>window.location='" . base_url() . "'</script>";
        exit();
    }
} ?>