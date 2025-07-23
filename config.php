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
    ['label' => 'Daftar Lokasi', 'url' => base_url('pages/lokasi/'), 'icon' => 'fas fa-list', 'admin' => true],
    ['label' => 'Profil', 'url' => base_url('pages/profil/'), 'icon' => 'fas fa-user-pen']
];
function valid()
{
    return isset($_SESSION['valid']) && $_SESSION['valid'] === true;
}
function is_admin()
{
    return valid() && $_SESSION['data']['level'] === 'admin';
}