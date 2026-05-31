-- Tabel pengguna (orang tua)
CREATE TABLE IF NOT EXISTS users (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  nama TEXT NOT NULL,
  email TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabel profil bayi
CREATE TABLE IF NOT EXISTS babies (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  nama TEXT NOT NULL,
  tanggal_lahir DATE NOT NULL,
  jenis_kelamin TEXT NOT NULL CHECK(jenis_kelamin IN ('L', 'P')),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel catatan tumbuh kembang
CREATE TABLE IF NOT EXISTS tumbuh_kembang (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  user_id INTEGER NOT NULL,
  baby_id INTEGER NOT NULL,
  usia_bulan INTEGER NOT NULL,
  berat_badan REAL NOT NULL,
  tinggi_badan REAL NOT NULL,
  lingkar_kepala REAL NOT NULL,
  status_bb TEXT DEFAULT NULL,
  status_tb TEXT DEFAULT NULL,
  status_lk TEXT DEFAULT NULL,
  catatan TEXT DEFAULT NULL,
  tanggal_ukur DATE NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (baby_id) REFERENCES babies(id) ON DELETE CASCADE
);