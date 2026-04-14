<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin('../');
$user = currentUser();
$db   = getDB();

$errors = [];

// ── Update info akun ──────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'update_akun') {
    $nama     = trim($_POST['nama']  ?? '');
    $email    = trim($_POST['email'] ?? '');
    $passLama = $_POST['pass_lama']  ?? '';
    $passBaru = $_POST['pass_baru']  ?? '';

    if (!$nama || !$email) {
        $errors[] = 'Nama dan email tidak boleh kosong.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid.';
    } else {
        // Cek email duplikat (selain user sendiri)
        $chk = $db->prepare('SELECT id FROM users WHERE email = ? AND id != ? LIMIT 1');
        $chk->execute([$email, $user['id']]);
        if ($chk->fetch()) {
            $errors[] = 'Email sudah digunakan akun lain.';
        } else {
            if ($passBaru) {
                // Validasi password lama dulu
                $row = $db->prepare('SELECT password FROM users WHERE id = ? LIMIT 1');
                $row->execute([$user['id']]);
                $row = $row->fetch();
                if (!password_verify($passLama, $row['password'])) {
                    $errors[] = 'Password lama tidak sesuai.';
                } elseif (strlen($passBaru) < 6) {
                    $errors[] = 'Password baru minimal 6 karakter.';
                } else {
                    $hash = password_hash($passBaru, PASSWORD_BCRYPT);
                    $db->prepare('UPDATE users SET nama=?, email=?, password=? WHERE id=?')
                       ->execute([$nama, $email, $hash, $user['id']]);
                    $_SESSION['user_nama']  = $nama;
                    $_SESSION['user_email'] = $email;
                    setFlash('success', 'Akun berhasil diperbarui termasuk password! ✅');
                    header('Location: profil.php');
                    exit;
                }
            } else {
                $db->prepare('UPDATE users SET nama=?, email=? WHERE id=?')
                   ->execute([$nama, $email, $user['id']]);
                $_SESSION['user_nama']  = $nama;
                $_SESSION['user_email'] = $email;
                setFlash('success', 'Info akun berhasil diperbarui! ✅');
                header('Location: profil.php');
                exit;
            }
        }
    }
}

// ── Tambah bayi baru ──────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'tambah_bayi') {
    $namaBayi = trim($_POST['nama_bayi'] ?? '');
    $tglLahir = $_POST['tgl_lahir']      ?? '';
    $jk       = $_POST['jk']             ?? '';

    if (!$namaBayi || !$tglLahir || !in_array($jk, ['L','P'])) {
        $errors[] = 'Semua data bayi wajib diisi dengan benar.';
    } else {
        $db->prepare('INSERT INTO babies (user_id, nama, tanggal_lahir, jenis_kelamin) VALUES (?,?,?,?)')
           ->execute([$user['id'], $namaBayi, $tglLahir, $jk]);
        setFlash('success', "Profil bayi {$namaBayi} berhasil ditambahkan! 🎉");
        header('Location: profil.php');
        exit;
    }
}

// ── Hapus bayi ────────────────────────────────────────────
if (isset($_GET['hapus_bayi']) && is_numeric($_GET['hapus_bayi'])) {
    $db->prepare('DELETE FROM babies WHERE id = ? AND user_id = ?')
       ->execute([(int)$_GET['hapus_bayi'], $user['id']]);
    setFlash('success', 'Profil bayi berhasil dihapus.');
    header('Location: profil.php');
    exit;
}

// ── Ambil daftar bayi ─────────────────────────────────────
$stmtBayi = $db->prepare('SELECT * FROM babies WHERE user_id = ? ORDER BY nama');
$stmtBayi->execute([$user['id']]);
$babies = $stmtBayi->fetchAll();

// ── Ambil data akun terbaru ───────────────────────────────
$stmtUser = $db->prepare('SELECT nama, email FROM users WHERE id = ? LIMIT 1');
$stmtUser->execute([$user['id']]);
$userData = $stmtUser->fetch();

$pageTitle = 'Profil';
$basePath  = '../';
include '../layout/header.php';
?>

<style>
  .profil-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 28px;
    max-width: 1000px;
  }
  .section-box { background:var(--white); border-radius:20px; padding:32px; box-shadow:var(--shadow); }
  .section-box h2 { font-family:'Nunito',sans-serif; font-size:1.3rem; font-weight:900; color:var(--text-dark); margin-bottom:20px; display:flex; align-items:center; gap:10px; }
  .form-label { font-size:.85rem; font-weight:600; color:var(--text-mid); display:block; margin-bottom:5px; }

  .baby-list { display:flex; flex-direction:column; gap:12px; margin-top:4px; }
  .baby-item {
    display:flex; align-items:center; justify-content:space-between;
    background:var(--teal-light); border-radius:12px; padding:12px 16px;
  }
  .baby-item-info { display:flex; align-items:center; gap:12px; }
  .baby-avatar {
    width:42px; height:42px; border-radius:50%;
    background:var(--yellow); display:flex; align-items:center; justify-content:center;
    font-size:1.3rem; flex-shrink:0;
  }
  .baby-name  { font-family:'Nunito',sans-serif; font-weight:800; font-size:.97rem; color:var(--text-dark); }
  .baby-meta  { font-size:.8rem; color:var(--text-mid); }
  .btn-hapus-baby {
    background:none; border:none; color:#e57373; cursor:pointer;
    font-size:.85rem; font-weight:600; padding:6px 12px;
    border-radius:8px; transition:background .2s;
  }
  .btn-hapus-baby:hover { background:#fff0f0; }

  .divider { border:none; border-top:1px solid #eef4f4; margin:20px 0; }

  .pass-toggle { font-size:.82rem; color:var(--teal); font-weight:600; cursor:pointer; margin-bottom:14px; display:inline-block; }
  #pass-fields { display:none; }

  @media(max-width:820px){ .profil-grid{grid-template-columns:1fr;} }
</style>

<div class="page-wrapper">
  <div class="page-title-bar">
    <h1>👤 Profil Saya</h1>
    <p>Kelola info akun dan daftar profil bayi Anda.</p>
  </div>

  <?php showFlash(); ?>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-error" style="max-width:1000px;margin-bottom:20px;">
      <?php foreach ($errors as $e): ?><div>• <?= htmlspecialchars($e) ?></div><?php endforeach; ?>
    </div>
  <?php endif; ?>

  <div class="profil-grid">

    <!-- ── Kolom Kiri: Info Akun ── -->
    <div class="section-box">
      <h2>🔐 Info Akun</h2>
      <form method="POST">
        <input type="hidden" name="action" value="update_akun"/>

        <label class="form-label">Nama Lengkap</label>
        <input class="form-input" type="text" name="nama"
               value="<?= htmlspecialchars($userData['nama']) ?>" required/>

        <label class="form-label">Email</label>
        <input class="form-input" type="email" name="email"
               value="<?= htmlspecialchars($userData['email']) ?>" required/>

        <hr class="divider"/>

        <span class="pass-toggle" onclick="togglePass()">🔑 Ganti password? Klik di sini</span>
        <div id="pass-fields">
          <label class="form-label">Password Lama</label>
          <input class="form-input" type="password" name="pass_lama" placeholder="••••••••"/>

          <label class="form-label">Password Baru <small style="color:var(--text-mid)">(min. 6 karakter)</small></label>
          <input class="form-input" type="password" name="pass_baru" placeholder="••••••••"/>
        </div>

        <button class="form-btn" type="submit">Simpan Perubahan</button>
      </form>
    </div>

    <!-- ── Kolom Kanan: Profil Bayi ── -->
    <div class="section-box">
      <h2>👶 Profil Bayi</h2>

      <!-- Daftar bayi yang sudah ada -->
      <?php if (!empty($babies)): ?>
        <div class="baby-list">
          <?php foreach ($babies as $b):
            $tgl  = new DateTime($b['tanggal_lahir']);
            $now  = new DateTime();
            $diff = $now->diff($tgl);
            $usia = $diff->y * 12 + $diff->m;
          ?>
          <div class="baby-item">
            <div class="baby-item-info">
              <div class="baby-avatar"><?= $b['jenis_kelamin'] === 'L' ? '👦' : '👧' ?></div>
              <div>
                <div class="baby-name"><?= htmlspecialchars($b['nama']) ?></div>
                <div class="baby-meta">
                  <?= $b['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?> &nbsp;·&nbsp;
                  <?= date('d/m/Y', strtotime($b['tanggal_lahir'])) ?> &nbsp;·&nbsp;
                  <?= $usia ?> bulan
                </div>
              </div>
            </div>
            <button class="btn-hapus-baby"
              onclick="if(confirm('Hapus profil <?= htmlspecialchars($b['nama']) ?>? Semua riwayat pengukurannya juga akan terhapus.')) window.location='profil.php?hapus_bayi=<?= $b['id'] ?>'">
              🗑️
            </button>
          </div>
          <?php endforeach; ?>
        </div>
        <hr class="divider"/>
      <?php endif; ?>

      <!-- Form tambah bayi baru -->
      <p style="font-size:.88rem;font-weight:700;color:var(--text-mid);margin-bottom:14px;">
        ➕ Tambah Bayi Baru
      </p>
      <form method="POST">
        <input type="hidden" name="action" value="tambah_bayi"/>

        <label class="form-label">Nama Bayi</label>
        <input class="form-input" type="text" name="nama_bayi" placeholder="Nama si kecil" required/>

        <label class="form-label">Tanggal Lahir</label>
        <input class="form-input" type="date" name="tgl_lahir" max="<?= date('Y-m-d') ?>" required/>

        <label class="form-label">Jenis Kelamin</label>
        <select class="form-input" name="jk" required style="cursor:pointer;">
          <option value="">-- Pilih --</option>
          <option value="L">Laki-laki</option>
          <option value="P">Perempuan</option>
        </select>

        <button class="form-btn" type="submit">Tambah Bayi</button>
      </form>
    </div>

  </div>

  <div style="margin-top:24px;display:flex;gap:16px;flex-wrap:wrap;">
    <a href="tumbuh.php" style="color:var(--teal);font-size:.9rem;font-weight:600;text-decoration:none;">
      → Ke Tumbuh Kembang
    </a>
    <a href="../index.php" style="color:var(--text-mid);font-size:.9rem;font-weight:600;text-decoration:none;">
      ← Kembali ke Beranda
    </a>
  </div>
</div>

<script>
function togglePass() {
  const el = document.getElementById('pass-fields');
  el.style.display = el.style.display === 'none' ? 'block' : 'none';
}
</script>

<?php include '../layout/footer.php'; ?>
