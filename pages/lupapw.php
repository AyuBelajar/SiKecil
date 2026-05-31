<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Masukkan email yang valid.';
    } else {
        $db = getDB();
        $stmt = $db->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Jika email ada, arahkan ke halaman ganti password bawa parameter email
            header('Location: ganti_password.php?email=' . urlencode($email));
            exit;
        } else {
            $errors[] = 'Email tidak ditemukan di sistem kami.';
        }
    }
}

$pageTitle = 'Lupa Password';
$basePath = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center; min-height: 70vh;">
  <div class="form-card">
    <div class="page-icon">🔑</div>
    <h1>Lupa Password</h1>
    <p class="sub">Masukkan email akun Anda untuk proses verifikasi.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
          <div>• <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <label class="form-label">Email Terdaftar</label>
      <input class="form-input" type="email" name="email" placeholder="email@kamu.com" required />

      <button class="form-btn" type="submit">Lanjut Ganti Password</button>
    </form>

    <div class="form-link" style="margin-top:15px;">
      <a href="login.php">← Kembali ke Login</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>