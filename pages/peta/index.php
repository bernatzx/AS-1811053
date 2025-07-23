<?php
$label = 'Peta Lokasi Service Laptop';
include_once "../../header.php";
if (!valid()) {
    echo "<script>window.location='" . base_url() . "'</script>";
    exit();
}
?>

<div class="d-flex items-center justify-content-between">
    <div>
        <h3><?= $label ?></h3>
    </div>
    <div class="d-flex items-center gap-2">
        <input type="text" id="searchInput" class="form-control" placeholder="Cari" />
        <button id="searchButton" class="btn btn-primary"><i class="fas fa-search"></i></button>
        <a href="" class="btn btn-outline-secondary"><i class="fas fa-refresh"></i></a>
    </div>
</div>


<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    var map = L.map('map').setView([0.8025, 127.3408], 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    var markers = [];
    fetch('getdata.php').then(res => res.json()).then(data => {
        dataLokasi = data;
        data.forEach(function (lokasi) {
            var marker = L.marker([lokasi.latitude, lokasi.longitude])
                .addTo(map)
                .bindPopup(`<b><a href="detail.php?id=${lokasi.id_lokasi}">${lokasi.nama_toko}</a></b><br>${lokasi.alamat}`);
            markers.push({ marker, nama: lokasi.nama_toko.toLowerCase() })
        });
    }).catch(err => console.error('Error:', err));
    document.getElementById('searchButton').addEventListener('click', function () {
        var searchTerm = document.getElementById('searchInput').value.toLowerCase();
        var found = markers.find(item => item.nama.includes(searchTerm));
        if (found) {
            map.setView(found.marker.getLatLng(), 15);
            found.marker.openPopup();
        } else {
            alert('Lokasi tidak ditemukan');
        }
    });
</script>

<?php include_once "../../footer.php" ?>