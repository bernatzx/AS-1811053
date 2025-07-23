<?php require_once '../../config.php';
if (valid()) { ?>
    <script>window.location = '<?= base_url() ?>';</script>
<?php } else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = trim(mysqli_real_escape_string($db, $_POST['email']));

        $sql = mysqli_query($db, "SELECT id_user FROM tb_user WHERE email = '$email'") or die(mysqli_error($con));
        if (mysqli_num_rows($sql) > 0) {
            $token = mysqli_fetch_assoc($sql);
            echo "<script>window.location='" . base_url("pages/login/reset.php?token=" . $token['id_user']) . "'</script>";
        } else {
            $err = "Email tidak ditemukan!";
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= base_url('_assets/css/style.css') ?>" />
        <title>WebGis | Lupa Kata Password</title>
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
                <p>
                    Tolong masukkan Email anda dibawah ini untuk melakukan permintaan reset kata password anda
                </p>
                <div class="d-flex flex-column gap-3">
                    <div class="d-flex gap-2">
                        <div class="input-group-addon"><i class="fas fa-envelope"></i></div>
                        <input class="form-control" type="email" placeholder="Email" name="email" id="" required autofocus>
                    </div>
                </div>
                <div class="mt-3 d-flex justify-content-center gap-2">
                    <a class="btn btn-sm" style="border: 2px solid green; display: flex; align-items: center;" href="<?=base_url('pages/login/');?>">Login</a>
                    <input type="submit" class="py-2 px-4 btn btn-info btn-sm pull-right" value="Kirim">
                </div>
            </form>
        </div>

        <script src="<?= base_url('_assets/js/all.min.js') ?>"></script>
    </body>

    </html>


<?php }
?>