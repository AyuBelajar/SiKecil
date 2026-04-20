<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = trim($_POST['nama'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  if (!$nama || !$email || !$password) {
    $errors[] = 'Semua field wajib diisi.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Format email tidak valid.';
  } elseif (strlen($password) < 6) {
    $errors[] = 'Password minimal 6 karakter.';
  } else {
    $db = getDB();

    // cek email sudah ada atau belum
    $cek = $db->prepare("SELECT id FROM users WHERE email=?");
    $cek->execute([$email]);

    if ($cek->fetch()) {
      $errors[] = 'Email sudah terdaftar.';
    } else {
      $hash = password_hash($password, PASSWORD_BCRYPT);

      $db->prepare("INSERT INTO users (nama, email, password) VALUES (?,?,?)")
         ->execute([$nama, $email, $hash]);

      setFlash('success', 'Akun berhasil dibuat! Silakan login.');
      header('Location: login.php');
      exit;
    }
  }
}

$pageTitle = 'Register';
$basePath = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center;">
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

    <?php showFlash(); ?>

    <form method="POST">
      <label class="form-label">Nama</label>
      <input class="form-input" type="text" name="nama" required />

      <label class="form-label">Email</label>
      <input class="form-input" type="email" name="email" required />

      <label class="form-label">Password</label>
      <input class="form-input" type="password" name="password" required />

      <button class="form-btn" type="submit">Daftar</button>
    </form>

    <div class="form-link">
      Sudah punya akun? <a href="login.php">Login</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>