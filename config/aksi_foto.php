<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date('Y-m-d'); // Perbaiki format tanggal
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand() . '-' . $foto;

    $sql = mysqli_query($koneksi, "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, lokasifile, albumid, userid) VALUES ('$judulfoto', '$deskripsifoto', '$tanggalunggah', '$namafoto', '$albumid', '$userid')");

    // Pastikan file berhasil diupload
    if (move_uploaded_file($tmp, $lokasi . $namafoto)) {
        echo "<script>
        alert('Data berhasil disimpan!');
        location.href='../admin/foto.php';
        </script>";
    } else {
        echo "<script>
        alert('Gagal mengupload file!');
        location.href='../admin/foto.php';
        </script>";
    }
}

if (isset($_POST['edit'])) {
    $fotoid = $_POST['fotoid'];
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $tanggalunggah = date('Y-m-d'); // Perbaiki format tanggal
    $albumid = $_POST['albumid'];
    $userid = $_SESSION['userid'];
    $foto = $_FILES['lokasifile']['name'];
    $tmp = $_FILES['lokasifile']['tmp_name'];
    $lokasi = '../assets/img/';
    $namafoto = rand() . '-' . $foto;

    if ($foto == null) {
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', albumid='$albumid' WHERE fotoid='$fotoid'");

    } else {
        $query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/' . $data['lokasifile'])) {
            unlink('../assets/img/' . $data['lokasifile']);
        }
        move_uploaded_file($tmp, $lokasi . $namafoto);
        $sql = mysqli_query($koneksi, "UPDATE foto SET judulfoto='$judulfoto', deskripsifoto='$deskripsifoto', tanggalunggah='$tanggalunggah', lokasifile='$namafoto', albumid='$albumid' WHERE fotoid='$fotoid'");
    }

    echo "<script>
    alert('Data berhasil diperbarui!');
    location.href='../admin/foto.php';
    </script>";
}
if (isset($_POST['hapus'])) {
$fotoid = $_POST[ 'fotoid'];
$query = mysqli_query($koneksi, "SELECT * FROM foto WHERE fotoid='$fotoid'");
        $data = mysqli_fetch_array($query);
        if (is_file('../assets/img/' . $data['lokasifile'])) {
            unlink('../assets/img/' . $data['lokasifile']);
        }
        $sql = mysqli_query($koneksi, "DELETE FROM foto WHERE fotoid='$fotoid'");
        echo "<script>
    alert('Data berhasil dihapus!');
    location.href='../admin/foto.php';
    </script>";
}
?>
