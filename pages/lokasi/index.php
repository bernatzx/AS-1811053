<?php
$label = 'Daftar Lokasi';
include_once "../../header.php";
if (!has_akses(['admin'])) {
    echo "<script>window.location='" . base_url() . "'</script>";
}

$pencarian = isset($_GET['pencarian']) ? trim(mysqli_real_escape_string($db, $_GET['pencarian'])) : '';
$sql_count = "SELECT COUNT(*) AS total FROM tb_lokasi";
if ($pencarian != '') {
    $sql_count .= " WHERE nama_toko LIKE '%$pencarian%' OR alamat LIKE '%$pencarian%'";
}
$result_count = mysqli_query($db, $sql_count) or die(mysqli_error($db));
$row_count = mysqli_fetch_assoc($result_count);
$jml_lokasi = $row_count['total'];

$query = "SELECT * FROM tb_lokasi";
if ($pencarian != '') {
    $query .= " WHERE nama_toko LIKE '%$pencarian%' OR alamat LIKE '%$pencarian%'";
}
$sql_lokasi = mysqli_query($db, $query) or die(mysqli_error($db));
?>

<div class="d-flex justify-content-between">
    <div>
        <h4><?= $label ?></h4>
    </div>
    <div style="display: flex; align-items: center; gap: 4px;">
        <div>
            <a href="<?= base_url('pages/lokasi/') ?>" class="btn btn-outline-secondary btn-sm"><i
                    class="fas fa-refresh"></i></a>
        </div>

        <form method="get" class="d-flex form-pencarian-custom">
            <div class="">
                <input type="text" name="pencarian" placeholder="Cari" class="">
            </div>
            <div>
                <button class="btn" type="submit"><i class="fas fa-magnifying-glass"></i></button>
            </div>
        </form>
        <div>
            <a href="add.php" class="btn btn-sm btn-info">+ Tambah Data</a>
        </div>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Tempat</th>
                <th>Alamat</th>
                <th>Kontak</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th class="text-center">
                    <i class="fas fa-gear"></i>
                </th>
            </tr>
        </thead>
        <tbody>

            <?php

            // ini dibawah kode php untuk menampilkan seluruh data lokasi
            // DESC ini dpe arti tampilakn dari data yang paling baru diinput
            $no = 1;
            if ($jml_lokasi > 0) {
                while ($data = mysqli_fetch_assoc($sql_lokasi)) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_toko'] ?></td>
                        <td><?= $data['alamat'] ?></td>
                        <td><?= $data['kontak'] ?></td>
                        <td><?= $data['latitude'] ?></td>
                        <td><?= $data['longitude'] ?></td>
                        <td class="text-center d-flex gap-2">
                            <div>
                                <a href="edit.php?id=<?= $data['id_lokasi'] ?>" class="btn btn-success btn-sm"><i
                                        class="fas fa-pencil"></i></a>
                            </div>
                            <div>
                                <!-- bagian ini yang tangai pertanyaan hapus kalo ok maka -->
                                <a onclick="return confirm('Yakin akan dihapus?')" href="del.php?id=<?= $data['id_lokasi'] ?>"
                                    class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan=\"7\" align=\"center\">Data Kosong!</td></tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<?php include_once "../../footer.php" ?>