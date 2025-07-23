<!-- ini kode untuk menampilkan formulir edit -->

<?php
$label = 'Ubah Detail Lokasi';
include_once "../../header.php";
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}
$id = $_GET['id'];
$sql = mysqli_query($db, "SELECT * FROM tb_lokasi WHERE id_lokasi = '$id'") or die(mysqli_error($db));
$data = mysqli_fetch_assoc($sql);
?>

<div class="d-flex justify-content-between">
    <div>
        <h4><?= $label ?></h4>
    </div>
    <div>
        <a href="<?= base_url('pages/lokasi/') ?>" class="btn btn-sm btn-secondary">
            < Kembali</a>
    </div>
</div>
<form action="proc.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="d-flex border-bottom mb-3">
        <div class="d-flex flex-column">
            <span style="font-size: 1.50rem;">Gambar</span>
            <input id="gambar" type="file" name="gambar">
            <p class="small">Kosongkan jika tidak ingin mengubah gambar</p>
        </div>
        <?php if (!empty($data['gambar'])): ?>
            <p><img src="../../_assets/images/<?= $data['gambar'] ?>" alt="Gambar TPQ"
                    style="max-width: 120px; height: auto;"></p>
        <?php endif; ?>
    </div>
    <div class="grid-container">
        <div class="gird-item">
            <label for="nama_toko">Nama Tempat</label>
            <input id="nama_toko" value="<?= $data['nama_toko'] ?>" class="form-control" type="text" name="nama_toko"
                required>
        </div>
        <div class="gird-item">
            <label for="alamat">Alamat Tempat</label>
            <input id="alamat" value="<?= $data['alamat'] ?>" class="form-control" type="text" name="alamat" required>
        </div>
        <div class="gird-item">
            <label for="kontak">Kontak</label>
            <input id="kontak" value="<?= $data['kontak'] ?>" class="form-control" type="text" name="kontak" required>
        </div>
        <div class="gird-item">
            <label for="hari">Hari</label>
            <input id="hari" value="<?= $data['hari'] ?>" class="form-control" type="text" name="hari" required>
        </div>
        <div class="gird-item">
            <label for="waktu">Waktu</label>
            <input id="waktu" value="<?= $data['waktu'] ?>" class="form-control" type="text" name="waktu" required>
        </div>
        <div class="gird-item">
            <label for="latti">Latitude</label>
            <input id="latti" value="<?= $data['latitude'] ?>" class="form-control" type="text" name="latti" required>
        </div>
        <div class="gird-item">
            <label for="longi">Longitude</label>
            <input id="longi" value="<?= $data['longitude'] ?>" class="form-control" type="text" name="longi" required>
        </div>
    </div>
    <input class="mt-3 btn btn-sm btn-info py-2 px-4" type="submit" name="edit" value="Ubah">
</form>

<?php include_once "../../footer.php" ?>