-- create_peminjamans_table

CREATE TABLE IF NOT EXISTS `peminjaman` (
    id _user       INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    id_alat      INT NOT NULL,
    jumlah      INT NOT NULL DEFAULT 1,
    tanggal_pinjam DATE NOT NULL,
    tanggal_kembali DATE DEFAULT NULL,
    status ENUM('Pending', 'Disetujui', 'Ditolak', 'Dipinjam', 'Dikembalikan') DEFAULT 'pending',
    denda INT DEFAULT 0,
    created_at DATETIME NULL,
    updated_at DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;