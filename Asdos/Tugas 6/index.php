<?php
// Data pajak bandara
$bandara_asal = [
    "Soekarno Hatta" => 65000,
    "Husein Sastranegara" => 50000,
    "Abdul Rachman Saleh" => 40000,
    "Juanda" => 30000
];

$bandara_tujuan = [
    "Ngurah Rai" => 85000,
    "Hasanuddin" => 70000,
    "Inanwatan" => 90000,
    "Sultan Iskandar Muda" => 60000
];

// Urutkan nama bandara
ksort($bandara_asal);
ksort($bandara_tujuan);

// Inisialisasi variabel hasil
$hasil = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor = $_POST['nomor'];
    $tanggal = date('d-m-Y');
    $nama_maskapai = $_POST['nama_maskapai'];
    $asal = $_POST['asal'];
    $tujuan = $_POST['tujuan'];
    $harga_tiket = (int) $_POST['harga_tiket'];

    $pajak_asal = $bandara_asal[$asal] ?? 0;
    $pajak_tujuan = $bandara_tujuan[$tujuan] ?? 0;
    $total_pajak = $pajak_asal + $pajak_tujuan;
    $total_harga = $harga_tiket + $total_pajak;
    $hasil = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Rute Penerbangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #2c3e50;
            text-align: center;
        }

        form, table {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color: #3498db;
            color: white;
        }
    </style>
</head>
<body>

<h1>Pendaftaran Rute Penerbangan</h1>

<form method="POST">
    <label for="nomor">Nomor Penerbangan:</label>
    <input type="text" id="nomor" name="nomor" required>

    <label for="nama_maskapai">Nama Maskapai:</label>
    <input type="text" id="nama_maskapai" name="nama_maskapai" required>

    <label for="asal">Bandara Asal:</label>
    <select id="asal" name="asal" required>
        <option value="">-- Pilih Bandara Asal --</option>
        <?php foreach ($bandara_asal as $nama => $pajak): ?>
            <option value="<?= htmlspecialchars($nama) ?>"><?= htmlspecialchars($nama) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="tujuan">Bandara Tujuan:</label>
    <select id="tujuan" name="tujuan" required>
        <option value="">-- Pilih Bandara Tujuan --</option>
        <?php foreach ($bandara_tujuan as $nama => $pajak): ?>
            <option value="<?= htmlspecialchars($nama) ?>"><?= htmlspecialchars($nama) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="harga_tiket">Harga Tiket:</label>
    <input type="number" id="harga_tiket" name="harga_tiket" required>

    <button type="submit">Daftar</button>
</form>

<?php if ($hasil): ?>
    <h1>Data Penerbangan</h1>
    <table>
        <tr><th>Nomor</th><td><?= htmlspecialchars($nomor) ?></td></tr>
        <tr><th>Tanggal</th><td><?= $tanggal ?></td></tr>
        <tr><th>Nama Maskapai</th><td><?= htmlspecialchars($nama_maskapai) ?></td></tr>
        <tr><th>Asal Penerbangan</th><td><?= htmlspecialchars($asal) ?></td></tr>
        <tr><th>Tujuan Penerbangan</th><td><?= htmlspecialchars($tujuan) ?></td></tr>
        <tr><th>Harga Tiket</th><td>Rp <?= number_format($harga_tiket, 0, ',', '.') ?></td></tr>
        <tr><th>Pajak</th><td>Rp <?= number_format($total_pajak, 0, ',', '.') ?></td></tr>
        <tr><th>Total Harga Tiket</th><td><strong>Rp <?= number_format($total_harga, 0, ',', '.') ?></strong></td></tr>
    </table>
<?php endif; ?>

</body>
</html>
