<?php
// ══════════════════════════════════════════════════════════
//  SiKecil – Konfigurasi Database (SQLite via PDO)
// ══════════════════════════════════════════════════════════

function getDB(): PDO {
    static $pdo = null;

    if ($pdo === null) {
        // Lokasi file database SQLite (akan otomatis dibuat jika belum ada)
        $dbPath = __DIR__ . '/sikecil.sqlite';

        try {
            $pdo = new PDO('sqlite:' . $dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Wajib: Menyalakan dukungan Foreign Key di SQLite untuk fitur CASCADE
            $pdo->exec('PRAGMA foreign_keys = ON;');
        } catch (PDOException $e) {
            die('<div style="font-family:sans-serif;padding:40px;color:#c0392b;">
                    <h2>⚠️ Koneksi Database Gagal</h2>
                    <p>' . htmlspecialchars($e->getMessage()) . '</p>
                 </div>');
        }
    }
    return $pdo;
}