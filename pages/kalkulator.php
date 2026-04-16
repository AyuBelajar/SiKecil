<!-- LOADING -->
<div id="loading-screen">
  <div class="loading-icon">🧠</div>
  <div class="loading-text">Memuat Model AI...</div>
  <div class="loading-sub">Menyiapkan Random Forest</div>
  <div class="loading-bar"><div class="loading-bar-fill"></div></div>
</div>

<!-- ERROR -->
<div id="error-screen">
  <div class="err-icon">⚠️</div>
  <h2>Model tidak ditemukan!</h2>
  <p>
    File <code>model_balita.json</code> belum ada di folder project.
  </p>
</div>

<!-- MAIN -->
<div id="main-content">

  <div class="container">

    <!-- FORM -->
    <div class="card">

      <!-- Gender -->
      <div class="gender-section">
        <label class="gender-option">
          <input type="radio" name="gender" value="laki-laki" checked/>
          <div class="gender-img-wrap">
            <img src="img/bayi-laki.png"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
            <span class="emoji-fallback" style="display:none">👦</span>
          </div>
          <div class="gender-label">Laki-laki</div>
        </label>

        <label class="gender-option">
          <input type="radio" name="gender" value="perempuan"/>
          <div class="gender-img-wrap">
            <img src="img/bayi-perempuan.png"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='block'">
            <span class="emoji-fallback" style="display:none">👧</span>
          </div>
          <div class="gender-label">Perempuan</div>
        </label>
      </div>

      <!-- INPUT -->
      <div class="field">
        <label>Usia anak :</label>
        <div class="field-inputs">
          <input type="number" id="umur" min="0" max="60" placeholder="12"/>
          <span class="field-unit">bulan</span>
        </div>
      </div>

      <div class="field">
        <label>Tinggi badan :</label>
        <div class="field-inputs">
          <input type="number" id="tinggi" min="40" max="130" step="0.1" placeholder="72.5"/>
          <span class="field-unit">cm</span>
        </div>
      </div>

      <button class="btn-hitung" onclick="predict()">HITUNG</button>
    </div>

    <!-- RESULT -->
    <div class="card">
      <div class="result-placeholder" id="placeholder">
        <div class="ph-icon">📊</div>
        <p>Isi data lalu klik <strong>HITUNG</strong></p>
      </div>

      <div id="result-panel">
        <div class="result-header" id="res-header">—</div>
        <div class="advice-list" id="advice-list"></div>

        <div class="conf-section">
          <div class="conf-title">Probabilitas</div>
          <div id="conf-bars"></div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
let MODEL = null;

fetch('model_balita.json')
  .then(res => {
    if (!res.ok) throw new Error();
    return res.json();
  })
  .then(data => {
    MODEL = data;
    document.getElementById('loading-screen').style.display = 'none';
    document.getElementById('main-content').style.display = 'block';
  })
  .catch(() => {
    document.getElementById('loading-screen').style.display = 'none';
    document.getElementById('error-screen').style.display = 'flex';
  });

// RF
function traverse(node, feat) {
  if (node.leaf) return node.value;
  return feat[node.feature] <= node.threshold
    ? traverse(node.left, feat)
    : traverse(node.right, feat);
}

function rfPredict(feat) {
  const votes = new Array(MODEL.n_classes).fill(0);
  MODEL.trees.forEach(t => votes[traverse(t, feat)]++);
  const total = MODEL.trees.length;
  const proba = votes.map(v => v / total);
  const idx = proba.indexOf(Math.max(...proba));
  return { label: MODEL.classes[idx], proba };
}

// Advice
const ADVICE = {
  'severely stunted': { cls:'severely-stunted', items:['Stunting berat, segera ke fasilitas kesehatan'] },
  'stunted': { cls:'stunted', items:['Indikasi stunting, cek ke posyandu'] },
  'normal': { cls:'normal', items:['Normal, pertahankan gizi seimbang'] },
  'tinggi': { cls:'tinggi', items:['Di atas rata-rata, tetap pantau'] }
};

function predict() {
  const umur = parseFloat(document.getElementById('umur').value);
  const tinggi = parseFloat(document.getElementById('tinggi').value);
  const gender = document.querySelector('input[name=gender]:checked').value;

  if (isNaN(umur) || isNaN(tinggi)) {
    alert('Isi data dulu!');
    return;
  }

  const genderEnc = gender === 'laki-laki' ? 0 : 1;
  const { label, proba } = rfPredict([umur, genderEnc, tinggi]);
  const meta = ADVICE[label];

  document.getElementById('placeholder').style.display = 'none';
  document.getElementById('result-panel').style.display = 'block';

  document.getElementById('res-header').textContent = label;

  const al = document.getElementById('advice-list');
  al.innerHTML = '';
  meta.items.forEach(t => {
    const d = document.createElement('div');
    d.className = 'advice-item';
    d.textContent = t;
    al.appendChild(d);
  });
}
</script>