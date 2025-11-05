<?php
$servername = "localhost";
$username = "root"; // default XAMPP user
$password = ""; // biasanya kosong
$database = "inventory_db";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// echo "Koneksi berhasil!"; // untuk tes
?>
