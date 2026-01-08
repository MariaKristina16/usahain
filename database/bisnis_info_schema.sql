-- Database Schema Update untuk Bisnis Info

-- Memastikan tabel user memiliki semua kolom yang diperlukan
-- Jalankan query ini di phpMyAdmin jika belum ada kolomnya

-- Tambahkan kolom updated_at jika belum ada
ALTER TABLE `user` ADD COLUMN `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- Pastikan kolom nama_usaha dan jenis_usaha ada dengan tipe yang tepat
ALTER TABLE `user` MODIFY COLUMN `nama_usaha` VARCHAR(100) NULL DEFAULT NULL;
ALTER TABLE `user` MODIFY COLUMN `jenis_usaha` VARCHAR(100) NULL DEFAULT NULL;

-- Verifikasi struktur final
-- DESCRIBE user;

-- Contoh data yang valid setelah perubahan
INSERT INTO `user` (username, email, password, nama_usaha, jenis_usaha) VALUES
('test_user', 'test@example.com', 'hashed_password', 'Warung Makan', 'Kuliner');

-- Query untuk testing:
-- SELECT id_user, nama_usaha, jenis_usaha, updated_at FROM user;
