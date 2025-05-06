<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mata Kuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Mata Kuliah</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Menu</a>
    <a href="?tambah" class="btn btn-primary mb-3">Tambah Mata Kuliah</a>

    <?php if (isset($_GET['tambah'])): ?>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <label>Kode MK</label>
                <input type="text" name="kodemk" class="form-control">
            </div>
            <div class="mb-3">
                <label>Nama Mata Kuliah</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jumlah SKS</label>
                <input type="number" name="jumlah_sks" class="form-control">
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        </form>
    <?php
        if (isset($_POST['simpan'])) {
            $koneksi->query("INSERT INTO matakuliah VALUES ('$_POST[kodemk]', '$_POST[nama]', '$_POST[jumlah_sks]')");
            echo "<script>location='matakuliah.php'</script>";
        }
    endif;

    if (isset($_GET['hapus'])) {
        $koneksi->query("DELETE FROM matakuliah WHERE kodemk='$_GET[hapus]'");
        echo "<script>location='matakuliah.php'</script>";
    }

    if (isset($_GET['edit'])) {
        $edit = $koneksi->query("SELECT * FROM matakuliah WHERE kodemk='$_GET[edit]'")->fetch_assoc();
    ?>
        <form method="post" class="mb-4">
            <input type="hidden" name="kodemk" value="<?= $edit['kodemk'] ?>">
            <div class="mb-3">
                <label>Nama Mata Kuliah</label>
                <input type="text" name="nama" class="form-control" value="<?= $edit['nama'] ?>">
            </div>
            <div class="mb-3">
                <label>Jumlah SKS</label>
                <input type="number" name="jumlah_sks" class="form-control" value="<?= $edit['jumlah_sks'] ?>">
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>
    <?php
    }

    if (isset($_POST['update'])) {
        $koneksi->query("UPDATE matakuliah SET nama='$_POST[nama]', jumlah_sks='$_POST[jumlah_sks]' WHERE kodemk='$_POST[kodemk]'");
        echo "<script>location='matakuliah.php'</script>";
    }
    ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th><th>Kode MK</th><th>Nama</th><th>Jumlah SKS</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = $koneksi->query("SELECT * FROM matakuliah");
        $no = 1; // Menambahkan variabel untuk nomor urut
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                    <td>$no</td> <!-- Menampilkan nomor urut -->
                    <td>$d[kodemk]</td>
                    <td>$d[nama]</td>
                    <td>$d[jumlah_sks]</td>
                    <td>
                        <a href='?edit=$d[kodemk]' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='?hapus=$d[kodemk]' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
                    </td>
                  </tr>";
            $no++; // Increment nomor urut
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
