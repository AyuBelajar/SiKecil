<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin('../');
$user = currentUser();
$db = getDB();

$errors = [];

// ── Tambah / Update biodata bayi (Semua masuk ke tabel babies) ──────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'tambah_bayi') {
    $namaBayi = trim($_POST['nama_bayi'] ?? '');
    $tglLahir = $_POST['tgl_lahir'] ?? '';
    $jk = $_POST['jk'] ?? '';
    $bb = $_POST['berat_badan'] ?? 0;
    $tb = $_POST['tinggi_badan'] ?? 0;
    $lk = $_POST['lingkar_kepala'] ?? 0;
    $ll = $_POST['lingkar_lengan'] ?? 0;
    $alergi = trim($_POST['alergi'] ?? '-');
    $vaksin = trim($_POST['status_vaksin'] ?? '-');

    if (!$namaBayi || !$tglLahir || !in_array($jk, ['L', 'P'])) {
        $errors[] = 'Nama, Tanggal Lahir, dan Jenis Kelamin wajib diisi.';
    } else {
        $sql = "INSERT INTO babies (user_id, nama, tanggal_lahir, jenis_kelamin, berat_badan, tinggi_badan, lingkar_kepala, lingkar_lengan, alergi, status_vaksin) 
                VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$user['id'], $namaBayi, $tglLahir, $jk, $bb, $tb, $lk, $ll, $alergi, $vaksin]);
        
        setFlash('success', "Biodata {$namaBayi} berhasil disimpan! 🎉");
        header('Location: profil.php');
        exit;
    }
}

// ── Hapus bayi ────────────────────────────────────────────
if (isset($_GET['hapus_bayi']) && is_numeric($_GET['hapus_bayi'])) {
    $db->prepare('DELETE FROM babies WHERE id = ? AND user_id = ?')
       ->execute([(int) $_GET['hapus_bayi'], $user['id']]);
    setFlash('success', 'Profil bayi berhasil dihapus.');
    header('Location: profil.php');
    exit;
}

// ── Ambil daftar bayi (Sekarang semua kolom ada di satu tabel babies) ─────
$stmtBayi = $db->prepare('SELECT * FROM babies WHERE user_id = ? ORDER BY created_at DESC');
$stmtBayi->execute([$user['id']]);
$babies = $stmtBayi->fetchAll();

$pageTitle = 'Profil Biodata Anak';
$basePath = '../';
include '../layout/header.php';
?>

<style>
    /* (CSS kamu di sini tetap sama) */
    .profil-container { max-width: 900px; margin: 0 auto; }
    .section-box { background: var(--white); border-radius: 20px; padding: 30px; box-shadow: var(--shadow); margin-bottom: 30px; }
    /* ... (lanjutkan sisa CSS aslimu) ... */
</style>

<div class="page-wrapper">
  <div class="profil-container">
    <div class="page-title-bar">
      <h1>👶 Profil & Biodata Anak</h1>
      <p>Lengkapi data tumbuh kembang dan riwayat kesehatan si kecil.</p>
    </div>

    <?php showFlash(); ?>

    <?php if (!empty($babies)): ?>
      <?php foreach ($babies as $b): 
          $tgl = new DateTime($b['tanggal_lahir']);
          $diff = (new DateTime())->diff($tgl);
          $usia = ($diff->y * 12) + $diff->m;
      ?>
      <div class="biodata-card">
        <div class="bio-header">
            <div class="bio-name">
                <?= $b['jenis_kelamin'] === 'L' ? '👦' : '👧' ?> <?= htmlspecialchars($b['nama']) ?>
            </div>
            <button class="btn-hapus-baby" onclick="if(confirm('Hapus biodata ini?')) window.location='profil.php?hapus_bayi=<?= $b['id'] ?>'">🗑️ Hapus</button>
        </div>
        
        <div class="bio-grid">
            <div class="bio-item"><small>Usia</small><div><?= $usia ?> Bulan</div></div>
            <div class="bio-item"><small>Lahir</small><div><?= date('d M Y', strtotime($b['tanggal_lahir'])) ?></div></div>
            <div class="bio-item"><small>Kelamin</small><div><?= $b['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></div></div>
            <div class="bio-item"><small>Berat</small><div><?= $b['berat_badan'] ?> kg</div></div>
            <div class="bio-item"><small>Tinggi</small><div><?= $b['tinggi_badan'] ?> cm</div></div>
            <div class="bio-item"><small>Lingkar Kepala</small><div><?= $b['lingkar_kepala'] ?> cm</div></div>
            <div class="bio-item"><small>Lingkar Lengan</small><div><?= $b['lingkar_lengan'] ?> cm</div></div>
        </div>

        <div class="bio-text-area">
            <p><strong>⚠️ Alergi:</strong> <?= nl2br(htmlspecialchars($b['alergi'])) ?></p>
            <p style="margin-top:8px;"><strong>💉 Status Vaksin:</strong> <?= nl2br(htmlspecialchars($b['status_vaksin'])) ?></p>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif; ?>

    <div class="section-box">
      <h2>📝 Input Biodata Baru</h2>
      <form method="POST">
        <input type="hidden" name="action" value="tambah_bayi" />
        
        <div class="form-grid">
            <div class="form-group full-width">
                <label class="form-label">Nama Lengkap Bayi</label>
                <input class="form-input" type="text" name="nama_bayi" placeholder="Nama si kecil" required />
            </div>
            <div class="form-group">
                <label class="form-label">Berat Badan (kg)</label>
                <input class="form-input" type="number" step="0.01" name="berat_badan" placeholder="Contoh: 3.5" />
            </div>
            </div>

        <button class="form-btn" type="submit" style="margin-top:10px;">Simpan Biodata Anak</button>
      </form>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>