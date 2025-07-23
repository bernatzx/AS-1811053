<?php require_once 'config.php';
if (!valid() && !is_admin()) { ?>
<!-- MENAMPILKAN LOGIN -->
    <script>window.location = "<?= base_url('pages/login/') ?>"</script>
<?php } else { ?>
    <!-- MENAMPILKAN DASHBOARD -->
    <script>window.location = "<?= base_url('pages/dashboard/') ?>"</script>
<?php } ?>