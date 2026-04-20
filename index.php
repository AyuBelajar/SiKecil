<?php
$pageTitle = 'Beranda';
$basePath = '';
include 'layout/header.php';
?>

<style>
  /* ── HERO (fullscreen background) ── */
  @keyframes fadeUp {
    from {
      opacity: 0;
      transform: translateY(32px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .hero {
    position: relative;
    width: 100%;
    min-height: calc(100vh - 68px);
    background-image: url('assets/img/BG_Ibu_dan_Bayi.png');
    background-size: cover;
    background-position: center right;
    background-repeat: no-repeat;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  /* gradient overlay kiri agar teks terbaca */
  .hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right,
        rgba(237, 246, 246, 0.97) 0%,
        rgba(237, 246, 246, 0.85) 45%,
        rgba(237, 246, 246, 0.10) 75%,
        transparent 100%);
    pointer-events: none;
  }

  .hero-text {
    position: relative;
    z-index: 2;
    max-width: 560px;
    padding: 80px 80px;
    animation: fadeUp 0.7s ease both;
  }

  .hero-text h1 {
    font-family: 'Nunito', sans-serif;
    font-size: clamp(2.4rem, 4.5vw, 3.4rem);
    font-weight: 900;
    color: var(--text-dark);
    line-height: 1.15;
    margin-bottom: 18px;
  }

  .hero-text p {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--teal);
    margin-bottom: 40px;
    line-height: 1.5;
  }

  .btn-mulai {
    display: inline-block;
    background: var(--yellow);
    color: var(--text-dark);
    font-family: 'Nunito', sans-serif;
    font-size: 1.1rem;
    font-weight: 900;
    letter-spacing: 1px;
    padding: 16px 56px;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    text-decoration: none;
    box-shadow: 0 6px 24px rgba(245, 200, 66, 0.50);
    transition: transform 0.18s, box-shadow 0.18s, background 0.18s;
  }

  .btn-mulai:hover {
    transform: translateY(-3px) scale(1.04);
    box-shadow: 0 10px 30px rgba(245, 200, 66, 0.60);
    background: var(--yellow-dark);
  }

  /* ── FEATURE CARDS ── */
  .features {
    display: flex;
    justify-content: center;
    gap: 28px;
    padding: 48px 80px 60px;
    flex-wrap: wrap;
    animation: fadeUp 0.7s 0.2s ease both;
    background: var(--bg);
  }

  .feat-card {
    background: var(--white);
    border-radius: var(--radius);
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 20px;
    min-width: 220px;
    box-shadow: var(--shadow);
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    transition: transform 0.2s, box-shadow 0.2s;
    border: 2px solid transparent;
    flex: 1;
    max-width: 300px;
  }

  .feat-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(58, 172, 168, 0.18);
    border-color: var(--teal-light);
  }

  /* Icon: mix-blend-mode multiply menghilangkan background hitam PNG */
  .feat-icon {
    width: 68px;
    height: 68px;
    border-radius: 50%;
    background: var(--yellow);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 10px;
    transition: transform 0.25s, background 0.25s;
    box-shadow: 0 4px 14px rgba(245, 200, 66, 0.30);
    overflow: hidden;
  }

  .feat-icon img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    mix-blend-mode: multiply;
    /* ← hilangkan background hitam PNG */
  }

  .feat-card:hover .feat-icon {
    transform: rotate(-8deg) scale(1.1);
    background: var(--teal);
  }

  /* saat hover di atas teal, pakai screen agar icon tetap terlihat */
  .feat-card:hover .feat-icon img {
    mix-blend-mode: screen;
  }

  .feat-label {
    font-family: 'Nunito', sans-serif;
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--text-dark);
    line-height: 1.3;
  }

  @media (max-width: 820px) {
    .hero {
      min-height: 70vw;
      background-position: right center;
    }

    .hero-text {
      padding: 40px 28px;
      max-width: 100%;
    }

    .hero-text h1 {
      font-size: 2rem;
    }

    .features {
      padding: 32px 24px 48px;
      gap: 16px;
    }

    .feat-card {
      max-width: 100%;
    }
  }
</style>

<!-- ══ HERO ══ -->
<section class="hero">
  <div class="hero-text">
    <h1>Catat Tumbuh<br>Kembang Si Kecil</h1>
    <p>Pantau, Pahami, dan Optimalkan Tumbuh Kembang Bayi</p>
    <a href="pages/register.php" class="btn-mulai">MULAI</a>
  </div>
</section>

<!-- ══ FEATURE CARDS ══ -->
<section class="features">
  <a href="pages/kalkulator.php" class="feat-card">
    <div class="feat-icon">
      <img src="assets/img/Logo_kalkulator.png" alt="Kalkulator Gizi" />
    </div>
    <div class="feat-label">Kalkulator<br>Gizi</div>
  </a>
  <a href="pages/tumbuh.php" class="feat-card">
    <div class="feat-icon">
      <img src="assets/img/Logo_Tumbuh_Kembang.png" alt="Tumbuh Kembang" />
    </div>
    <div class="feat-label">Tumbuh<br>Kembang</div>
  </a>
  <a href="pages/mpasi.php" class="feat-card">
    <div class="feat-icon">
      <img src="assets/img/Logo_MPASI.png" alt="MPASI" />
    </div>
    <div class="feat-label">MPASI</div>
  </a>
</section>

<?php include 'layout/footer.php'; ?>