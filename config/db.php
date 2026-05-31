<?php
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dbPath = __DIR__ . '/sikecil.sqlite';
        $isNew = !file_exists($dbPath); // Cek apakah file database baru dibuat

        try {
            $pdo = new PDO('sqlite:' . $dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->exec('PRAGMA foreign_keys = ON;');

            // ── Otomatis buat tabel jika belum ada ──
            if ($isNew) {
                $sql = "CREATE TABLE babies (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER NOT NULL,
                    nama TEXT NOT NULL,
                    tanggal_lahir DATE NOT NULL,
                    jenis_kelamin TEXT NOT NULL CHECK(jenis_kelamin IN ('L', 'P')),
                    berat_badan REAL DEFAULT 0,
                    tinggi_badan REAL DEFAULT 0,
                    lingkar_kepala REAL DEFAULT 0,
                    lingkar_lengan REAL DEFAULT 0,
                    alergi TEXT DEFAULT '-',
                    status_vaksin TEXT DEFAULT '-',
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
                );";
                $pdo->exec($sql);
            }
        } catch (PDOException $e) {
            die('Koneksi Database Gagal: ' . $e->getMessage());
        }
    }
    return $pdo;
}