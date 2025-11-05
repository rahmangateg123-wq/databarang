<!DOCTYPE html>
<html>
<body>
    <link rel="stylesheet" href="style.css">
<h2>+ Tambah Barang Masuk</h2>

<form method="POST">
    Nama Barang: <input type="text" name="nama"><br><br>
    Jumlah: <input type="number" name="jumlah"><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
include 'config.php'; // pastikan file koneksi kamu bernama config.php

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];

    // Cek apakah barang sudah ada di tabel tb_barang
    $cek = mysqli_query($conn, "SELECT * FROM tb_barang WHERE nama_barang='$nama'");

    if (mysqli_num_rows($cek) > 0) {
        // Jika barang sudah ada, ambil datanya
        $barang = mysqli_fetch_assoc($cek);
        $id_barang = $barang['ID'];

        // Update stok barang
        mysqli_query($conn, "UPDATE tb_barang SET stok = stok + $jumlah WHERE id = '$id_barang'");
    } else {
        // Jika barang belum ada, tambahkan barang baru
        mysqli_query($conn, "INSERT INTO tb_barang (nama_barang, stok) VALUES ('$nama', '$jumlah')");
        $id_barang = mysqli_insert_id($conn);
    }

    // Tambahkan data ke tabel transaksi
    mysqli_query($conn, "INSERT INTO tb_transaksi (id_barang, jenis, jumlah) VALUES ('$id_barang', 'masuk', '$jumlah')");

    echo "<p>Barang berhasil ditambahkan!</p>";
}
?>

<a href="index.php">🔙 Kembali</a>

</body>
</html>