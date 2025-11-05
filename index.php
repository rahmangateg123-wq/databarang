<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <style>
        table { border-collapse: collapse; width: 50%; }
        th, td { border: 1px solid #131212ff; padding: 8px; }
        a { margin-right: 10px; }
    </style>
    
</head>
<body>
    <link rel="stylesheet" href="style.css">
<h2>📦 Data Barang</h2>
<a href="masuk.php">Barang Masuk</a> |
<a href="keluar.php">Barang Keluar</a>

<table>
<tr>
    <th>ID</th>
    <th>Nama Barang</th>
    <th>Stok</th>
</tr>
<?php
$result = mysqli_query($conn, "SELECT * FROM tb_barang");
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['ID']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['stok']}</td>
          </tr>";
}
?>
</table>
</body>
</html>
