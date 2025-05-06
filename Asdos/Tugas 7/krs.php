<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Data KRS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Data Kartu Rencana Studi (KRS)</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali ke Menu</a>

    <form method="get" class="mb-3">
        <div class="row g-2 align-items-center">
            <div class="col-auto">
                <label for="npm" class="col-form-label">Pilih Mahasiswa</label>
            </div>
            <div class="col-auto">
                <select name="npm" id="npm" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Pilih Mahasiswa --</option>
                    <?php
                    $mhs = $koneksi->query("SELECT * FROM mahasiswa");
                    while ($m = $mhs->fetch_assoc()) {
                        $selected = (isset($_GET['npm']) && $_GET['npm'] == $m['npm']) ? 'selected' : '';
                        echo "<option value='{$m['npm']}' $selected>{$m['npm']} - {$m['nama']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
    </form>

    <?php if (isset($_GET['npm']) && $_GET['npm'] != ''): ?>
        <?php
        // Menampilkan nama mahasiswa
        $npm = $_GET['npm'];
        $mahasiswa = $koneksi->query("SELECT * FROM mahasiswa WHERE npm = '$npm'")->fetch_assoc();
        ?>

        <h4>Nama Mahasiswa: <?= $mahasiswa['nama'] ?></h4>

        <form method="post" class="mb-4">
            <input type="hidden" name="npm" value="<?= $_GET['npm'] ?>">
            <div class="row g-2 align-items-center">
                <div class="col-auto">
                    <label for="kodemk" class="col-form-label">Pilih Mata Kuliah</label>
                </div>
                <div class="col-auto">
                    <select name="kodemk" id="kodemk" class="form-select">
                        <?php
                        $mk = $koneksi->query("SELECT * FROM matakuliah");
                        while ($m = $mk->fetch_assoc()) {
                            echo "<option value='{$m['kodemk']}'>{$m['kodemk']} - {$m['nama']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['tambah'])) {
            $koneksi->query("INSERT INTO krs (mahasiswa_npm, matakuliah_kodemk) VALUES ('{$_POST['npm']}', '{$_POST['kodemk']}')");
            echo "<script>location='krs.php?npm={$_POST['npm']}'</script>";
        }

        if (isset($_GET['hapus'])) {
            $koneksi->query("DELETE FROM krs WHERE id='{$_GET['hapus']}'");
            echo "<script>location='krs.php?npm={$_GET['npm']}'</script>";
        }

        $result = $koneksi->query("SELECT krs.id, matakuliah.nama AS matakuliah_nama, matakuliah.jumlah_sks, mahasiswa.nama AS mahasiswa_nama
                                   FROM krs 
                                   JOIN matakuliah ON krs.matakuliah_kodemk = matakuliah.kodemk 
                                   JOIN mahasiswa ON krs.mahasiswa_npm = mahasiswa.npm
                                   WHERE krs.mahasiswa_npm='{$_GET['npm']}'");
        ?>

        <h5>Mata Kuliah yang Diambil:</h5>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Nama Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($r = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $r['mahasiswa_nama'] ?></td>
                        <td><?= $r['matakuliah_nama'] ?></td>
                        <td><?= $r['jumlah_sks'] ?></td>
                        <td>
                            <a href="?npm=<?= $_GET['npm'] ?>&hapus=<?= $r['id'] ?>" 
                               class="btn btn-danger btn-sm" 
                               onclick="return confirm('Hapus mata kuliah ini dari KRS?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
