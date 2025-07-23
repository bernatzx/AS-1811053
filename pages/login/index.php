<!-- ini untuk menampilkan login -->
<!-- sekalian dia tangani logika backend -->

<!-- barusan ngn p wa masuk blng ngn su lia sur punya -->



<?php require_once '../../config.php';
if (valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ini yang tangani logika backend
    $user = trim(mysqli_real_escape_string($db, $_POST['username']));
    $pass = trim(mysqli_real_escape_string($db, $_POST['password']));
    $level = trim(mysqli_real_escape_string($db, $_POST['level']));
    $encpass = sha1($pass);

    if ($level === "admin") {
        $sql = mysqli_query($db, "SELECT * FROM tb_admin WHERE username = '$user' AND password = '$encpass' AND level = 'admin'") or die(mysqli_error($db));
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION['valid'] = true;
            $_SESSION['data'] = mysqli_fetch_assoc($sql);
            $_SESSION['pass'] = $pass;

            echo "<script>window.location='" . base_url() . "'</script>";
            exit();
        } else {
            $err = "Gagal Login | Data tidak valid!";
        }
    } else {
        $sql = mysqli_query($db, "SELECT * FROM tb_user WHERE username = '$user' AND password = '$encpass' AND level = 'user'") or die(mysqli_error($db));
        if (mysqli_num_rows($sql) > 0) {
            $_SESSION['valid'] = true;
            $_SESSION['data'] = mysqli_fetch_assoc($sql);
            $_SESSION['pass'] = $pass;

            echo "<script>window.location='" . base_url() . "'</script>";
            exit();
        } else {
            $err = "Gagal Login | Data tidak valid!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('_assets/css/style.css') ?>" />
    <title>WebGis | Login</title>
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
        <!-- ini yang tangani menampilkan formulir login -->
        <form method="post">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-user"></i></div>
                    <input class="form-control" type="text" placeholder="Username" name="username" id="" required>
                </div>
                <div class="d-flex gap-2">
                    <div class="input-group-addon"><i class="fas fa-lock"></i></div>
                    <input class="form-control" type="password" placeholder="Password" name="password" id="" required>
                </div>
                <div class="d-flex gap-2">
                    <select class="form-control" name="level" required>
                        <option value="" disabled selected>Level</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>

            <div class="pt-3">
                <a href="lupa.php">Lupa Password</a>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                <input type="submit" class="py-2 px-4 btn btn-info btn-sm pull-right" value="Login">
            </div>

            <div class="pt-3 d-flex justify-content-center">
                <div>
                    Belum Punya Akun? <a href="daftar.php">Daftar</a>
                </div>
            </div>
        </form>
    </div>

    <script src="<?= base_url('_assets/js/all.min.js') ?>"></script>
</body>

</html>