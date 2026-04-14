<?php
$pageTitle = 'Kalkulator Gizi';
$basePath  = '../';
include '../layout/header.php';

$result = null;
$error  = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $usia = (float)($_POST['usia'] ?? 0);
  $bb   = (float)($_POST['bb']   ?? 0);
  $tb   = (float)($_POST['tb']   ?? 0);

  if (!$usia || !$bb || !$tb) {
    $error = 'Isi semua data bayi terlebih dahulu.';
  } elseif ($usia < 0 || $usia > 60) {
    $error = 'Usia bayi harus antara 0–60 bulan.';
  } elseif ($bb < 1 || $bb > 30) {
    $error = 'Berat badan tidak valid (1–30 kg).';
  } else {
    $kalori  = round($bb * 100);
    $protein = round($bb * 1.5 * 10) / 10;
    $cairan  = round($bb * 150);
    $lemak   = round($kalori * 0.35 / 9);
    $karbo   = round(($kalori - ($protein * 4) - ($lemak * 9)) / 4);

    // Klasifikasi BB berdasarkan usia (sangat sederhana)
    $bbIdeal = 3.3 + ($usia * 0.45);
    if ($usia > 6) $bbIdeal = 6.5 + (($usia - 6) * 0.35);
    $status = 'Normal';
    $statusClass = 'alert-success';
    if ($bb < $bbIdeal * 0.85)      { $status = 'Kurang'; $statusClass = 'alert-error'; }
    elseif ($bb > $bbIdeal * 1.20)  { $status = 'Lebih';  $statusClass = 'alert-error'; }

    $result = compact('kalori','protein','cairan','lemak','karbo','status','statusClass');
  }
}
?>

<div class="page-wrapper">
  <div class="tw-section" style="max-width:600px;">

    <div class="page-title-bar">
      <h1>🧮 Kalkulator Gizi</h1>
      <p>Hitung kebutuhan gizi harian bayi berdasarkan usia dan data fisiknya.</p>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="form-card" style="max-width:100%;">
      <form method="POST">
        <label style="font-size:.85rem;font-weight:600;color:var(--text-mid);display:block;margin-bottom:6px;">Usia Bayi (bulan)</label>
        <input class="form-input" type="number" name="usia" placeholder="Contoh: 9" min="0" max="60" value="<?= htmlspecialchars($_POST['usia'] ?? '') ?>" required/>

        <label style="font-size:.85rem;font-weight:600;color:var(--text-mid);display:block;margin-bottom:6px;">Berat Badan (kg)</label>
        <input class="form-input" type="number" name="bb" placeholder="Contoh: 8.5" step="0.1" min="1" max="30" value="<?= htmlspecialchars($_POST['bb'] ?? '') ?>" required/>

        <label style="font-size:.85rem;font-weight:600;color:var(--text-mid);display:block;margin-bottom:6px;">Tinggi Badan (cm)</label>
        <input class="form-input" type="number" name="tb" placeholder="Contoh: 72" min="40" max="130" value="<?= htmlspecialchars($_POST['tb'] ?? '') ?>" required/>

        <button class="form-btn" type="submit">Hitung Kebutuhan Gizi</button>
      </form>

      <?php if ($result): ?>
        <div class="result-box" style="margin-top:28px;">
          <h3>📊 Hasil Perhitungan</h3>
          <div class="alert <?= $result['statusClass'] ?>" style="margin-bottom:16px;">
            Status Berat Badan: <strong><?= $result['status'] ?></strong>
          </div>
          <div class="info-grid">
            <div class="info-tile"><div class="val"><?= $result['kalori'] ?></div><div class="lbl">Kalori (kkal/hari)</div></div>
            <div class="info-tile"><div class="val"><?= $result['protein'] ?>g</div><div class="lbl">Protein/hari</div></div>
            <div class="info-tile"><div class="val"><?= $result['cairan'] ?>ml</div><div class="lbl">Cairan/hari</div></div>
            <div class="info-tile"><div class="val"><?= $result['lemak'] ?>g</div><div class="lbl">Lemak/hari</div></div>
            <div class="info-tile"><div class="val"><?= $result['karbo'] ?>g</div><div class="lbl">Karbohidrat/hari</div></div>
            <div class="info-tile"><div class="val">✅</div><div class="lbl">Dihitung</div></div>
          </div>
          <p style="font-size:.82rem;color:var(--text-mid);margin-top:10px;">*Perhitungan bersifat estimasi. Konsultasikan dengan dokter anak untuk panduan lebih lanjut.</p>
        </div>
      <?php endif; ?>
    </div>

    <div style="margin-top:20px;">
      <a href="../index.php" style="color:var(--teal);font-size:.9rem;font-weight:600;text-decoration:none;">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

<?php include '../layout/footer.php'; ?>
