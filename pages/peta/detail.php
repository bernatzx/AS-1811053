<!-- ini dpe kode untuk menampilkan data lokasi -->

<?php
$label = 'Detail Lokasi';
include_once "../../header.php";

$id = $_GET['id'];
$sql = mysqli_query($db, "SELECT * FROM tb_lokasi WHERE id_lokasi = '$id'") or die(mysqli_error($db));
$data = mysqli_fetch_assoc($sql); ?>

<div class="d-flex justify-content-between">
    <div>
        <h4><?= $label ?></h4>
    </div>
    <div>
        <a href="<?= base_url('pages/peta/') ?>" class="btn btn-sm btn-secondary">
            < Kembali</a>
    </div>
</div>


<div class="d-flex gap-3">
    <div style="font-size: 1rem; width: 100%; border-radius: 16px" class="p-3 border">
        <div class="row">
            <div class="col-4">Nama Tempat Service</div>
            <div class="col-7 text-black">: <?= $data['nama_toko'] ?></div>
        </div>
        <div class="row">
            <div class="col-4">Alamat</div>
            <div class="col-7 text-black">: <?= $data['alamat'] ?></div>
        </div>
        <div class="row">
            <div class="col-4">Kontak</div>
            <div class="col-7 text-black">: <?= $data['kontak'] ?></div>
        </div>
        <div class="row">
            <div class="col-4">Hari</div>
            <div class="col-7 text-black">: <?= $data['hari'] ?></div>
        </div>
        <div class="row">
            <div class="col-4">Waktu</div>
            <div class="col-7 text-black">: <?= $data['waktu'] ?></div>
        </div>
    </div>

    <?php if (!empty($data['gambar'])): ?>
        <img src="../../_assets/images/<?= $data['gambar'] ?>" alt="Gambar TPQ" class="border"
            style="padding: 10px; max-width: 300px; height: 300px; border-radius: 16px;">
    <?php else: ?>
        <p>Tidak ada gambar yang tersedia.</p>
    <?php endif; ?>
</div>

<?php include_once "../../footer.php" ?>