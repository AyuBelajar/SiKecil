<?php
// Bootstrap session & auth (aman di-include berkali-kali)
require_once ($basePath ?? '') . 'includes/auth.php';
$_loggedIn = isLoggedIn();
$_curUser = $_loggedIn ? currentUser() : null;
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle ?? 'Beranda') ?> – SiKecil</title>
  <link rel="stylesheet" href="<?= $basePath ?? '' ?>assets/css/style.css" />
</head>

<body>

  <!-- ══ NAVBAR ══ -->
  <nav>
    <a href="<?= $basePath ?? '' ?>index.php">
      <img src="<?= $basePath ?? '' ?>assets/img/Logo_Web.png" alt="SiKecil" class="logo-img" />
    </a>
    <div class="nav-accent">
      <?php if ($_loggedIn): ?>
        <a href="<?= $basePath ?? '' ?>pages/profil.php" class="nav-btn nav-btn-profil">
          👤 <?= htmlspecialchars($_curUser['nama']) ?>
        </a>
        <a href="<?= $basePath ?? '' ?>pages/tumbuh.php" class="nav-btn">Tumbuh Kembang</a>
        <a href="<?= $basePath ?? '' ?>pages/kalkulator.php" class="nav-btn">Kalkulator Gizi</a>
        <a href="<?= $basePath ?? '' ?>pages/mpasi.php" class="nav-btn">MPASI</a>
        <a href="<?= $basePath ?? '' ?>pages/logout.php" class="nav-btn nav-btn-logout">Keluar</a>
      <?php else: ?>
        <a href="<?= $basePath ?? '' ?>pages/login.php" class="nav-btn login">Login</a>
        <a href="<?= $basePath ?? '' ?>pages/kalkulator.php" class="nav-btn">Kalkulator Gizi</a>
        <a href="<?= $basePath ?? '' ?>pages/tumbuh.php" class="nav-btn">Tumbuh Kembang</a>
        <a href="<?= $basePath ?? '' ?>pages/mpasi.php" class="nav-btn">MPASI</a>
      <?php endif; ?>
    </div>
  </nav>