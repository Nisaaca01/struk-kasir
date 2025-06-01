<?php require 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Penjualan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Input Penjualan</h1>
    <form action="struk.php" method="POST">
      <label>Nama Barang</label>
      <input type="text" name="nama_barang" required>

      <label>Jumlah</label>
      <input type="number" name="jumlah" required>

      <label>Harga Satuan</label>
      <input type="number" name="harga_satuan" required>

      <label>Nama Kasir</label>
      <input type="text" name="kasir" required>

      <label>Tanggal</label>
      <input type="date" name="tanggal" value="<?= date('Y-m-d') ?>" required>

      <label>Metode Pembayaran</label>
      <select name="metode" required>
        <option value="Tunai">Tunai</option>
        <option value="Transfer">Transfer</option>
      </select>

      <button type="submit" name="submit">Cetak Struk</button>
    </form>
  </div>
</body>
</html>
