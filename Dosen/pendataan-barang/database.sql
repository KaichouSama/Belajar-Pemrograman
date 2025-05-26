-- Membuat database
CREATE DATABASE IF NOT EXISTS pendataan_barang;
USE pendataan_barang;

-- Membuat tabel admin
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Insert admin default (username: admin, password: admin123)
INSERT INTO admin (username, password) VALUES
('admin', MD5('admin123'));

-- Membuat tabel barang
CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_barang VARCHAR(100) NOT NULL,
    jumlah INT NOT NULL,
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);