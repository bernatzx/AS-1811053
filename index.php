<?php require_once 'config.php';
if (!valid() && !has_akses()) { ?>
<!-- MENAMPILKAN LOGIN -->
    <script>window.location = "<?= base_url('pages/login/') ?>"</script>
<?php } else { ?>
    <!-- MENAMPILKAN DASHBOARD -->
    <script>window.location = "<?= base_url('pages/dashboard/') ?>"</script>
<?php } ?>