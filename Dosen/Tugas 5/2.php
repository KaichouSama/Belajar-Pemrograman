<!DOCTYPE html>
<html>
<head>
    <title>Cek Bilangan</title>
</head>
<body>
    <h2>Masukkan Bilangan</h2>
    <form method="post">
        <input type="number" name="angka" required>
        <button type="submit">Cek Bilangan</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $angka = $_POST['angka'];

        if ($angka > 0) {
            echo "<p>Bilangan $angka adalah Positif</p>";
        } elseif ($angka < 0) {
            echo "<p>Bilangan $angka adalah Negatif</p>";
        } else {
            echo "<p>Bilangan $angka adalah Nol</p>";
        }
    }
    ?>
</body>
</html>
