<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if (!$nama || !$email || !$password) {
    $errors[] = 'Semua bidang wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
  // PERUBAHAN 1: Logika PHP diubah menjadi max 8
  } elseif (strlen($password) > 8) {
    $errors[] = 'Password maksimal 8 karakter.';
  } else {
    $db = getDB();

    // Cek email sudah ada atau belum
    $cek = $db->prepare("SELECT id FROM users WHERE email=?");
    $cek->execute([$email]);

    if ($cek->fetch()) {
      $errors[] = 'Email sudah terdaftar.';
    } else {
      $hash = password_hash($password, PASSWORD_BCRYPT);

      $db->prepare("INSERT INTO users (nama, email, password) VALUES (?,?,?)")
         ->execute([$nama, $email, $hash]);

      setFlash('success', 'Akun anda telah terdaftar');
      header('Location: login.php');
      exit;
    }
  }
}

$pageTitle = 'Register';
$basePath = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center; min-height: 70vh;">
  <div class="form-card">
    <div class="page-icon">📝</div>
    <h1>Daftar Akun</h1>
    <p class="sub">Buat akun untuk mulai memantau tumbuh kembang si kecil.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
          <div>• <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (function_exists('showFlash')) { showFlash(); } ?>

    <form method="POST">
      <label class="form-label">Nama</label>
      <input class="form-input" type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required />

      <label class="form-label">Email</label>
      <input class="form-input" type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required />

      <label class="form-label">Password</label>
      <input class="form-input" type="password" name="password" placeholder="Maksimal 8 karakter" maxlength="8" required />

      <button class="form-btn" type="submit">Daftar</button>
    </form>

    <div class="form-link">
      Sudah punya akun? <a href="login.php">Masuk di sini</a>
    </div>
    <div class="form-link" style="margin-top:8px;">
      <a href="../index.php">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>