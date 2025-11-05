<!DOCTYPE html>
<html>
<body>
    <link rel="stylesheet" href="style.css">
<h2>- Barang Keluar</h2>

<form method="POST">
    Nama Barang: <input type="text" name="nama"><br><br>
    Jumlah: <input type="number" name="jumlah"><br><br>
    <button type="submit" name="submit">Simpan</button>
</form>

<?php
include 'config.php'; // koneksi database

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];

    // Cek apakah barang ada di database
    $cek = mysqli_query($conn, "SELECT * FROM tb_barang WHERE nama_barang='$nama'");

    if (mysqli_num_rows($cek) > 0) {
        $barang = mysqli_fetch_assoc($cek);
        $id_barang = $barang['ID']; // pastikan kolomnya benar di database
        $stok_sekarang = $barang['stok'];

        if ($stok_sekarang >= $jumlah) {
            // Kurangi stok
            mysqli_query($conn, "UPDATE tb_barang SET stok = stok - $jumlah WHERE id='$id_barang'");

            // Simpan ke tabel transaksi
            mysqli_query($conn, "INSERT INTO tb_transaksi (id_barang, jenis, jumlah) VALUES ('$id_barang', 'keluar', '$jumlah')");

            echo "<p>Barang keluar berhasil disimpan!</p>";
        } else {
            echo "<p style='color:red;'>Stok tidak cukup!</p>";
        }
    } else {
        echo "<p style='color:red;'>Barang tidak ditemukan!</p>";
    }
}
?>

<a href="index.php">🔙 Kembali</a>

</body>
</html>