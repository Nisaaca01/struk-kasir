<?php
require 'db.php';

if (isset($_POST['submit'])) {
  $nama     = $_POST['nama_barang'];
  $jumlah   = (int) $_POST['jumlah'];
  $harga    = (int) $_POST['harga_satuan'];
  $kasir    = $_POST['kasir'];
  $tanggal  = $_POST['tanggal'];
  $metode   = $_POST['metode'];

  $total = $jumlah * $harga;

  $stmt = $conn->prepare("INSERT INTO penjualan (nama_barang, jumlah, harga_satuan, total, kasir, tanggal, metode)
                          VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("siiisss", $nama, $jumlah, $harga, $total, $kasir, $tanggal, $metode);
  $stmt->execute();
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Struk Pembelian</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container struk">
    <h2>🧾 Struk Pembelian</h2>
    <hr>
    <p><strong>Tanggal:</strong> <?= $tanggal ?></p>
    <p><strong>Kasir:</strong> <?= $kasir ?></p>
    <hr>
    <p><strong>Nama Barang:</strong> <?= $nama ?></p>
    <p><strong>Jumlah:</strong> <?= $jumlah ?></p>
    <p><strong>Harga Satuan:</strong> Rp <?= number_format($harga, 0, ',', '.') ?></p>
    <p><strong>Total Bayar:</strong> Rp <?= number_format($total, 0, ',', '.') ?></p>
    <p><strong>Metode Pembayaran:</strong> <?= $metode ?></p>
    <hr>
    <p style="text-align:center;">*** Terima kasih telah berbelanja ***</p>
  </div>
</body>
</html>
