<?php
session_start();

// ini koneksi ke database
$db = mysqli_connect('localhost', 'root', '', 'akhyar');
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
function base_url($url = null)
{
    $baseUrl = 'http://localhost/akhyar';
    if ($url != null) {
        return $baseUrl . '/' . $url;
    } else {
        return $baseUrl;
    }
}
$menu = [
    ['label' => 'Dashboard', 'url' => base_url('pages/dashboard/'), 'icon' => 'fas fa-gauge'],
    ['label' => 'Lihat Peta', 'url' => base_url('pages/peta/'), 'icon' => 'fas fa-map-pin'],
    ['label' => 'Daftar Lokasi', 'url' => base_url('pages/lokasi/'), 'icon' => 'fas fa-list', 'akses' => ['admin']],
    ['label' => 'Lihat Toko', 'url' => base_url('pages/toko/'), 'icon' => 'fas fa-shop', 'akses' => ['pemilik-toko']],
    ['label' => 'Profil', 'url' => base_url('pages/profil/'), 'icon' => 'fas fa-user-pen']
];
function valid()
{
    return isset($_SESSION['valid']) && $_SESSION['valid'] === true;
}
function user_level()
{
    return valid() ? $_SESSION['data']['level'] : null;
}
function has_akses($akses = [])
{
    if (!valid()) return false;
    $level = user_level();
    if (empty(($akses))) {
        return true;
    }
    if ($akses === ['admin'] && $level !== 'admin') {
        return false;
    }
    if ($akses === ['pemilik-toko'] && $level !== 'pemilik-toko') {
        return false;
    }
    return in_array($level, $akses);
}