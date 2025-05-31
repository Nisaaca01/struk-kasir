<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil data dari form
    $nama = htmlspecialchars($_POST['nama_barang']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah = (int)$_POST['jumlah'];
    $harga = (int)$_POST['harga_satuan'];
    $metode = htmlspecialchars($_POST['metode_pembayaran']);
    $kasir = htmlspecialchars($_POST['kasir']);
    $tanggal = $_POST['tanggal'];

    // hitung diskon 10% jika total > 500000
    $total = $jumlah * $harga;
    $diskon = 0;
    if ($total > 500000) {
        $diskon = 10; // persen
    }
    $total_bayar = $total - ($total * $diskon / 100);

    // simpan ke database
    $stmt = $conn->prepare("INSERT INTO penjualan (nama_barang, kategori, jumlah, harga_satuan, diskon, total, metode_pembayaran, tanggal, kasir) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiissss", $nama, $kategori, $jumlah, $harga, $diskon, $total_bayar, $metode, $tanggal, $kasir);
    $stmt->execute();

    // dapatkan ID penjualan terakhir untuk halaman struk
    $last_id = $stmt->insert_id;

    $stmt->close();

    // redirect ke struk.php dengan id penjualan
    header("Location: struk.php?id=$last_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Input Penjualan - Kasir</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      margin: 20px;
      display: flex;
      justify-content: center;
    }
    .container {
      background: white;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      max-width: 450px;
      width: 100%;
    }
    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
      color: #34495e;
    }
    input, select {
      width: 100%;
      padding: 10px 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
    }
    button {
      margin-top: 25px;
      width: 100%;
      background-color: #27ae60;
      border: none;
      color: white;
      padding: 12px;
      font-weight: 700;
      font-size: 16px;
      border-radius: 10px;
      cursor: pointer;
      transition: background-color 0.3s;
    }
    button:hover {
      background-color: #219150;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Input Penjualan</h1>
    <form method="POST" action="">
      <label for="nama_barang">Nama Barang</label>
      <input type="text" name="nama_barang" id="nama_barang" required>

      <label for="kategori">Kategori</label>
      <select name="kategori" id="kategori" required>
        <option value="" disabled selected>Pilih kategori</option>
        <option value="Makanan">Makanan</option>
        <option value="Minuman">Minuman</option>
        <option value="Elektronik">Elektronik</option>
        <option value="Lainnya">Lainnya</option>
      </select>

      <label for="jumlah">Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" min="1" required>

      <label for="harga_satuan">Harga Satuan (Rp)</label>
      <input type="number" name="harga_satuan" id="harga_satuan" min="0" required>

      <label for="metode_pembayaran">Metode Pembayaran</label>
      <select name="metode_pembayaran" id="metode_pembayaran" required>
        <option value="" disabled selected>Pilih metode</option>
        <option value="Tunai">Tunai</option>
        <option value="Kartu Kredit">Kartu Kredit</option>
        <option value="E-Wallet">E-Wallet</option>
      </select>

      <label for="kasir">Nama Kasir</label>
      <input type="text" name="kasir" id="kasir" required>

      <label for="tanggal">Tanggal Transaksi</label>
      <input type="date" name="tanggal" id="tanggal" value="<?= date('Y-m-d') ?>" required>

      <button type="submit">Cetak Struk</button>
    </form>
  </div>
</body>
</html>
