<?php
require_once '../../config.php';

if (valid()) {
    // nah ini query untuk hapus lokasi yang diklik
    mysqli_query($db, "DELETE FROM tb_lokasi WHERE id_lokasi = '$_GET[id]'") or die (mysqli_error($db));
    echo "<script>window.location='".base_url('pages/lokasi/')."'</script>";
} else {
    exit();
}