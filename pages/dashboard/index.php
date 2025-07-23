<?php
$label = 'Selamat Datang';
include_once "../../header.php";
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
} ?>

<div>
    <h3>
        <?= $label ?>
        <span style="font-size: 16px;">
            <?= $_SESSION['data']['nama'] ?>
        </span>
    </h3>
    <div class="custom-dashboard-judul">
        <h6 class="font-weight-bold">
            SISTEM INFORMASI GEOGRAFIS PEMETAAN LOKASI SERVICE LAPTOP di KOTA TERNATE BERBASIS WEB
        </h6>
    </div>
</div>

<?php include_once "../../footer.php"; ?>