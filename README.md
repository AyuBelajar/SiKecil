# SiKecil – Panduan Instalasi & Database

## Struktur Proyek
```
sikecil/
├── config/
│   ├── db.php            ← Konfigurasi koneksi database (EDIT INI)
│   └── database.sql      ← Script buat tabel (jalankan sekali)
├── includes/
│   └── auth.php          ← Helper session & login
├── layout/
│   ├── header.php        ← Navbar (di-include semua halaman)
│   └── footer.php        ← Footer + Tentang (di-include semua halaman)
├── pages/
│   ├── login.php         ← Halaman login
│   ├── register.php      ← Halaman daftar akun
│   ├── logout.php        ← Handler logout
│   ├── tumbuh.php        ← Tumbuh kembang (butuh login)
│   ├── kalkulator.php    ← Kalkulator gizi
│   └── mpasi.php         ← Panduan MPASI
├── assets/
│   ├── css/style.css     ← CSS global
│   └── img/              ← Gambar & logo
└── index.php             ← Halaman utama
```

---

## Langkah Setup (XAMPP / Laragon)

### 1. Letakkan folder proyek
Salin folder `sikecil/` ke dalam:
- **XAMPP**  → `C:/xampp/htdocs/sikecil/`
- **Laragon** → `C:/laragon/www/sikecil/`

### 2. Buat database di phpMyAdmin
1. Buka browser → `http://localhost/phpmyadmin`
2. Klik **"New"** → beri nama database: `sikecil` → klik **Create**
3. Pilih database `sikecil` → klik tab **SQL**
4. Copy-paste isi file `config/database.sql` → klik **Go**

### 3. Sesuaikan konfigurasi database
Buka file `config/db.php`, ubah sesuai pengaturan MySQL Anda:

```php
define('DB_HOST', 'localhost');   // biasanya localhost
define('DB_NAME', 'sikecil');     // nama database
define('DB_USER', 'root');        // username MySQL (default: root)
define('DB_PASS', '');            // password MySQL (XAMPP default: kosong)
```

### 4. Jalankan proyek
Buka browser → `http://localhost/sikecil/`

---

## Alur Penggunaan

```
Beranda (index.php)
  ├── Daftar akun → register.php → (data masuk tabel: users)
  ├── Login       → login.php    → session aktif
  └── Setelah login:
        └── Tumbuh Kembang → tumbuh.php
              ├── Tambah profil bayi   → (tabel: babies)
              └── Catat pengukuran     → (tabel: tumbuh_kembang)
```

---

## Tabel Database

| Tabel             | Fungsi                              |
|-------------------|-------------------------------------|
| `users`           | Data akun orang tua                 |
| `babies`          | Profil bayi per user                |
| `tumbuh_kembang`  | Riwayat catatan BB, TB, LK bayi     |

---

## Keamanan yang Sudah Diterapkan
- ✅ Password di-*hash* dengan `password_hash()` (bcrypt)
- ✅ Semua input user di-*sanitize* dengan `htmlspecialchars()`
- ✅ Query database menggunakan **Prepared Statement** (anti SQL Injection)
- ✅ Session regenerate saat login (anti session fixation)
- ✅ Halaman Tumbuh Kembang hanya bisa diakses setelah login
