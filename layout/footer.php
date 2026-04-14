<!-- ══ WAVE DIVIDER ══ -->
<div class="wave-divider">
  <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" height="60">
    <path d="M0,0 C360,60 1080,0 1440,40 L1440,60 L0,60 Z" fill="#ffffff"/>
  </svg>
</div>

<!-- ══ TENTANG SIKECIL ══ -->
<section class="tentang" id="tentang">
  <div class="tentang-header">
    <div class="tag">Tentang SiKecil</div>
    <h2>Kenapa SiKecil Hadir?</h2>
    <p>Kami percaya setiap bayi berhak tumbuh optimal. SiKecil lahir dari kepedulian terhadap generasi penerus bangsa yang sehat dan cerdas.</p>
  </div>
  <div class="tentang-cards">
    <div class="tentang-card card-bg">
      <div class="card-num">01</div>
      <div class="card-icon-wrap">🌱</div>
      <h3>Latar Belakang</h3>
      <p>Stunting dan gizi buruk masih menjadi tantangan besar di Indonesia. Banyak orang tua belum memiliki akses mudah untuk memantau tumbuh kembang buah hatinya secara teratur dan terstandar. SiKecil hadir sebagai solusi digital yang sederhana, terpercaya, dan mudah digunakan oleh siapa saja.</p>
    </div>
    <div class="tentang-card card-yellow" style="transition-delay:0.15s">
      <div class="card-num">02</div>
      <div class="card-icon-wrap">🎯</div>
      <h3>Tujuan Kami</h3>
      <p>Memberikan panduan tumbuh kembang berbasis standar WHO kepada setiap orang tua. Dengan fitur kalkulator gizi, pemantauan pertumbuhan, dan panduan MPASI, kami membantu orang tua membuat keputusan yang tepat untuk kesehatan bayi mereka sejak dini.</p>
    </div>
    <div class="tentang-card card-soft" style="transition-delay:0.30s">
      <div class="card-num">03</div>
      <div class="card-icon-wrap">✨</div>
      <h3>Harapan Kami</h3>
      <p>Kami bermimpi generasi Indonesia tumbuh sehat, cerdas, dan bahagia. Setiap data yang tercatat di SiKecil adalah langkah kecil menuju Indonesia bebas stunting — karena anak yang sehat hari ini adalah pemimpin Indonesia di masa depan.</p>
    </div>
  </div>
</section>

<!-- ══ HARAPAN STRIP ══ -->
<div class="harapan-strip">
  <div class="harapan-icon-big">💛</div>
  <div class="harapan-text">
    <h3>Bersama Wujudkan Generasi Emas Indonesia</h3>
    <p>SiKecil berkomitmen mendampingi perjalanan tumbuh kembang buah hati Anda — dari lahir hingga usia 5 tahun. Karena setiap momen pertumbuhan adalah anugerah yang tak ternilai, dan kami ingin Anda tidak melewatkan satu pun darinya.</p>
  </div>
</div>

<!-- ══ FOOTER ══ -->
<footer>
  <a href="<?= $basePath ?? '' ?>index.php">
    <img src="<?= $basePath ?? '' ?>assets/img/Logo_Web.png" alt="SiKecil" class="f-logo-img"/>
  </a>
  <p>© <?= date('Y') ?> SiKecil · Pantau, Pahami, dan Optimalkan Tumbuh Kembang Bayi</p>
</footer>

<!-- ══ GLOBAL JS ══ -->
<script>
  // Scroll-triggered card animation
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
  }, { threshold: 0.15 });
  document.querySelectorAll('.tentang-card').forEach(c => observer.observe(c));
</script>
</body>
</html>
