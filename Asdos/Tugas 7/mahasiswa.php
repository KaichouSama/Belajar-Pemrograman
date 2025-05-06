<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Mahasiswa</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Menu</a>
    <a href="?tambah" class="btn btn-primary mb-3">Tambah Mahasiswa</a>

    <?php if (isset($_GET['tambah'])): ?>
        <form method="post" class="mb-4">
            <div class="mb-3">
                <label>NPM</label>
                <input type="text" name="npm" class="form-control">
            </div>
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
                <label>Jurusan</label>
                <select name="jurusan" class="form-select">
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Operasi">Sistem Operasi</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"></textarea>
            </div>
            <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        </form>
    <?php
        if (isset($_POST['simpan'])) {
            $koneksi->query("INSERT INTO mahasiswa VALUES ('$_POST[npm]', '$_POST[nama]', '$_POST[jurusan]', '$_POST[alamat]')");
            echo "<script>location='mahasiswa.php'</script>";
        }
    endif;

    if (isset($_GET['hapus'])) {
        $koneksi->query("DELETE FROM mahasiswa WHERE npm='$_GET[hapus]'");
        echo "<script>location='mahasiswa.php'</script>";
    }

    if (isset($_GET['edit'])) {
        $edit = $koneksi->query("SELECT * FROM mahasiswa WHERE npm='$_GET[edit]'")->fetch_assoc();
    ?>
        <form method="post" class="mb-4">
            <input type="hidden" name="npm" value="<?= $edit['npm'] ?>">
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $edit['nama'] ?>">
            </div>
            <div class="mb-3">
                <label>Jurusan</label>
                <select name="jurusan" class="form-select">
                    <option <?= $edit['jurusan']=='Teknik Informatika'?'selected':'' ?>>Teknik Informatika</option>
                    <option <?= $edit['jurusan']=='Sistem Operasi'?'selected':'' ?>>Sistem Operasi</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control"><?= $edit['alamat'] ?></textarea>
            </div>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
        </form>
    <?php
    }

    if (isset($_POST['update'])) {
        $koneksi->query("UPDATE mahasiswa SET nama='$_POST[nama]', jurusan='$_POST[jurusan]', alamat='$_POST[alamat]' WHERE npm='$_POST[npm]'");
        echo "<script>location='mahasiswa.php'</script>";
    }
    ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th><th>NPM</th><th>Nama</th><th>Jurusan</th><th>Alamat</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $data = $koneksi->query("SELECT * FROM mahasiswa");
        $no = 1; // Menambahkan variabel untuk nomor urut
        while ($d = $data->fetch_assoc()) {
            echo "<tr>
                    <td>$no</td> <!-- Menampilkan nomor urut -->
                    <td>$d[npm]</td>
                    <td>$d[nama]</td>
                    <td>$d[jurusan]</td>
                    <td>$d[alamat]</td>
                    <td>
                        <a href='?edit=$d[npm]' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='?hapus=$d[npm]' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data?\")'>Hapus</a>
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
