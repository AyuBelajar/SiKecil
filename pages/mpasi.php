<?php
$pageTitle = 'MPASI';
$basePath  = '../';
include '../layout/header.php';

$filter = $_GET['usia'] ?? 'semua';

$menus = [
  ['icon'=>'🥣','nama'=>'Bubur Susu Halus',        'usia'=>'6 bln', 'tag'=>6,  'bahan'=>'Tepung beras, ASI/sufor, sedikit gula',       'cara'=>'Masak tepung beras dengan air, tambahkan ASI. Saring hingga halus.'],
  ['icon'=>'🥕','nama'=>'Puree Wortel & Kentang',   'usia'=>'6 bln', 'tag'=>6,  'bahan'=>'Wortel, kentang, ASI/sufor',                   'cara'=>'Kukus wortel dan kentang, blender hingga halus dengan ASI.'],
  ['icon'=>'🍠','nama'=>'Puree Ubi Jalar',           'usia'=>'6 bln', 'tag'=>6,  'bahan'=>'Ubi jalar, ASI/sufor',                         'cara'=>'Kukus ubi, haluskan. Tambahkan ASI untuk tekstur lebih cair.'],
  ['icon'=>'🍗','nama'=>'Bubur Ayam Sayuran',        'usia'=>'8 bln', 'tag'=>8,  'bahan'=>'Beras, ayam tanpa tulang, bayam, kaldu',       'cara'=>'Masak beras menjadi bubur, tambahkan ayam suwir dan bayam cincang.'],
  ['icon'=>'🐟','nama'=>'Puree Ikan Kakap',          'usia'=>'8 bln', 'tag'=>8,  'bahan'=>'Ikan kakap, wortel, kaldu ikan',                'cara'=>'Kukus ikan dan wortel, blender dengan kaldu. Saring bila perlu.'],
  ['icon'=>'🥚','nama'=>'Telur Dadar Lembut',        'usia'=>'9 bln', 'tag'=>9,  'bahan'=>'Telur, sedikit minyak zaitun',                 'cara'=>'Kocok telur, masak dengan api kecil hingga matang lembut.'],
  ['icon'=>'🥦','nama'=>'Tim Brokoli Tahu',          'usia'=>'10 bln','tag'=>10, 'bahan'=>'Brokoli, tahu sutra, bawang putih, minyak',    'cara'=>'Tumis bawang, masukkan brokoli dan tahu. Tim hingga lembut.'],
  ['icon'=>'🍚','nama'=>'Nasi Tim Daging Sapi',      'usia'=>'10 bln','tag'=>10, 'bahan'=>'Beras, daging sapi, wortel, buncis, kaldu',    'cara'=>'Masak beras dan daging bersama kaldu hingga menjadi nasi tim.'],
  ['icon'=>'🍜','nama'=>'Sup Makaroni Sayuran',      'usia'=>'12 bln','tag'=>12, 'bahan'=>'Makaroni, ayam, wortel, kentang, kaldu',       'cara'=>'Rebus makaroni, tambahkan ayam suwir dan sayuran. Masak hingga lunak.'],
  ['icon'=>'🥗','nama'=>'Nasi Sayur Tumis',          'usia'=>'12 bln','tag'=>12, 'bahan'=>'Nasi, bayam, tahu, tempe, minyak zaitun',      'cara'=>'Tumis sayuran dan lauk, sajikan bersama nasi lunak.'],
  ['icon'=>'🫐','nama'=>'Smoothie Buah Segar',       'usia'=>'12 bln','tag'=>12, 'bahan'=>'Pisang, pepaya, ASI atau air mineral',         'cara'=>'Blender buah dengan ASI atau air. Sajikan segera.'],
  ['icon'=>'🥩','nama'=>'Bistik Hati Ayam',          'usia'=>'12 bln','tag'=>12, 'bahan'=>'Hati ayam, bawang, tomat, kaldu sapi',         'cara'=>'Tumis hati ayam dengan bumbu, tambahkan tomat dan kaldu hingga matang.'],
];

if ($filter !== 'semua') {
  $tagFilter = (int)$filter;
  $menus = array_filter($menus, fn($m) => $m['tag'] === $tagFilter);
}
?>

<style>
  .filter-bar {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 32px;
  }
  .filter-btn {
    padding: 8px 20px;
    border-radius: 50px;
    border: 2px solid var(--teal-light);
    background: var(--white);
    color: var(--text-mid);
    font-family: 'Poppins', sans-serif;
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    transition: all 0.2s;
  }
  .filter-btn:hover, .filter-btn.active {
    background: var(--teal);
    border-color: var(--teal);
    color: var(--white);
  }
  .mpasi-card { opacity: 0; transform: translateY(20px); transition: opacity 0.5s ease, transform 0.5s ease, box-shadow 0.2s; }
  .mpasi-card.visible { opacity: 1; transform: translateY(0); }
</style>

<div class="page-wrapper">
  <div class="page-title-bar">
    <h1>🍲 Panduan MPASI</h1>
    <p>Pilihan menu MPASI bergizi sesuai tahapan usia si kecil.</p>
  </div>

  <!-- Filter by usia -->
  <div class="filter-bar">
    <a href="mpasi.php"          class="filter-btn <?= $filter === 'semua' ? 'active' : '' ?>">Semua Usia</a>
    <a href="mpasi.php?usia=6"   class="filter-btn <?= $filter === '6'     ? 'active' : '' ?>">6 Bulan</a>
    <a href="mpasi.php?usia=8"   class="filter-btn <?= $filter === '8'     ? 'active' : '' ?>">8 Bulan</a>
    <a href="mpasi.php?usia=9"   class="filter-btn <?= $filter === '9'     ? 'active' : '' ?>">9 Bulan</a>
    <a href="mpasi.php?usia=10"  class="filter-btn <?= $filter === '10'    ? 'active' : '' ?>">10 Bulan</a>
    <a href="mpasi.php?usia=12"  class="filter-btn <?= $filter === '12'    ? 'active' : '' ?>">12 Bulan</a>
  </div>

  <div class="mpasi-grid">
    <?php foreach (array_values($menus) as $i => $menu): ?>
      <div class="mpasi-card" style="transition-delay:<?= $i * 0.07 ?>s">
        <div class="m-icon"><?= $menu['icon'] ?></div>
        <div>
          <span class="badge"><?= $menu['usia'] ?></span>
          <h3><?= htmlspecialchars($menu['nama']) ?></h3>
          <p><strong>Bahan:</strong> <?= htmlspecialchars($menu['bahan']) ?></p>
          <p style="margin-top:4px;"><strong>Cara:</strong> <?= htmlspecialchars($menu['cara']) ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div style="margin-top:28px;">
    <a href="../index.php" style="color:var(--teal);font-size:.9rem;font-weight:600;text-decoration:none;">← Kembali ke Beranda</a>
  </div>
</div>

<script>
  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.08 });
  document.querySelectorAll('.mpasi-card').forEach(c => obs.observe(c));
</script>

<?php include '../layout/footer.php'; ?>
