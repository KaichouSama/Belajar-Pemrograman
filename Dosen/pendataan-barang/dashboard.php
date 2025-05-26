<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="/pendataan-barang/assets/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="p-4">
    <h2>Dashboard</h2>
    <p>Selamat Datang, <strong><?php echo $_SESSION['username']; ?></strong>!</p>
</div>
</body>
</html>
