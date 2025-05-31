<?php
require 'db.php';

if (!isset($_GET['id'])) {
    echo "ID penjualan tidak ditemukan.";
    exit;
}

$id = (int)$_GET['id'];

$stmt = $conn->prepare("SELECT * FROM penjualan WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Data penjualan tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Struk Penjualan</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f9fafc;
      display: flex;
      justify-content: center;
      padding: 20px;
    }
    .struk-container {
      background: white;
      padding: 25px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 18px rgba(0, 0, 0, 0.1);
      max-width: 450px;
      width: 100%;
    }
    h2 {
      text-align: center;
      color: #34495e;
      margin-bottom: 20px;
      border-bottom: 2px dashed #ddd;
      padding-bottom: 10px;
    }
    .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .logo img {
      height: 70px;
    }
    .info-row {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed #ccc;
      font-size: 15px;
      color: #555;
    }
    .info-row:last-child {
      border-bottom: none;
    }
    .total-row {
      font-weight: 700;
      font-size: 18px;
      color: #2ecc71;
      border-top: 2px solid #2ecc71;
      padding-top: 12px;
      margin-top: 12px;
    }
    .footer {
      text-align: center;
      margin-top: 25px;
      font-style: italic;
      color: #888;
    }
  </style>
</head>
<body>

  <div class="struk-container">
    <div class="logo">
      <img src="https://cdn-icons-png.flaticon.com/512/34/34568.png" alt="Logo Toko" />
    </div>
    <h2>Struk Pembelian</h2>

    <div class="info-row"><span>Tanggal</span><span><?= date('d-m-Y', strtotime($data['tanggal'])) ?></span></div>
    <div class="info-row"><span>Kasir</span><span><?= htmlspecialchars($data['kasir']) ?></span></div>
    <div class="info-row"><span>Nama Barang</span><span><?= htmlspecialchars($data['nama_barang']) ?></span></div>
    <div class="info-row"><span>Kategori</span><span><?= htmlspecialchars($data['kategori']) ?></span></div>
    <div class="info-row"><span>Jumlah</span><span><?= $data['jumlah'] ?></span></div>
    <div class="info-row"><span>Harga Satuan</span><span>Rp <?= number_format($data['harga_satuan'], 0, ',', '.') ?></span></div>
    <div class="info-row"><span>Diskon</span><span><?= $data['diskon'] ?>%</span></div>
    <div class="total-row"><span>Total Bayar</span><span>Rp <?= number_format($data['total'], 0, ',', '.') ?></span></div>
    <div class="info-row"><span>Metode Pembayaran</span><span><?= htmlspecialchars($data['metode_pembayaran']) ?></span></div>

    <div class="footer">*** Terima Kasih ***</div>
  </div>

</body>
</html>
