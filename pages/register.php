<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

if (isLoggedIn()) {
    header('Location: tumbuh.php');
    exit;
}

$errors  = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama   = trim($_POST['nama']      ?? '');
    $email  = trim($_POST['email']     ?? '');
    $pass   = $_POST['password']       ?? '';
    $pass2  = $_POST['password2']      ?? '';

    // Validasi
    if (strlen($nama) < 2)                              $errors[] = 'Nama minimal 2 karakter.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))     $errors[] = 'Format email tidak valid.';
    if (strlen($pass) < 6)                              $errors[] = 'Password minimal 6 karakter.';
    if ($pass !== $pass2)                               $errors[] = 'Konfirmasi password tidak cocok.';

    if (empty($errors)) {
        $db = getDB();

        // Cek email sudah ada
        $chk = $db->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
        $chk->execute([$email]);
        if ($chk->fetch()) {
            $errors[] = 'Email sudah terdaftar. Silakan gunakan email lain.';
        } else {
            $hash = password_hash($pass, PASSWORD_BCRYPT);
            $ins  = $db->prepare('INSERT INTO users (nama, email, password) VALUES (?, ?, ?)');
            $ins->execute([$nama, $email, $hash]);

            setFlash('success', "Akun berhasil dibuat! Silakan login, {$nama} 🎉");
            header('Location: login.php');
            exit;
        }
    }
}

$pageTitle = 'Daftar';
$basePath  = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center;">
  <div class="form-card">
    <div class="page-icon">🍼</div>
    <h1>Daftar SiKecil</h1>
    <p class="sub">Buat akun gratis dan mulai pantau tumbuh kembang si kecil hari ini.</p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
          <div>• <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <label class="form-label">Nama Lengkap</label>
      <input class="form-input" type="text" name="nama"
             placeholder="Nama lengkap Anda"
             value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required/>

      <label class="form-label">Email</label>
      <input class="form-input" type="email" name="email"
             placeholder="email@kamu.com"
             value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required/>

      <label class="form-label">Password <small style="color:var(--text-mid)">(min. 6 karakter)</small></label>
      <input class="form-input" type="password" name="password"
             placeholder="••••••••" required/>

      <label class="form-label">Konfirmasi Password</label>
      <input class="form-input" type="password" name="password2"
             placeholder="••••••••" required/>

      <button class="form-btn" type="submit">Buat Akun</button>
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
