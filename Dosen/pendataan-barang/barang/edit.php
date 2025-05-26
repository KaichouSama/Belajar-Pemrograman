<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include '../config/koneksi.php';

$id = intval($_GET['id']);
$data = mysqli_query($conn, "SELECT * FROM barang WHERE id=$id");
$row = mysqli_fetch_array($data);

if (!$row) {
    echo "<script>alert('Data tidak ditemukan!');window.location='index.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
    $jumlah = intval($_POST['jumlah']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

    mysqli_query($conn, "UPDATE barang SET nama_barang='$nama_barang', jumlah=$jumlah, keterangan='$keterangan' WHERE id=$id");
    echo "<script>alert('Data berhasil diupdate!');window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Barang</title>
    <link href="/pendataan-barang/assets/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../sidebar.php'; ?>

<div class="p-4">
    <h2>Edit Barang</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= htmlspecialchars($row['nama_barang']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" value="<?= $row['jumlah'] ?>" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" rows="3"><?= htmlspecialchars($row['keterangan']) ?></textarea>
        </div>
        <button class="btn btn-primary" type="submit" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
