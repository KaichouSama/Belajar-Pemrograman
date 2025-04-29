<?php
// Array berisi nama-nama mahasiswa
$mahasiswa = ["Ahmad", "Budi", "Alya", "Cindy", "Dewi", "Andi", "Eko", "Fajar", "Aisyah"];

// Menampilkan semua nama mahasiswa
echo "<h2>Daftar Nama Mahasiswa:</h2>";
echo "<ul>";
foreach ($mahasiswa as $nama) {
    echo "<li>$nama</li>";
}
echo "</ul>";

// Mencari nama mahasiswa yang dimulai dengan huruf tertentu (misal "A")
$huruf_awal = "A";
echo "<h2>Nama Mahasiswa yang Dimulai dengan Huruf '$huruf_awal':</h2>";
echo "<ul>";

$ada = false;
foreach ($mahasiswa as $nama) {
    if (stripos($nama, $huruf_awal) === 0) {  // stripos() mengecek posisi awal string
        echo "<li>$nama</li>";
        $ada = true;
    }
}

if (!$ada) {
    echo "<li>Tidak ada mahasiswa dengan huruf '$huruf_awal'</li>";
}

echo "</ul>";
?>
