<?php
require_once 'db.php';

try {
    $db = getDB();
    
    // Membaca isi file database.sql
    $sql = file_get_contents(__DIR__ . '/database.sql');
    
    // Mengeksekusi pembuatan tabel
    $db->exec($sql);
    
    echo "<h3 style='color: green;'>✅ Database SQLite dan tabel berhasil dibuat!</h3>";
    echo "<p>Silakan hapus file ini jika sudah tidak digunakan.</p>";
    echo "<a href='../index.php'>Kembali ke Beranda</a>";
    
} catch (Exception $e) {
    echo "<h3 style='color: red;'>❌ Gagal membuat tabel: " . $e->getMessage() . "</h3>";
}