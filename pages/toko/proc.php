<?php
require_once '../../config.php';
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}

function trimtext($db, $data)
{
    return trim(mysqli_escape_string($db, $data));
}

function uploadgambar($img, $targetdir, $extimg = null)
{
    $allowtypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (!empty($img['name'])) {
        $filename = basename($img['name']);
        $targetfilepath = $targetdir . $filename;
        $filetype = strtolower(pathinfo($targetfilepath, PATHINFO_EXTENSION));
        if (in_array($filetype, $allowtypes)) {
            if (move_uploaded_file($img["tmp_name"], $targetfilepath)) {
                return $filename;
            } else {
                echo "Gagal mengunggah gambar!";
                exit();
            }
        } else {
            echo "Format file tidak didukung. Gunakan JPG, PNG, JPEG, atau GIF.";
            exit();
        }
    }

    return $extimg;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $targetdir = "../../_assets/images/";
    $id_user = $_SESSION['data']['id_user'];

    $nama = trimtext($db, $_POST["nama_toko"]);
    $alamat = trimtext($db, $_POST["alamat"]);
    $kontak = trimtext($db, $_POST["kontak"]);
    $hari = trimtext($db, $_POST["hari"]);
    $waktu = trimtext($db, $_POST["waktu"]);
    $latti = trimtext($db, $_POST["latti"]);
    $longi = trimtext($db, $_POST["longi"]);

    if (isset($_POST["add"])) {
        $gambar = uploadgambar($_FILES["gambar"], $targetdir);

        mysqli_query($db, "INSERT INTO tb_lokasi (nama_toko, alamat, kontak, hari, waktu, gambar, latitude, longitude) 
            VALUES ('$nama', '$alamat', '$kontak', '$hari', '$waktu', '$gambar', '$latti', '$longi')")
            or die(mysqli_error($db));

        $id_lokasi = mysqli_insert_id($db);

        mysqli_query($db, "INSERT INTO tb_toko (id_user, id_lokasi) VALUES ('$id_user', '$id_lokasi')")
            or die(mysqli_error($db));

        echo "<script>window.location='" . base_url('pages/toko/') . "'</script>";
        exit();
    } elseif (isset($_POST["edit"])) {
        $sql = mysqli_query($db, "SELECT id_lokasi FROM tb_toko WHERE id_user = '$id_user'")
            or die(mysqli_error($db));
        $row = mysqli_fetch_assoc($sql);
        $id_lokasi = $row['id_lokasi'];

        $extsql = mysqli_query($db, "SELECT * FROM tb_lokasi WHERE id_lokasi = '$id_lokasi'")
            or die(mysqli_error($db));
        $extimgdata = mysqli_fetch_assoc($extsql);

        $gambar = uploadgambar($_FILES['gambar'], $targetdir, $extimgdata['gambar'] ?? null);
        $gambarquery = !empty($gambar) ? "gambar = '$gambar'," : "";

        mysqli_query($db, "UPDATE tb_lokasi SET 
            nama_toko = '$nama',
            alamat = '$alamat',
            kontak = '$kontak',
            hari = '$hari',
            waktu = '$waktu',
            $gambarquery
            latitude = '$latti',
            longitude = '$longi'
            WHERE id_lokasi = '$id_lokasi'")
            or die(mysqli_error($db));

        echo "<script>window.location='" . base_url('pages/toko/') . "'</script>";
        exit();
    }
}
?>