<!-- ini kode untuk menampilkan formulir tambah -->

<?php
$label = 'Tambah Lokasi';
include_once "../../header.php";
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
} ?>

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

    <div class="d-flex border-bottom mb-3">
        <div class="d-flex flex-column">
            <span style="font-size: 1.50rem;">Gambar</span>
            <input id="gambar" type="file" accept="image/*" name="gambar" required>
        </div>
    </div>
    <div class="grid-container">
        <div class="gird-item">
            <input class="form-control" type="text" name="nama_toko" placeholder="Nama Tempat" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="alamat" placeholder="Alamat" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="kontak" placeholder="Kontak" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="hari" placeholder="Hari" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="waktu" placeholder="Waktu" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="latti" placeholder="Latitude" required>
        </div>
        <div class="gird-item">
            <input class="form-control" type="text" name="longi" placeholder="Longitude" required>
        </div>
    </div>
    <input class="mt-3 btn btn-sm btn-info py-2 px-4" type="submit" name="add" value="Tambah">
</form>

<?php include_once "../../footer.php" ?>