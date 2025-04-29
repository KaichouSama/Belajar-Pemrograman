<?php
echo "<h2>Daftar Bilangan Genap dan Ganjil Kurang dari 100</h2>";

echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Bilangan Genap</th><th>Bilangan Ganjil</th></tr>";

echo "<tr><td>";
// Loop untuk bilangan genap
for ($i = 2; $i < 100; $i += 2) {
    echo "$i ";
}
echo "</td><td>";

// Loop untuk bilangan ganjil
for ($i = 1; $i < 100; $i += 1) {
    if ($i % 2 != 0) {
        echo "$i ";
    }
}
echo "</td></tr>";

echo "</table>";
?>
