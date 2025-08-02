<?php
$label = 'Profil';
include_once "../../header.php";
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = trim(mysqli_real_escape_string($db, $_POST['username']));
    $pass = trim(mysqli_real_escape_string($db, $_POST['password']));
    $encpass = sha1($pass);
    $id = $_POST['id'];
    mysqli_query($db, "UPDATE tb_user SET username = '$user', password = '$encpass' WHERE id_user = '$id'") or die(mysqli_error($db));
    $sql = mysqli_query($db, "SELECT * FROM tb_user WHERE id_user = '$id'") or die(mysqli_error($db));
    $_SESSION['data'] = mysqli_fetch_assoc($sql);
    $_SESSION['pass'] = $pass;
    echo "<script>window.location='" . base_url('pages/profil/') . "'</script>";
    exit();
}
?>

<h4><?= $label ?></h4>
<form class="profil-form" method="post">
    <input type="hidden" name="id" value="<?= array_values($_SESSION['data'])[0] ?>">
    <div class="d-flex gap-4 groupnya">
        <div class="inputan">
            <div class="input-group-addon"><i class="fas fa-user"></i></div>
            <input value="<?= $_SESSION['data']['username'] ?>" class="form-control" type="text" name="username" id=""
                required>
        </div>
        <div class="inputan">
            <div class="input-group-addon"><i class="fas fa-lock"></i></div>
            <input value="<?= $_SESSION['pass'] ?>" class="form-control" type="password" name="password" id="" required>
        </div>
    </div>
    <div class="mt-3">
        <input onclick="return confirm('Anda yakin untuk diubah profilnya?')" type="submit"
            class="py-2 px-4 btn btn-info btn-sm" value="Ubah">
    </div>
</form>

<?php include_once "../../footer.php" ?>