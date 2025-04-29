<!DOCTYPE html>
<html>
<head>
    <title>Kategori Usia</title>
</head>
<body>
    <h2>Masukkan Umur Anda</h2>
    <form method="post">
        <input type="number" name="umur" required>
        <button type="submit">Cek Kategori</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $umur = $_POST['umur'];

        if ($umur < 13) {
            echo "<p>Kategori: Anak</p>";
        } elseif ($umur >= 13 && $umur <= 17) {
            echo "<p>Kategori: Remaja</p>";
        } else {
            echo "<p>Kategori: Dewasa</p>";
        }
    }
    ?>
</body>
</html>
