<?php
// ── Bootstrap ──────────────────────────────────────────────
require_once '../config/db.php';
require_once '../includes/auth.php';

if (isLoggedIn()) {
    header('Location: tumbuh.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $pass  = $_POST['password']   ?? '';

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Masukkan email yang valid.';
    }
    if (!$pass) {
        $errors[] = 'Password tidak boleh kosong.';
    }

    if (empty($errors)) {
        $db   = getDB();
        $stmt = $db->prepare('SELECT id, nama, email, password FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($pass, $user['password'])) {
            loginUser($user);
            $redirect = $_GET['next'] ?? 'tumbuh.php';
            header('Location: ' . htmlspecialchars($redirect));
            exit;
        } else {
            $errors[] = 'Email atau password salah.';
        }
    }
}

$pageTitle = 'Login';
$basePath  = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center;">
  <div class="form-card">
    <div class="page-icon">👤</div>
    <h1>Masuk ke SiKecil</h1>
    <p class="sub">Masuk untuk memantau data tumbuh kembang si kecil.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
          <div>• <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if (isset($_GET['redirect'])): ?>
      <div class="alert alert-error">Silakan login terlebih dahulu untuk mengakses halaman tersebut.</div>
    <?php endif; ?>

    <?php showFlash(); ?>

    <form method="POST">
      <label class="form-label">Email</label>
      <input class="form-input" type="email" name="email"
             placeholder="email@kamu.com"
             value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required/>

      <label class="form-label">Password</label>
      <input class="form-input" type="password" name="password"
             placeholder="••••••••" required/>

      <button class="form-btn" type="submit">Masuk</button>
    </form>

    <div class="form-link">
      Belum punya akun? <a href="register.php">Daftar sekarang</a>
    </div>
    <div class="form-link" style="margin-top:8px;">
      <a href="../index.php">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
