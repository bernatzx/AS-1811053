<?php
require_once 'config.php';
session_unset();
session_destroy();
echo "<script>window.location='".base_url()."'</script>";
exit();