<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim(htmlspecialchars($_POST["name"]));
    $email = trim(htmlspecialchars($_POST["email"]));
    $subject = trim(htmlspecialchars($_POST["subject"]));
    $message = trim(htmlspecialchars($_POST["message"]));
    
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "<script>alert('Harap isi semua kolom!'); window.history.back();</script>";
        exit();
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.history.back();</script>";
        exit();
    }
    
    $to = "your-email@example.com"; // Ganti dengan email tujuan
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n" .
               "Content-Type: text/plain; charset=UTF-8\r\n" .
               "X-Mailer: PHP/" . phpversion();
    $body = "Nama: $name\nEmail: $email\nSubjek: $subject\nPesan:\n$message";
    
    if (@mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Pesan berhasil dikirim!'); window.location.href='contact.html';</script>";
    } else {
        echo "<script>alert('Gagal mengirim pesan! Silakan coba lagi nanti.'); window.history.back();</script>";
    }
} else {
    header("Location: contact.html");
    exit();
}
?>
