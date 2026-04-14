<?php
require_once '../config/db.php';
require_once '../includes/auth.php';

requireLogin('../');
$user = currentUser();
$db   = getDB();

$errors  = [];
$success = '';

// ── Ambil daftar bayi milik user ──────────────────────────
$stmtBayi = $db->prepare('SELECT id, nama, tanggal_lahir, jenis_kelamin FROM babies WHERE user_id = ? ORDER BY nama');
$stmtBayi->execute([$user['id']]);
$babies = $stmtBayi->fetchAll();

// ── Simpan catatan tumbuh kembang ─────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'simpan_ukur') {
    $babyId  = (int)($_POST['baby_id']  ?? 0);
    $usia    = (int)($_POST['usia']     ?? 0);
    $bb      = (float)($_POST['bb']     ?? 0);
    $tb      = (float)($_POST['tb']     ?? 0);
    $lk      = (float)($_POST['lk']     ?? 0);
    $catatan = trim($_POST['catatan']   ?? '');
    $tglUkur = $_POST['tgl_ukur']       ?? date('Y-m-d');

    // Pastikan bayi milik user ini
    $chkBaby = $db->prepare('SELECT id FROM babies WHERE id = ? AND user_id = ? LIMIT 1');
    $chkBaby->execute([$babyId, $user['id']]);

    if (!$chkBaby->fetch()) {
        $errors[] = 'Data bayi tidak valid.';
    } elseif (!$usia || !$bb || !$tb || !$lk) {
        $errors[] = 'Isi semua kolom pengukuran.';
    } else {
        // Referensi WHO sederhana
        $whoRef = [6=>['bb'=>7.9,'tb'=>67.6,'lk'=>43.3],9=>['bb'=>9.2,'tb'=>72.3,'lk'=>44.5],
                   12=>['bb'=>10.2,'tb'=>76.1,'lk'=>45.7],18=>['bb'=>11.5,'tb'=>82.3,'lk'=>46.9],
                   24=>['bb'=>12.7,'tb'=>87.8,'lk'=>47.6],36=>['bb'=>14.3,'tb'=>95.1,'lk'=>49.0]];
        $keys = array_keys($whoRef);
        $closest = $keys[0];
        foreach ($keys as $age) {
            if (abs($age - $usia) < abs($closest - $usia)) $closest = $age;
        }
        $ref = $whoRef[$closest];
        $statusBb = ($bb >= $ref['bb']*0.85 && $bb <= $ref['bb']*1.15) ? 'Normal' : ($bb < $ref['bb']*0.85 ? 'Kurang' : 'Lebih');
        $statusTb = ($tb >= $ref['tb']*0.95 && $tb <= $ref['tb']*1.05) ? 'Normal' : ($tb < $ref['tb']*0.95 ? 'Pendek' : 'Tinggi');
        $statusLk = ($lk >= $ref['lk']*0.95 && $lk <= $ref['lk']*1.05) ? 'Normal' : 'Perlu Evaluasi';

        $ins = $db->prepare('INSERT INTO tumbuh_kembang
            (user_id, baby_id, usia_bulan, berat_badan, tinggi_badan, lingkar_kepala,
             status_bb, status_tb, status_lk, catatan, tanggal_ukur)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)');
        $ins->execute([$user['id'], $babyId, $usia, $bb, $tb, $lk, $statusBb, $statusTb, $statusLk, $catatan, $tglUkur]);

        setFlash('success', 'Data pengukuran berhasil disimpan! ✅');
        header('Location: tumbuh.php?baby=' . $babyId);
        exit;
    }
}

// ── Hapus catatan ─────────────────────────────────────────
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $del = $db->prepare('DELETE FROM tumbuh_kembang WHERE id = ? AND user_id = ?');
    $del->execute([(int)$_GET['hapus'], $user['id']]);
    setFlash('success', 'Catatan berhasil dihapus.');
    header('Location: tumbuh.php' . (isset($_GET['baby']) ? '?baby='.(int)$_GET['baby'] : ''));
    exit;
}

// ── Ambil riwayat pengukuran (jika bayi dipilih) ──────────
$selectedBaby   = null;
$riwayat        = [];
$activeBabyId   = (int)($_GET['baby'] ?? 0);

if ($activeBabyId) {
    $stmtSel = $db->prepare('SELECT * FROM babies WHERE id = ? AND user_id = ? LIMIT 1');
    $stmtSel->execute([$activeBabyId, $user['id']]);
    $selectedBaby = $stmtSel->fetch();

    if ($selectedBaby) {
        $stmtRiw = $db->prepare('SELECT * FROM tumbuh_kembang WHERE baby_id = ? ORDER BY tanggal_ukur DESC, id DESC');
        $stmtRiw->execute([$activeBabyId]);
        $riwayat = $stmtRiw->fetchAll();
    }
}

// ── Milestones ────────────────────────────────────────────
$milestones = [
    ['usia'=>'0–3 bln','icon'=>'👁️','judul'=>'Perkembangan Awal','deskripsi'=>'Fokus pada wajah, tersenyum sosial, menggerakkan kepala ke arah suara.'],
    ['usia'=>'4–6 bln','icon'=>'🤲','judul'=>'Motorik Tangan','deskripsi'=>'Meraih objek, mulai duduk dengan bantuan, mengeluarkan suara konsonan.'],
    ['usia'=>'7–9 bln','icon'=>'🧸','judul'=>'Eksplorasi Aktif','deskripsi'=>'Duduk mandiri, merangkak, mengenal wajah familiar, mulai MPASI.'],
    ['usia'=>'10–12 bln','icon'=>'🚶','judul'=>'Menuju Berdiri','deskripsi'=>'Berdiri pegangan, bertepuk tangan, mengatakan "mama" atau "papa".'],
    ['usia'=>'13–18 bln','icon'=>'🗣️','judul'=>'Bicara & Berjalan','deskripsi'=>'Berjalan mandiri, kosakata 5–20 kata, menunjuk objek yang diinginkan.'],
    ['usia'=>'19–24 bln','icon'=>'🎨','judul'=>'Kreativitas Tumbuh','deskripsi'=>'Berlari, menaiki tangga, kalimat 2 kata, bermain pura-pura.'],
];

$pageTitle = 'Tumbuh Kembang';
$basePath  = '../';
include '../layout/header.php';
?>

<style>
  .tabs { display:flex; gap:10px; margin-bottom:28px; flex-wrap:wrap; }
  .tab-btn {
    padding:9px 22px; border-radius:50px; border:2px solid var(--teal-light);
    background:var(--white); color:var(--text-mid); font-family:'Poppins',sans-serif;
    font-size:.88rem; font-weight:600; cursor:pointer; text-decoration:none;
    transition:all .2s;
  }
  .tab-btn:hover,.tab-btn.active { background:var(--teal); border-color:var(--teal); color:var(--white); }

  .section-box { background:var(--white); border-radius:20px; padding:32px; box-shadow:var(--shadow); margin-bottom:28px; }
  .section-box h2 { font-family:'Nunito',sans-serif; font-size:1.3rem; font-weight:900; color:var(--text-dark); margin-bottom:20px; }

  .tw-form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
  .form-label  { font-size:.85rem; font-weight:600; color:var(--text-mid); display:block; margin-bottom:5px; }

  /* Riwayat tabel */
  .riwayat-table { width:100%; border-collapse:collapse; font-size:.88rem; }
  .riwayat-table th { background:var(--teal-light); color:var(--teal-dark); padding:10px 14px; text-align:left; font-family:'Nunito',sans-serif; font-weight:800; }
  .riwayat-table td { padding:10px 14px; border-bottom:1px solid #eef4f4; vertical-align:middle; }
  .riwayat-table tr:last-child td { border-bottom:none; }
  .riwayat-table tr:hover td { background:#f7fcfc; }

  .status-badge {
    display:inline-block; padding:3px 10px; border-radius:50px; font-size:.75rem; font-weight:700;
  }
  .status-normal  { background:#e6f9f5; color:#1a7a5e; }
  .status-kurang,
  .status-pendek,
  .status-lebih,
  .status-perlu   { background:#fff0f0; color:#c0392b; }
  .status-tinggi  { background:#e8f4fd; color:#1a5c8a; }

  .btn-hapus { background:none; border:none; color:#e57373; cursor:pointer; font-size:.85rem; font-weight:600; padding:4px 8px; border-radius:6px; transition:background .2s; }
  .btn-hapus:hover { background:#fff0f0; }

  .baby-card {
    display:inline-flex; align-items:center; gap:10px;
    background:var(--teal-light); border-radius:12px; padding:10px 18px;
    text-decoration:none; color:var(--teal-dark); font-weight:700; font-size:.9rem;
    margin:0 8px 8px 0; transition:all .2s; border:2px solid transparent;
  }
  .baby-card:hover,.baby-card.active { background:var(--teal); color:var(--white); }

  .milestone-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:18px; margin-top:24px; }
  .milestone-card { background:var(--white); border-radius:var(--radius); padding:22px 20px; box-shadow:var(--shadow); display:flex; gap:14px; align-items:flex-start; opacity:0; transform:translateY(20px); transition:opacity .5s,transform .5s,box-shadow .2s; }
  .milestone-card.visible { opacity:1; transform:translateY(0); }
  .ms-icon { font-size:1.6rem; width:46px; height:46px; background:var(--yellow); border-radius:12px; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
  .ms-badge { font-size:.72rem; font-weight:700; background:var(--teal-light); color:var(--teal-dark); padding:2px 8px; border-radius:50px; margin-bottom:4px; display:inline-block; }
  .ms-title { font-family:'Nunito',sans-serif; font-weight:800; font-size:.97rem; color:var(--text-dark); margin-bottom:4px; }
  .ms-desc  { font-size:.84rem; color:var(--text-mid); line-height:1.5; }

  @media(max-width:640px){ .tw-form-row{grid-template-columns:1fr;} }
</style>

<div class="page-wrapper">

  <!-- Header + Logout -->
  <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:8px;">
    <div class="page-title-bar" style="margin-bottom:0;">
      <h1>📈 Tumbuh Kembang</h1>
      <p>Halo, <strong><?= htmlspecialchars($user['nama']) ?></strong>! Pantau pertumbuhan si kecil di sini.</p>
    </div>
    <a href="logout.php" style="color:var(--text-mid);font-size:.88rem;font-weight:600;text-decoration:none;padding:8px 18px;border:2px solid #dde9ea;border-radius:50px;transition:all .2s;"
       onmouseover="this.style.borderColor='#e57373';this.style.color='#e57373'"
       onmouseout="this.style.borderColor='#dde9ea';this.style.color='var(--text-mid)'">
      Keluar
    </a>
  </div>

  <?php showFlash(); ?>
  <?php if (!empty($errors)): ?>
    <div class="alert alert-error"><?php foreach($errors as $e) echo '<div>• '.htmlspecialchars($e).'</div>'; ?></div>
  <?php endif; ?>

  <!-- ── Notif jika belum ada bayi ── -->
  <?php if (empty($babies)): ?>
    <div class="alert alert-error" style="max-width:700px;">
      Belum ada profil bayi. 
      <a href="profil.php" style="color:var(--teal-dark);font-weight:700;">Tambahkan di halaman Profil →</a>
    </div>
  <?php else: ?>
    <!-- Pilih bayi -->
    <div class="section-box" style="max-width:700px;margin-bottom:10px;padding:18px 24px;">
      <p style="font-size:.88rem;font-weight:700;color:var(--text-mid);margin-bottom:10px;">Pilih bayi untuk lihat riwayat:</p>
      <?php foreach ($babies as $b): ?>
        <a href="tumbuh.php?baby=<?= $b['id'] ?>"
           class="baby-card <?= $activeBabyId === (int)$b['id'] ? 'active' : '' ?>">
          <?= $b['jenis_kelamin'] === 'L' ? '👦' : '👧' ?>
          <?= htmlspecialchars($b['nama']) ?>
        </a>
      <?php endforeach; ?>
      <a href="profil.php" style="font-size:.82rem;color:var(--text-mid);font-weight:600;text-decoration:none;margin-left:8px;">
        + Tambah bayi baru
      </a>
    </div>
  <?php endif; ?>

  <!-- ── BAGIAN 2: Input Pengukuran ── -->
  <?php if (!empty($babies)): ?>
  <div class="section-box">
    <h2>📏 Catat Pengukuran Baru</h2>
    <form method="POST">
      <input type="hidden" name="action" value="simpan_ukur"/>
      <div class="tw-form-row">
        <div>
          <label class="form-label">Pilih Bayi</label>
          <select class="form-input" name="baby_id" required style="cursor:pointer;">
            <option value="">-- Pilih bayi --</option>
            <?php foreach ($babies as $b): ?>
              <option value="<?= $b['id'] ?>" <?= $activeBabyId === (int)$b['id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($b['nama']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="form-label">Tanggal Ukur</label>
          <input class="form-input" type="date" name="tgl_ukur" value="<?= date('Y-m-d') ?>" required/>
        </div>
        <div>
          <label class="form-label">Usia Saat Ukur (bulan)</label>
          <input class="form-input" type="number" name="usia" placeholder="Contoh: 9" min="0" max="60" required/>
        </div>
        <div>
          <label class="form-label">Berat Badan (kg)</label>
          <input class="form-input" type="number" name="bb" step="0.1" placeholder="Contoh: 8.5" required/>
        </div>
        <div>
          <label class="form-label">Tinggi Badan (cm)</label>
          <input class="form-input" type="number" name="tb" step="0.1" placeholder="Contoh: 72" required/>
        </div>
        <div>
          <label class="form-label">Lingkar Kepala (cm)</label>
          <input class="form-input" type="number" name="lk" step="0.1" placeholder="Contoh: 44.5" required/>
        </div>
      </div>
      <label class="form-label">Catatan (opsional)</label>
      <textarea class="form-input" name="catatan" placeholder="Contoh: bayi aktif, nafsu makan baik..." rows="2" style="resize:vertical;"></textarea>
      <button class="form-btn" type="submit" style="max-width:280px;">Simpan Pengukuran</button>
    </form>
  </div>
  <?php endif; ?>

  <!-- ── BAGIAN 3: Riwayat Pengukuran ── -->
  <?php if ($selectedBaby && !empty($riwayat)): ?>
  <div class="section-box">
    <h2>📋 Riwayat <?= htmlspecialchars($selectedBaby['nama']) ?></h2>
    <div style="overflow-x:auto;">
      <table class="riwayat-table">
        <thead>
          <tr>
            <th>Tanggal</th>
            <th>Usia</th>
            <th>BB (kg)</th>
            <th>TB (cm)</th>
            <th>LK (cm)</th>
            <th>Status BB</th>
            <th>Status TB</th>
            <th>Catatan</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($riwayat as $r): ?>
          <tr>
            <td><?= date('d/m/Y', strtotime($r['tanggal_ukur'])) ?></td>
            <td><?= $r['usia_bulan'] ?> bln</td>
            <td><?= $r['berat_badan'] ?></td>
            <td><?= $r['tinggi_badan'] ?></td>
            <td><?= $r['lingkar_kepala'] ?></td>
            <td>
              <?php
                $cls = match(strtolower($r['status_bb'] ?? '')) {
                    'normal' => 'status-normal',
                    'kurang' => 'status-kurang',
                    'lebih'  => 'status-lebih',
                    default  => ''
                };
              ?>
              <span class="status-badge <?= $cls ?>"><?= htmlspecialchars($r['status_bb'] ?? '-') ?></span>
            </td>
            <td>
              <?php
                $cls2 = match(strtolower($r['status_tb'] ?? '')) {
                    'normal' => 'status-normal',
                    'pendek' => 'status-pendek',
                    'tinggi' => 'status-tinggi',
                    default  => ''
                };
              ?>
              <span class="status-badge <?= $cls2 ?>"><?= htmlspecialchars($r['status_tb'] ?? '-') ?></span>
            </td>
            <td style="max-width:160px;font-size:.83rem;color:var(--text-mid);"><?= htmlspecialchars($r['catatan'] ?? '-') ?></td>
            <td>
              <button class="btn-hapus" onclick="if(confirm('Hapus catatan ini?')) window.location='tumbuh.php?hapus=<?= $r['id'] ?>&baby=<?= $activeBabyId ?>'">🗑️ Hapus</button>
            </td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php elseif ($selectedBaby): ?>
    <div class="alert alert-success" style="max-width:700px;">Belum ada catatan untuk <?= htmlspecialchars($selectedBaby['nama']) ?>. Tambahkan pengukuran pertama di atas!</div>
  <?php endif; ?>

  <!-- ── BAGIAN 4: Milestones ── -->
  <div style="margin-top:48px;">
    <div class="page-title-bar"><h1 style="font-size:1.5rem;">🌟 Milestone Perkembangan</h1></div>
    <div class="milestone-grid">
      <?php foreach ($milestones as $i => $m): ?>
        <div class="milestone-card" style="transition-delay:<?= $i*0.08 ?>s">
          <div class="ms-icon"><?= $m['icon'] ?></div>
          <div>
            <span class="ms-badge"><?= $m['usia'] ?></span>
            <div class="ms-title"><?= $m['judul'] ?></div>
            <div class="ms-desc"><?= $m['deskripsi'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div style="margin-top:28px;">
    <a href="../index.php" style="color:var(--teal);font-size:.9rem;font-weight:600;text-decoration:none;">← Kembali ke Beranda</a>
  </div>
</div>

<script>
  const obs = new IntersectionObserver((e) => e.forEach(x => { if(x.isIntersecting) x.target.classList.add('visible'); }), {threshold:.1});
  document.querySelectorAll('.milestone-card').forEach(c => obs.observe(c));
</script>

<?php include '../layout/footer.php'; ?>
