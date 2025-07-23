<?php require_once '../../config.php';
if (valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = trim(mysqli_real_escape_string($db, $_POST['namalengkap']));
    $email = trim(mysqli_real_escape_string($db, $_POST['email']));
    $user = trim(mysqli_real_escape_string($db, $_POST['username']));
    $pass = trim(mysqli_real_escape_string($db, $_POST['password']));
    $konfpass = trim(mysqli_real_escape_string($db, $_POST['konfpass']));

    if ($pass == $konfpass) {
        $cekemail = mysqli_query($db, "SELECT * FROM tb_user WHERE email = '$email'") or die(mysqli_error($db));
        if (mysqli_num_rows($cekemail) > 0) {
            $err = "Email telah digunakan!";
        } else {
            $encpass = sha1($pass);
            mysqli_query($db, "INSERT INTO tb_user (username, password, email, nama, level) VALUES ('$user', '$encpass', '$email', '$nama', 'user')") or die(mysqli_error($db));

            echo "<script>window.location='" . base_url() . "'</script>";
            exit();
        }
    } else {
        $err = "Password tidak cocok!";
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('_assets/css/style.css') ?>" />
    <title>WebGis | Daftar</title>
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
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-user"></i></div>
                    <input class="form-control" type="text" placeholder="Nama Lengkap" name="namalengkap" id="" required
                        autofocus>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-user"></i></div>
                    <input class="form-control" type="text" placeholder="Email" name="email" id="" required>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-user"></i></div>
                    <input class="form-control" type="text" placeholder="Username" name="username" id="" required>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                    <input class="form-control" type="password" placeholder="Password" name="password" id="" required>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                    <input class="form-control" type="password" placeholder="Konfirmasi password" name="konfpass" id=""
                        required>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                <input type="submit" class="py-2 px-4 btn btn-info btn-sm pull-right" value="Daftar">
            </div>

            <div class="pt-3 d-flex justify-content-center">
                <div>
                    Sudah Punya Akun? <a href="index.php">Login</a>
                </div>
            </div>
        </form>
    </div>

    <script src="<?= base_url('_assets/js/all.min.js') ?>"></script>
</body>

</html>