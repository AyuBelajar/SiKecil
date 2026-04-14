<?php
// ══════════════════════════════════════════════════════════
//  SiKecil – Konfigurasi Database (PDO)
//  File ini di-include oleh semua halaman yang butuh DB
// ══════════════════════════════════════════════════════════

// ── Sesuaikan pengaturan di bawah ini ─────────────────────
define('DB_HOST',    'localhost');
define('DB_NAME',    'sikecil');
define('DB_USER',    'root');       // ganti sesuai user MySQL Anda
define('DB_PASS',    '');           // ganti sesuai password MySQL Anda
define('DB_CHARSET', 'utf8mb4');

// ── Fungsi koneksi (singleton) ────────────────────────────
function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST, DB_NAME, DB_CHARSET
        );

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Tampilkan pesan ramah, jangan expose detail DB ke user
            die('<div style="font-family:sans-serif;padding:40px;color:#c0392b;">
                    <h2>⚠️ Koneksi Database Gagal</h2>
                    <p>Pastikan MySQL berjalan dan pengaturan di <code>config/db.php</code> sudah benar.</p>
                    <small>' . htmlspecialchars($e->getMessage()) . '</small>
                 </div>');
        }
    }

    return $pdo;
}
