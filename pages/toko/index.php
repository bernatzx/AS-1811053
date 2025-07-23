<!-- ini dpe kode untuk menampilkan data lokasi -->

<?php
$label = 'Toko Anda';
include_once "../../header.php";
if (!has_akses(['pemilik-toko'])) {
    echo "<script>window.location='" . base_url() . "'</script>";
}
$ada = false;
$id = $_SESSION['data']['id_lokasi'];
if ($id == 0) {
    $ada = true;
}

$sql = mysqli_query($db, "SELECT * FROM tb_lokasi WHERE id_lokasi = '$id'") or die(mysqli_error($db));
$data = mysqli_fetch_assoc($sql); ?>

<div class="d-flex justify-content-between">
    <div>
        <h4><?= $label ?></h4>
    </div>
</div>


<form action="proc.php" method="post" class="d-flex gap-3" enctype="multipart/form-data">
    <div style="font-size: 1rem; width: 100%; border-radius: 16px" class="p-3 border">
        <div class="row mb-2">
            <div class="col-4">Nama Toko</div>
            <input class="col-7 form-control" type="text" name="nama_toko" value=<?= $data['nama_toko'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Alamat</div>
            <input class="col-7 form-control" type="text" name="alamat" value=<?= $data['alamat'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Kontak</div>
            <input class="col-7 form-control" type="text" name="kontak" value=<?= $data['kontak'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Hari</div>
            <input class="col-7 form-control" type="text" name="hari" value=<?= $data['hari'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Waktu</div>
            <input class="col-7 form-control" type="text" name="waktu" value=<?= $data['waktu'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Latitude</div>
            <input class="col-7 form-control" type="text" name="latti" value=<?= $data['latti'] ?? '-' ?>>
        </div>
        <div class="row mb-2">
            <div class="col-4">Longitude</div>
            <input class="col-7 form-control" type="text" name="longi" value=<?= $data['longi'] ?? '-' ?>>
        </div>


        <?php
        if ($ada) { ?>
            <div class="d-flex border-bottom mb-3">
                <div class="d-flex flex-column">
                    <span style="font-size: 1.50rem;">Gambar</span>
                    <input id="gambar" type="file" accept="image/*" name="gambar" required>
                </div>
            </div>
            <input class="mt-3 btn btn-sm btn-info py-2 px-4" type="submit" name="add" value="Simpan">
        <?php } else { ?>
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
            <input class="mt-3 btn btn-sm btn-info py-2 px-4" type="submit" name="edit" value="Ubah">
        <?php } ?>

    </div>

    <?php if (!empty($data['gambar'])): ?>
        <img src="../../_assets/images/<?= $data['gambar'] ?>" alt="Gambar TPQ" class="border"
            style="padding: 10px; max-width: 300px; height: 300px; border-radius: 16px;">
    <?php else: ?>
        <p>Tidak ada gambar yang tersedia.</p>
    <?php endif; ?>


</form>

<?php include_once "../../footer.php" ?>