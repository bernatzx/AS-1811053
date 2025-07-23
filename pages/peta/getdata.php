<?php
require_once '../../config.php';
$sql = mysqli_query($db, "SELECT * FROM tb_lokasi") or die(mysqli_error($db));

// buat dulu variabel kosong
$lokasi = [];

// cek apakah data ada ktrda
if (mysqli_num_rows($sql) > 0) {

    // kalo ada buat perulangan untuk setiap data
    // trus simpan masing masing data kedalam variabel $data
    while ($data = mysqli_fetch_assoc($sql)) {

        // setelah itu baru dimasukkan kedalam variabel lokasi
        $lokasi[] = $data;
    }
}

// lalu di encode supaya nanti bisa dipanggil dan dibaca oleh kode lain
echo json_encode($lokasi);