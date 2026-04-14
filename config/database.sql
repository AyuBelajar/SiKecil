-- ══════════════════════════════════════════════════════════
--  SiKecil – Database Schema
--  Jalankan file ini di phpMyAdmin atau MySQL CLI:
--    mysql -u root -p < config/database.sql
-- ══════════════════════════════════════════════════════════

CREATE DATABASE IF NOT EXISTS sikecil
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE sikecil;

-- ── Tabel pengguna (orang tua) ──────────────────────────
CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  nama          VARCHAR(100)    NOT NULL,
  email         VARCHAR(150)    NOT NULL UNIQUE,
  password      VARCHAR(255)    NOT NULL,          -- bcrypt hash
  created_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,
  updated_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Tabel profil bayi ───────────────────────────────────
CREATE TABLE IF NOT EXISTS babies (
  id            INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  user_id       INT UNSIGNED    NOT NULL,
  nama          VARCHAR(100)    NOT NULL,
  tanggal_lahir DATE            NOT NULL,
  jenis_kelamin ENUM('L','P')   NOT NULL,
  created_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Tabel catatan tumbuh kembang ────────────────────────
CREATE TABLE IF NOT EXISTS tumbuh_kembang (
  id            INT UNSIGNED    AUTO_INCREMENT PRIMARY KEY,
  user_id       INT UNSIGNED    NOT NULL,
  baby_id       INT UNSIGNED    NOT NULL,
  usia_bulan    TINYINT UNSIGNED NOT NULL,
  berat_badan   DECIMAL(5,2)    NOT NULL,           -- kg
  tinggi_badan  DECIMAL(5,2)    NOT NULL,           -- cm
  lingkar_kepala DECIMAL(5,2)   NOT NULL,           -- cm
  status_bb     VARCHAR(30)     DEFAULT NULL,
  status_tb     VARCHAR(30)     DEFAULT NULL,
  status_lk     VARCHAR(30)     DEFAULT NULL,
  catatan       TEXT            DEFAULT NULL,
  tanggal_ukur  DATE            NOT NULL,
  created_at    TIMESTAMP       DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id)  REFERENCES users(id)   ON DELETE CASCADE,
  FOREIGN KEY (baby_id)  REFERENCES babies(id)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── Indeks untuk performa query ─────────────────────────
CREATE INDEX idx_tumbuh_baby    ON tumbuh_kembang (baby_id);
CREATE INDEX idx_tumbuh_user    ON tumbuh_kembang (user_id);
CREATE INDEX idx_babies_user    ON babies          (user_id);
