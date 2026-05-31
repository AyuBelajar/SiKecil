<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

$errors = [];
$email = $_GET['email'] ?? '';

// Jika diakses tanpa email, kembalikan ke halaman lupa password
if (!$email && $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: lupa_password.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $sandiLama = $_POST['sandi_lama'] ?? '';
    $sandiBaru = $_POST['sandi_baru'] ?? '';
    $konfirmasi = $_POST['konfirmasi'] ?? '';

    if (!$sandiLama || !$sandiBaru || !$konfirmasi) {
        $errors[] = 'Semua bidang sandi wajib diisi.';
    } elseif (strlen($sandiBaru) < 8) {
        $errors[] = 'Password baru minimal 8 karakter.';
    } elseif ($sandiBaru !== $konfirmasi) {
        $errors[] = 'Konfirmasi password baru tidak cocok.';
    } else {
        $db = getDB();
        $stmt = $db->prepare('SELECT id, password FROM users WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        // Verifikasi sandi lama menggunakan password_verify bawaan PHP
        if ($user && password_verify($sandiLama, $user['password'])) {
            // Hash sandi baru dan update ke database
            $newHash = password_hash($sandiBaru, PASSWORD_BCRYPT);
            $update = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
            $update->execute([$newHash, $user['id']]);

            setFlash('success', 'Password berhasil diperbarui! Silakan login dengan password baru.');
            header('Location: login.php');
            exit;
        } else {
            $errors[] = 'Sandi lama yang Anda masukkan salah.';
        }
    }
}

$pageTitle = 'Ganti Password';
$basePath = '../';
include '../layout/header.php';
?>

<div class="page-wrapper" style="display:flex;align-items:center;justify-content:center; min-height: 70vh;">
  <div class="form-card">
    <div class="page-icon">🔄</div>
    <h1>Ganti Password</h1>
    <p class="sub">Ubah kata sandi untuk email <strong><?= htmlspecialchars($email) ?></strong></p>

    <?php if (!empty($errors)): ?>
      <div class="alert alert-error">
        <?php foreach ($errors as $e): ?>
          <div>• <?= htmlspecialchars($e) ?></div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form method="POST">
      <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>" />

      <label class="form-label">Sandi Lama</label>
      <input class="form-input" type="password" name="sandi_lama" placeholder="Masukkan sandi saat ini" required />

      <label class="form-label">Sandi Baru</label>
      <input class="form-input" type="password" name="sandi_baru" placeholder="Minimal 8 karakter" required />

      <label class="form-label">Konfirmasi Sandi Baru</label>
      <input class="form-input" type="password" name="konfirmasi" placeholder="Ketik ulang sandi baru" required />

      <button class="form-btn" type="submit">Simpan Password Baru</button>
    </form>

    <div class="form-link" style="margin-top:15px;">
      <a href="login.php">Batal & Kembali ke Login</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>