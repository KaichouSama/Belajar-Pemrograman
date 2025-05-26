<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
include '../config/koneksi.php';

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM barang WHERE id=$id");

echo "<script>alert('Data berhasil dihapus!');window.location='index.php';</script>";
?>
