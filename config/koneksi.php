<?php
$koneksi = mysqli_connect('localhost', 'root', '', 'galeri_foto');

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
