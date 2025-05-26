<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Barang</title>
    <link href="/pendataan-barang/assets/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../sidebar.php'; ?>

<div class="p-4">
    <h2>Data Barang</h2>
    <a href="tambah.php" class="btn btn-success mb-3">Tambah Barang</a>

    <form method="GET" class="mb-3">
        <input type="text" name="cari" class="form-control" placeholder="Cari nama barang..." value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : '' ?>">
    </form>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (isset($_GET['cari'])) {
                $cari = mysqli_real_escape_string($conn, $_GET['cari']);
                $data = mysqli_query($conn, "SELECT * FROM barang WHERE nama_barang LIKE '%$cari%' ORDER BY id DESC");
            } else {
                $data = mysqli_query($conn, "SELECT * FROM barang ORDER BY id DESC");
            }

            while ($row = mysqli_fetch_array($data)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                <td><?= $row['jumlah'] ?></td>
                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
