<?php
$pageTitle = 'Tumbuh Kembang (KPSP)';
$basePath  = '../';
include '../layout/header.php';
?>

<style>
    /* Menyimpan variabel warna khusus untuk KPSP agar tidak merusak global CSS */
    :root {
        --tk-teal: #4a9ba8;
        --tk-teal-dark: #3a7d88;
        --tk-teal-light: #e8f4f6;
        --tk-sand: #f0e9d2;
        --tk-sand-dark: #e0d5b5;
        --tk-accent: #f4a04a;
        --tk-green: #5cb85c;
        --tk-red: #d9534f;
        --tk-yellow: #f0ad4e;
        --tk-radius: 16px;
        --tk-shadow: 0 4px 20px rgba(74, 155, 168, 0.15);
    }

    /* AGE TABS */
    .age-tabs-wrapper {
        background: white;
        border-radius: var(--tk-radius);
        margin-bottom: 20px;
        position: sticky;
        top: 80px; /* Menyesuaikan jika ada sticky header dari layout utama */
        z-index: 90;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        overflow: hidden;
    }
    .age-tabs { display: flex; justify-content: center; overflow-x: auto; scrollbar-width: none; padding: 0; }
    .age-tabs::-webkit-scrollbar { display: none; }
    .age-tab {
        flex: 1;
        min-width: 0;
        max-width: 160px;
        padding: 15px 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 800;
        color: var(--text-light); /* Asumsi ada dari global CSS */
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        white-space: nowrap;
        text-align: center;
    }
    .age-tab:hover { color: var(--tk-teal); }
    .age-tab.active { color: var(--tk-teal-dark); border-bottom-color: var(--tk-teal); background: var(--tk-teal-light); }

    /* KUESIONER */
    .kuesioner-container { max-width: 860px; margin: 0 auto; padding: 0 0 40px; }
    .kuesioner-panel { display: none; }
    .kuesioner-panel.active { display: block; animation: fadeSlide 0.32s ease; }

    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .kuesioner-header {
        background: linear-gradient(135deg, var(--tk-teal) 0%, var(--tk-teal-dark) 100%);
        border-radius: var(--tk-radius);
        padding: 20px 24px;
        margin-bottom: 16px;
        color: white;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .kuesioner-header h3 { color: white; margin: 0 0 5px 0; font-family: 'Nunito', sans-serif; font-weight: 900; }
    .kuesioner-header p { margin: 0; font-size: 14px; opacity: 0.9; line-height: 1.5; }
    
    .tools-box {
        background: white;
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 14px;
        border: 1.5px solid #ddeef0;
        display: flex;
        gap: 10px;
        font-size: 13px;
        line-height: 1.6;
    }
    .tools-box .ti { font-size: 18px; flex-shrink: 0; margin-top: 1px; }
    .tools-box strong { color: var(--tk-teal-dark); font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 2px; }
    
    .tip-box {
        background: #fff8ee;
        border-left: 4px solid var(--tk-accent);
        border-radius: 0 10px 10px 0;
        padding: 11px 15px;
        margin-bottom: 16px;
        font-size: 13px;
        color: #7a5a20;
        line-height: 1.6;
    }
    .tip-box strong { color: #b07020; }
    
    .progress-label { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px; font-weight: 600; }
    .progress-bar-wrap { background: #e0ecee; border-radius: 50px; height: 9px; margin-bottom: 20px; overflow: hidden; }
    .progress-bar { height: 100%; background: linear-gradient(90deg, var(--tk-teal), var(--tk-accent)); border-radius: 50px; transition: width 0.4s ease; width: 0%; }

    /* QUESTION CARD */
    .question-card {
        background: white;
        border-radius: 16px;
        margin-bottom: 18px;
        box-shadow: 0 3px 14px rgba(0,0,0,0.08);
        border: 2px solid transparent;
        transition: border-color 0.2s, box-shadow 0.2s;
        overflow: hidden;
        text-align: center; /* 1. Bikin wadah foto otomatis terdorong ke rata tengah */
    }
    .question-card.answered-ya { border-color: var(--tk-green); box-shadow: 0 3px 14px rgba(92,184,92,0.2); }
    .question-card.answered-tidak { border-color: #ddd; }

    /* PERBAIKAN UKURAN GAMBAR & GARIS HITAM */
    .q-photo { 
        position: relative; /* 2. KUNCI: Menahan garis hitam & tulisan agar tidak bocor keluar halaman! */
        display: inline-block; /* 3. Membuat wadah membungkus pas seukuran foto aslinya */
        height: 250px; /* Tinggi maksimal foto */
        max-width: 100%;
        margin-top: 15px; /* Memberi sedikit jarak dari batas atas card */
        border-radius: 10px; /* Biar sudut fotonya agak membulat manis */
        overflow: hidden; 
    }
    .q-photo img { 
        height: 100%; 
        width: auto; 
        max-width: 100%; 
        object-fit: contain; 
        display: block; 
        transition: transform 0.4s ease; 
    }
    
    .question-card:hover .q-photo img { transform: scale(1.03); }
    
    .q-photo-overlay {
        position: absolute; top: 0; left: 0; right: 0;
        display: flex; justify-content: space-between; align-items: flex-start;
        padding: 10px 12px;
        background: linear-gradient(180deg, rgba(0,0,0,0.45) 0%, transparent 100%);
    }
    .qnum {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px; background: white; color: var(--tk-teal-dark);
        border-radius: 50%; font-size: 12px; font-weight: 800; font-family: 'Nunito', sans-serif;
        box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }
    .domain-tag {
        display: inline-block; font-size: 10px; font-weight: 700; padding: 3px 10px;
        border-radius: 30px; text-transform: uppercase; letter-spacing: 0.3px; backdrop-filter: blur(4px);
    }
    .domain-tag.gerak-kasar  { background: rgba(244,160,74,0.92);  color: white; }
    .domain-tag.gerak-halus  { background: rgba(80,128,208,0.92);  color: white; }
    .domain-tag.bicara       { background: rgba(92,184,92,0.92);   color: white; }
    .domain-tag.sosialisasi  { background: rgba(156,64,208,0.92);  color: white; }

    .q-photo-caption {
        position: absolute; bottom: 0; left: 0; right: 0;
        padding: 28px 14px 10px;
        background: linear-gradient(0deg, rgba(0,0,0,0.55) 0%, transparent 100%);
        font-size: 11px; font-weight: 700; color: rgba(255,255,255,0.9);
        text-transform: uppercase; letter-spacing: 0.4px;
        text-align: left;
    }

    .q-photo.loading {
        background: linear-gradient(90deg, #e0ecee 25%, #c8dde0 50%, #e0ecee 75%);
        background-size: 200% 100%;
        animation: shimmer 1.4s infinite;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* KEMBALIKAN TEKS PERTANYAAN KE KIRI */
    .q-main { 
        padding: 16px 18px 14px; 
        display: flex; 
        flex-direction: column; 
        gap: 12px; 
        text-align: left; /* Mencegah teks pertanyaan ikut ke tengah */
    }

    .question-text { font-size: 14px; line-height: 1.75; }

    .answer-buttons { display: flex; gap: 10px; }
    .ans-btn {
        flex: 1; padding: 10px; border-radius: 10px; border: 2px solid #e0e0e0;
        background: white; font-family: 'Nunito', sans-serif; font-size: 14px; font-weight: 700;
        cursor: pointer; transition: all 0.18s; display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .ans-btn.ya  { color: var(--tk-green); }
    .ans-btn.tidak { color: #e66969; }
    .ans-btn.ya:hover,   .ans-btn.ya.selected   { background: var(--tk-green); color: white; border-color: var(--tk-green); }
    .ans-btn.tidak:hover, .ans-btn.tidak.selected { background: #f56c6c; color: white; border-color: #f56c6c; }

    .btn-submit {
        background: var(--tk-teal); border: none; color: white;
        padding: 12px 30px; border-radius: 30px; font-family: 'Nunito', sans-serif;
        font-weight: 800; font-size: 15px; cursor: pointer; transition: all 0.2s;
        margin: 12px auto 0; display: block; box-shadow: 0 4px 14px rgba(74,155,168,0.35);
    }
    .btn-submit:hover { background: var(--tk-teal-dark); transform: translateY(-2px); }
    .btn-submit:disabled { background: #bfcfd3; cursor: not-allowed; transform: none; box-shadow: none; }

    /* RESULT BOX */
    .result-box {
        display: none; border-radius: var(--tk-radius); padding: 0;
        margin-top: 22px; animation: fadeSlide 0.4s ease; overflow: hidden;
    }
    .result-header { padding: 24px 24px 20px; text-align: center; }
    .result-box.sesuai      .result-header { background: linear-gradient(135deg, #edfced, #b8f0b8); }
    .result-box.meragukan   .result-header { background: linear-gradient(135deg, #fffaec, #ffe99a); }
    .result-box.penyimpangan .result-header { background: linear-gradient(135deg, #fff5f5, #ffc8c0); }
    .result-box.sesuai      { border: 2px solid #4caf50; }
    .result-box.meragukan   { border: 2px solid var(--tk-yellow); }
    .result-box.penyimpangan { border: 2px solid var(--tk-red); }

    .result-emoji { font-size: 52px; margin-bottom: 8px; }
    .result-title { font-family: 'Nunito', sans-serif; font-size: 22px; font-weight: 900; margin-bottom: 4px; }
    .result-score-badge {
        display: inline-block; padding: 4px 16px; border-radius: 30px; font-size: 13px; font-weight: 700;
    }
    .sesuai      .result-score-badge { background: rgba(76,175,80,0.18);  color: #2e7d32; }
    .meragukan   .result-score-badge { background: rgba(240,173,78,0.25); color: #7a5a20; }
    .penyimpangan .result-score-badge { background: rgba(217,83,79,0.18); color: #a02020; }

    .result-body { background: white; padding: 20px 24px 24px; }
    .result-section { margin-bottom: 14px; }
    .result-section-title {
        font-family: 'Nunito', sans-serif; font-size: 13px; font-weight: 800;
        text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;
    }
    .result-section-content {
        font-size: 14px; line-height: 1.75; background: #f8f8f8;
        border-radius: 10px; padding: 12px 14px;
    }
    .result-section-content ul { padding-left: 18px; margin-top: 4px; }
    .result-section-content li { margin-bottom: 4px; }

    .alert-banner {
        padding: 10px 14px; border-radius: 10px; font-size: 13.5px; font-weight: 600;
        display: flex; gap: 8px; align-items: flex-start; margin-bottom: 14px; line-height: 1.55;
    }
    .alert-banner.green  { background: #edfced; color: #2e7d32; border: 1.5px solid #a5d6a7; }
    .alert-banner.yellow { background: #fffaec; color: #7a5a20; border: 1.5px solid #ffe082; }
    .alert-banner.red    { background: #fff5f5; color: #a02020; border: 1.5px solid #ef9a9a; }

    .domain-breakdown { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 14px; }
    .domain-item { border-radius: 10px; padding: 10px 12px; font-size: 12.5px; }
    .domain-item .d-name { font-weight: 700; margin-bottom: 3px; }
    .domain-item .d-bar-wrap { height: 6px; background: #e0e0e0; border-radius: 50px; overflow: hidden; }
    .domain-item .d-bar { height: 100%; border-radius: 50px; transition: width 0.5s; }
    
    /* Pewarnaan Spesifik Domain */
    .domain-item.gerak-kasar  { background: #fff5ea; }
    .domain-item.gerak-kasar  .d-name { color: #b05010; }
    .domain-item.gerak-kasar  .d-bar  { background: #f4a04a; }
    .domain-item.gerak-halus  { background: #eef3ff; }
    .domain-item.gerak-halus  .d-name { color: #1050a0; }
    .domain-item.gerak-halus  .d-bar  { background: #5080d0; }
    .domain-item.bicara       { background: #edfced; }
    .domain-item.bicara       .d-name { color: #206020; }
    .domain-item.bicara       .d-bar  { background: #5cb85c; }
    .domain-item.sosialisasi  { background: #f8eeff; }
    .domain-item.sosialisasi  .d-name { color: #6020a0; }
    .domain-item.sosialisasi  .d-bar  { background: #9c40d0; }

    .result-actions { display: flex; gap: 10px; justify-content: center; padding-top: 6px; }
    .btn-reset {
        background: white; border: 2px solid var(--tk-teal); color: var(--tk-teal);
        padding: 9px 22px; border-radius: 30px; font-family: 'Nunito', sans-serif;
        font-weight: 700; font-size: 14px; cursor: pointer; transition: all 0.2s;
    }
    .btn-reset:hover { background: var(--tk-teal); color: white; }

    @media (max-width: 600px) {
        .domain-breakdown { grid-template-columns: 1fr; }
        .age-tab { font-size: 12px; padding: 12px 6px; }
        .q-photo { height: 180px; } /* Di HP gambarnya jadi lebih pendek sedikit biar rapi */
    }
</style>

<div class="page-wrapper">
    <div class="page-title-bar">
        <h1>📈 Pantau Tumbuh Kembang</h1>
        <p>Pantau milestone perkembangan si kecil dengan KPSP sesuai Pedoman Kemenkes RI 2021.</p>
    </div>

    <div class="age-tabs-wrapper">
        <div class="age-tabs" id="ageTabs">
            <div class="age-tab active" data-key="0-2"   onclick="switchAge('0-2', this)">0–2 Bulan</div>
            <div class="age-tab"        data-key="3-5"   onclick="switchAge('3-5', this)">3–5 Bulan</div>
            <div class="age-tab"        data-key="6-8"   onclick="switchAge('6-8', this)">6–8 Bulan</div>
            <div class="age-tab"        data-key="9-11"  onclick="switchAge('9-11', this)">9–11 Bulan</div>
            <div class="age-tab"        data-key="12-17" onclick="switchAge('12-17', this)">12–17 Bulan</div>
            <div class="age-tab"        data-key="18-23" onclick="switchAge('18-23', this)">18–23 Bulan</div>
            <div class="age-tab"        data-key="24-35" onclick="switchAge('24-35', this)">24–35 Bulan</div>
        </div>
    </div>

    <div class="kuesioner-container" id="kuesionerContainer"></div>

    <div style="margin-top: 28px; margin-bottom: 40px; text-align: center;">
        <a href="../index.php" style="color:var(--text-mid); font-size:.9rem; font-weight:600; text-decoration:none;">← Kembali ke Beranda</a>
    </div>
</div>

<script>
// Pastikan nama file gambar di dalam folder assets/img/ sudah sama persis (termasuk huruf besar/kecil & ekstensi .png/.jpeg)
const photoMap = {
    '0-2': [
        'mata bayi mengikuti wol.png',
        'Kepala bayi mengikuti wol.png',
        'bayi mengangkat sedikit kepala.png',
        'kepala 45 derajat.png',
        'bayi mengangkat tegak.png',
        'bayi telentang arah.png',
        'kontak mata dengan ibu.png',
        'bayi membalas senyuman.png',
        'bayi mengeluarkan suara ohah.png',
        'bayi tertawa ceria.png',
    ],
    '3-5': [
        'kepala bayi sampai mentok.png',
        'bayi menggengam pensil.png',
        'bayi menatap logam.png',
        'bayi meraih mainan.png',
        'bayi berguling.png',
        'bayi mengakat kepala dibantu.png',
        'bayi mengangkat kepala dan dada stabil.png',
        'duduk stabil.png',
        'bayi tersenyum ketika bermain.png',
        'bayi bersuara gembira.png',
    ],
    '6-8': [
        'bayi meraih remahan kismis.png',
        'bayi memegang 2 kubus.png',
        'bayi merayap wol.png',
        'bayi megang benda ke kiri kanan.png',
        'bayi makan sendiri.png',
        'bayi belajar duduk.png',
        'bayi dipegang dii ketiaknya.png',
        'bayi meraih mainan dari luar jangkauan.png',
        'bayi menoleh ketika dipanggil.png',
        'bayi bilang ma-ma.png',
    ],
    '9-11': [
        'bayi megang erat pensil.png',
        '9-11-2.jpeg',
        '9-11-3.jpeg',
        '9-11-4.jpeg',
        'bayi nyoba bangun terus duduk.png',
        'bayi nyoba berdiri lama.png',
        'bayi mencoba merespon.png',
        'bayi ragu mengenal orang baru.png',
        'bayi mencoba mengikuti kata.png',
        'bayi tahu kata jangan.png',
    ],
    '12-17': [
        '12-17-1.jpeg', '12-17-2.jpeg', '12-17-3.jpeg', '12-17-4.jpeg', '12-17-5.jpeg',
        '12-17-6.jpeg', 'tepuk tangan.jpeg', '12-17-8.jpeg', '12-17-9.jpeg', '12-17-10.jpeg',
    ],
    '18-23': [
        '18-23-1.jpeg', '18-23-2.jpeg', '18-23-3.jpeg', '18-23-4.jpeg', '18-23-5.jpeg',
        '18-23-6.jpeg', '18-23-7.jpeg', '18-23-8.jpeg', '18-23-9.jpeg', '18-23-10.jpeg',
    ],
    '24-35': [
        '24-35-1.jpeg', '24-35-2.jpeg', '24-35-7.jpeg', '24-35-8.jpeg', '24-35-9.jpeg',
        '24-35-5.jpeg', '24-35-6.jpeg', '24-35-3.png',  '24-35-4.jpeg', '24-35-10.jpeg',
    ]
};

const photoCaptions = {
    '0-2': [
        'Mata mengikuti golongan wool merah', 'Kepala mengikuti wool merah sampai sisi lain',
        'Bayi tengkurap mengangkat sedikit kepala', 'Kepala bayi terangkat 45°', 'Kepala bayi terangkat tegak 90°',
        'Bayi bergerak bebas telentang ke segala arah', 'Kontak mata bayi dengan ibu', 'Bayi membalas senyuman',
        'Bayi mengeluarkan suara ooh/ahh', 'Bayi tertawa ceria'
    ],
    '3-5': [
        'Kepala bayi berputar penuh', 'Bayi menggenggam benda', 'Bayi menatap benda kecil',
        'Bayi meraih mainan', 'Bayi berguling', 'Kepala bayi tegak saat ditarik duduk',
        'Bayi mengangkat dada dengan lengan', 'Bayi duduk dengan kepala stabil',
        'Bayi senyum melihat mainan', 'Bayi bersuara gembira'
    ],
    '6-8': [
        'Bayi memungut benda kecil', 'Bayi memegang dua kubus', 'Bayi mencari benda yang jatuh',
        'Bayi memindahkan mainan antar tangan', 'Bayi makan biskuit sendiri', 'Bayi duduk mandiri', 'Bayi berdiri ditopang',
        'Bayi meraih mainan favorit', 'Bayi menoleh mendengar bisikan', 'Bayi mengucapkan suku kata',
    ],
    '9-11': [
        'Bayi menggenggam pensil erat', 'Bayi mengambi benda kecil dengan ibu jari dan jari telunjuknya', 'Bayi mencari mainanannya',
        'Bayi sudah bisa merangkak', 'Bayi duduk sendiri', 'Bayi berdiri berpegangan',
        'Bermain peek-a-boo dengan ibu', 'Bayi mengenal orang baru', 'Bayi meniru kata-kata',
        'Bayi mengerti kata "jangan"'
    ],
    '12-17': [
        'Anak membenturkan dua kubus', 'Anak memasukkan kubus ke cangkir', 'Anak berjalan berpegangan',
        'Anak berdiri sendiri', 'Anak membungkuk ambil benda', 'Anak berjalan mandiri',
        'Anak bertepuk tangan', 'Anak menunjukkan keinginan', 'Anak memanggil mama/papa',
        'Anak mengucapkan kata bermakna'
    ],
    '18-23': [
        'Anak mencoret-coret kertas', 'Anak menyusun kubus', 'Anak berlari',
        'Anak membungkuk ambil benda', 'Anak berjalan mundur', 'Anak minum dari gelas sendiri',
        'Anak meniru menyapu', 'Anak menunjuk gambar', 'Anak menunjuk bagian tubuh',
        'Anak mengucapkan 7+ kata'
    ],
    '24-35': [
        'Anak menyusun 4 kubus', 'Anak dapat membuat garis lurus ke bawah', 'Anak berlari dengan baik',
        'Anak dapat berjalan naik tangga sendiri', 'Anak dapat menendang bola ke depan', 'Anak dapat melepas pakaiannya sendiri',
        'Anak dapat makan menggunakan sendok sendiri', 'Anak dapat menyebut gambar minimal 2 benda',
        'Anak mampu menggabungkan 2 kata berbeda saat berbicara', 'Anak dapat mengikuti perintah sederhana dengan benar'
    ]
};

const kpspData = {
    '0-2': {
        title: 'KPSP Bayi Umur 0–2 Bulan',
        desc: 'Bayi mulai mengangkat kepala, merespons suara, dan membalas senyuman sebagai tanda awal interaksi sosial.',
        tools: 'Gulungan wool merah',
        questions: [
            { text: 'Ambil gulungan wool merah, lalu gerakkan perlahan dari kiri ke kanan di depan wajah bayi. Apakah matanya mengikuti gerakan tersebut hingga ke tengah?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Ambil gulungan wool merah, lalu gerakkan perlahan dari kiri ke kanan di depan wajah bayi. Apakah kepala bayi mengikuti gerakan tersebut hampir sampai ke sisi yang lain?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Saat bayi tengkurap di permukaan yang datar, apakah ia bisa sedikit mengangkat kepalanya?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi tengkurap di permukaan yang datar, apakah ia bisa mengangkat kepalanya hingga membentuk sudut sekitar 45 derajat?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi tengkurap di permukaan yang datar, apakah ia bisa mengangkat kepalanya hingga tegak lurus ke atas?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi berbaring telentang, apakah kedua tangan dan kakinya bisa bergerak bebas ke segala arah?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Tanpa mengeluarkan suara apapun, saat bayi berbaring telentang, apakah ia mau menatap wajah Anda?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Saat Anda mengajak bayi bicara dan tersenyum, apakah bayi membalas senyuman Anda?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah bayi sudah bisa mengeluarkan suara selain menangis, seperti suara "ooh" atau "aah" (mengoceh)?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Apakah bayi suka tertawa terbahak-bahak meskipun tidak digelitik atau diusik?', domain: 'bicara', label: 'Bicara & Bahasa' }
        ]
    },
    '3-5': {
        title: 'KPSP Bayi Umur 3–5 Bulan',
        desc: 'Bayi mampu berbalik posisi, meraih dan memegang benda, serta mulai mengoceh dan menirukan ekspresi wajah orang di sekitarnya.',
        tools: 'Gulungan wool merah, pensil, kismis/kacang/uang logam, mainan',
        questions: [
            { text: 'Saat bayi berbaring telentang, gerakkan gulungan wool merah dari kiri ke kanan di depan matanya. Apakah kepalanya ikut berputar penuh mengikuti gerakan tersebut dari satu sisi ke sisi yang lain?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Saat bayi duduk di pangkuan Anda, sentuhkan ujung pensil ke punggung tangan atau ujung jari bayi. Apakah bayi langsung menggenggam pensil tersebut selama beberapa detik?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Saat bayi duduk di pangkuan Anda, apakah ia bisa memperhatikan atau menatap benda kecil sebesar kacang, kismis, atau uang logam?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Saat bayi duduk di pangkuan Anda, apakah ia mencoba meraih mainan yang diletakkan agak jauh, namun masih dalam jangkauan tangannya?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah bayi pernah berguling sendiri minimal 2 kali, dari posisi telentang ke tengkurap atau sebaliknya?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi berbaring telentang, pegang kedua tangannya lalu tarik perlahan ke posisi duduk. Apakah kepala bayi ikut terangkat dan tidak terkulai ke belakang?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi tengkurap di permukaan yang datar, apakah ia bisa mengangkat dadanya dengan menopang tubuhnya menggunakan kedua lengan?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Saat bayi duduk di pangkuan Anda, apakah ia bisa menegakkan kepalanya dengan stabil?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah bayi pernah tersenyum sendiri saat melihat mainan lucu, gambar, atau binatang peliharaan ketika sedang bermain sendiri?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah bayi pernah mengeluarkan suara gembira bernada tinggi atau seperti memekik (bukan menangis)?', domain: 'bicara', label: 'Bicara & Bahasa' }
        ]
    },
    '6-8': {
        title: 'KPSP Bayi Umur 6–8 Bulan',
        desc: 'Bayi mulai duduk, merangkak, memindahkan benda antar tangan, dan mulai mengeluarkan suara suku kata seperti "mamama" atau "bababa".',
        tools: 'Gulungan wool merah, 2 kubus, kismis/kacang-kacangan/potongan biskuit, mainan',
        questions: [
            { text: 'Taruh kismis di atas meja di depan bayi. Apakah bayi bisa memungut benda kecil seperti kismis, kacang, atau potongan biskuit menggunakan tangannya (meski dengan cara menggerapai)?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Taruh 2 kubus di atas meja. Apakah bayi bisa mengambil dan memegang masing-masing 1 kubus di setiap tangannya secara bersamaan?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Perlihatkan gulungan wool merah kepada bayi, lalu jatuhkan ke lantai. Apakah bayi mencoba mencarinya, misalnya dengan melihat ke bawah meja atau ke lantai?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah bayi pernah memindahkan mainan atau biskuit dari satu tangan ke tangan yang lain? Benda panjang seperti sendok atau kerincingan bertangkai tidak dihitung.', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Tanpa disangga bantal, kursi, atau dinding, apakah bayi bisa duduk sendiri selama 60 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah bayi sudah bisa memegang dan makan biskuit atau kue kering sendiri?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Jika Anda mengangkat bayi ke posisi berdiri dengan memegang ketiaknya, apakah ia bisa menopang sebagian berat badannya dengan kedua kakinya?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Letakkan mainan favorit bayi di luar jangkauannya. Apakah ia berusaha meraihnya dengan mengulurkan tangan atau condong ke arah mainan tersebut?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Saat bayi bermain sendiri dan ada orang yang diam-diam berdiri di belakangnya, apakah bayi menoleh saat mendengar suara pelan atau bisikan?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Apakah bayi sudah bisa mengucapkan 2 suku kata yang sama, seperti "ma-ma", "da-da", atau "pa-pa"?', domain: 'bicara', label: 'Bicara & Bahasa' },
        ]
    },
    '9-11': {
        title: 'KPSP Bayi Umur 9–11 Bulan',
        desc: 'Bayi belajar berdiri berpegangan, berjalan dituntun, menunjuk sesuatu, dan mulai mengucapkan 1 kata bermakna.',
        tools: '2 kubus, pensil, kismis/kacang-kacangan/potongan biskuit',
        questions: [
            { text: 'Letakkan pensil di telapak tangan bayi, lalu coba ambil kembali perlahan. Apakah bayi menggenggamnya dengan erat sehingga Anda kesulitan mengambilnya?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah bayi dapat mengambil benda kecil (seperti kismis atau potongan biskuit) menggunakan ibu jari dan jari telunjuknya, bukan dengan cara menggerapai seluruh tangan?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Sembunyikan mainan bayi di depannya (misalnya ditutup kain atau diletakkan di balik punggung Anda). Apakah bayi mencari mainan tersebut dan tidak langsung menyerah?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah bayi sudah bisa merangkak dengan menggerakkan kedua tangan dan lututnya secara bergantian untuk berpindah tempat?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah bayi sudah bisa duduk sendiri dari posisi tidur atau tengkurap tanpa dibantu?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah bayi bisa berdiri sambil berpegangan pada kursi atau meja selama minimal 30 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Jika Anda bersembunyi di balik sesuatu lalu muncul kembali secara berulang, apakah bayi terlihat menunggu atau mencari Anda?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah bayi sudah bisa membedakan Anda (ibu/pengasuh) dengan orang yang tidak ia kenal? Misalnya terlihat malu-malu atau ragu saat bertemu orang baru?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Ucapkan 2–3 kata sederhana, lalu lihat apakah bayi mencoba menirukan suara atau kata-kata tersebut (tidak perlu kata yang sempurna)?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Apakah bayi sudah mengerti arti kata "jangan" dan bereaksi saat Anda mengucapkannya?', domain: 'bicara', label: 'Bicara & Bahasa' }
        ]
    },
    '12-17': {
        title: 'KPSP Anak Umur 12–17 Bulan',
        desc: 'Anak sudah dapat berjalan sendiri, mengucapkan 1–6 kata bermakna, serta menggunakan benda sehari-hari seperti cangkir dan sisir dengan benar.',
        tools: '2 kubus, cangkir',
        questions: [
            { text: 'Berikan 2 kubus kepada anak. Apakah ia bisa mempertemukan atau membenturkan kedua kubus tersebut tanpa bantuan?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Berikan 1 kubus dan 1 cangkir kepada anak. Apakah ia bisa memasukkan kubus ke dalam cangkir sendiri?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah anak sudah bisa berjalan dengan berpegangan pada benda seperti meja atau kursi?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah anak sudah bisa berdiri sendiri tanpa berpegangan selama minimal 30 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Letakkan kubus di lantai. Tanpa berpegangan atau menyentuh lantai, apakah anak bisa membungkuk untuk mengambil kubus tersebut lalu berdiri kembali?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah anak sudah bisa berjalan melewati ruangan tanpa jatuh atau sempoyongan?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah anak sudah bisa bertepuk tangan atau melambai tanpa perlu dibantu atau dicontohkan terlebih dahulu?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah anak sudah bisa menunjukkan apa yang ia inginkan tanpa harus menangis atau merengek? Jawab "Ya" jika ia menunjuk, menarik tangan Anda, atau bersuara dengan gembira.', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah anak sudah bisa memanggil "papa" saat melihat ayahnya, atau "mama" saat melihat ibunya?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Selain "mama" dan "papa", apakah anak sudah bisa mengucapkan minimal 1 kata lain yang punya makna?', domain: 'bicara', label: 'Bicara & Bahasa' }
        ]
    },
    '18-23': {
        title: 'KPSP Anak Umur 18–23 Bulan',
        desc: 'Anak mampu berlari, menyebut 7–20 kata bermakna, mulai makan dan minum sendiri, serta meniru pekerjaan rumah tangga sederhana.',
        tools: '2 kubus, pensil, kertas, bola tenis',
        questions: [
            { text: 'Berikan anak sebuah pensil dan kertas. Apakah ia bisa mencoret-coret kertas sendiri tanpa diarahkan atau dibantu?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Berikan 2 kubus kepada anak. Apakah ia bisa menyusunnya satu di atas yang lain?', domain: 'gerak-halus', label: 'Motorik Halus' },
            { text: 'Apakah anak sudah bisa berlari tanpa terjatuh?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Letakkan kubus di lantai. Tanpa berpegangan atau menyentuh lantai, apakah anak bisa membungkuk untuk mengambil kubus tersebut lalu berdiri kembali?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah anak sudah bisa berjalan mundur minimal 5 langkah tanpa kehilangan keseimbangan?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
            { text: 'Apakah anak sudah bisa minum dari gelas atau cangkir sendiri tanpa banyak yang tumpah?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Apakah anak suka meniru kegiatan rumah tangga, seperti berpura-pura menyapu atau merapikan mainan?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
            { text: 'Tunjukkan gambar binatang atau benda kepada anak, lalu minta ia menunjuk gambar yang Anda sebutkan. Apakah anak bisa menunjuk minimal 1 gambar dengan benar?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Tanpa diarahkan atau dibantu, apakah anak bisa menunjuk bagian tubuhnya sendiri dengan benar (seperti rambut, mata, hidung, atau mulut)?', domain: 'bicara', label: 'Bicara & Bahasa' },
            { text: 'Apakah anak sudah bisa mengucapkan minimal 7 kata yang bermakna (selain "mama" dan "papa")?', domain: 'bicara', label: 'Bicara & Bahasa' }
        ]
    },
    '24-35': {
        title: 'KPSP Anak Umur 24–35 Bulan',
        desc: 'Anak sudah dapat berlari, menendang bola, dan naik tangga sendiri. Mampu membuat garis lurus dan menyusun kubus. Bicara menggunakan kalimat 2–4 kata, menyebut nama benda, serta mengikuti perintah. Mulai mandiri dalam makan dan melepas pakaian sendiri.',
        tools: '4 kubus, pensil, kertas, bola',
        questions: [
            { text: 'Berikan 4 kubus di depan anak. Dapatkah anak menyusun 4 kubus menyerupai kereta api dengan cerobong asap sesuai contoh yang diberikan?', domain: 'gerak-halus', label: 'Motorik Halus'},
            { text: 'Buat garis lurus ke bawah (±2,5 cm), lalu minta anak menggambar garis lain di sampingnya. Dapatkah anak menggambar garis lurus vertikal (bukan miring atau melingkar)?', domain: 'gerak-halus', label: 'Motorik Halus'},
            { text: 'Apakah anak dapat berlari tanpa terjatuh?', domain: 'gerak-kasar', label: 'Motorik Kasar'},
            { text: 'Apakah anak dapat berjalan naik tangga sendiri? (Jawab Ya jika naik dengan posisi tegak atau berpegangan pada dinding/pegangan tangga.)', domain: 'gerak-kasar', label: 'Motorik Kasar'},
            { text: 'Letakkan bola di depan kaki anak. Apakah ia dapat menendang bola ke depan tanpa berpegangan pada apapun?', domain: 'gerak-kasar', label: 'Motorik Kasar'},
            { text: 'Apakah anak dapat melepas pakaiannya sendiri seperti baju, rok, atau celana?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian'},
            { text: 'Apakah anak dapat makan menggunakan sendok sendiri tanpa banyak yang tumpah?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian'},
            { text: 'Tunjukkan gambar atau benda berikut satu per satu: kucing, mobil, sendok. Dapatkah anak menyebut nama minimal 2 benda atau gambar tersebut dengan benar?', domain: 'bicara', label: 'Bicara & Bahasa'},
            { text: 'Apakah anak mampu menggabungkan 2 kata berbeda saat berbicara, misalnya "Minum susu" atau "Main bola"? ("Terima kasih" dan "Da-dah" tidak dihitung.)', domain: 'bicara', label: 'Bicara & Bahasa'},
            { text: 'Berikan perintah satu per satu tanpa isyarat: "Ambil kertas", "Ambil pensil", "Tutup pintu". Dapatkah anak melaksanakan ketiga perintah tersebut?', domain: 'bicara', label: 'Bicara & Bahasa'}
        ]
    }
};

const state = {};
Object.keys(kpspData).forEach(k => { state[k] = {}; });
let currentKey = '0-2';

function sk(key) { return key.replace(/-/g, '_'); }

function getDomainCounts(key) {
    const s = state[key];
    const qs = kpspData[key].questions;
    const domains = { 'gerak-kasar': {ya:0,total:0}, 'gerak-halus': {ya:0,total:0}, 'bicara': {ya:0,total:0}, 'sosialisasi': {ya:0,total:0} };
    qs.forEach((q, i) => {
        domains[q.domain].total++;
        if (s[i] === 'ya') domains[q.domain].ya++;
    });
    return domains;
}

function domainLabel(d) {
    return { 'gerak-kasar':'Motorik Kasar','gerak-halus':'Motorik Halus','bicara':'Bicara & Bahasa','sosialisasi':'Sosialisasi & Kemandirian' }[d] || d;
}

function renderAll() {
    const container = document.getElementById('kuesionerContainer');
    container.innerHTML = '';
    Object.keys(kpspData).forEach(key => {
        const panel = document.createElement('div');
        panel.id = `panel-${sk(key)}`;
        panel.className = 'kuesioner-panel' + (key === currentKey ? ' active' : '');
        panel.innerHTML = buildPanel(key);
        container.appendChild(panel);
    });
}

function buildPanel(key) {
    const d = kpspData[key], s = sk(key), total = d.questions.length;
    const photos = photoMap[key];
    const captions = photoCaptions[key];

    // GAMBAR DIPANGGIL DARI FOLDER ../assets/img/
    const qs = d.questions.map((q, i) => `
    <div class="question-card" id="qcard-${s}-${i}">
      <div class="q-photo loading" id="qphoto-${s}-${i}">
        <img
          src="../assets/img/${photos[i]}"
          alt="${captions[i]}"
          loading="lazy"
          onload="this.parentElement.classList.remove('loading')"
          onerror="this.parentElement.style.background='#e8f4f6'; this.style.display='none'"
        />
        <div class="q-photo-overlay">
          <div class="qnum">${i + 1}</div>
          <span class="domain-tag ${q.domain}">${q.label}</span>
        </div>
        <div class="q-photo-caption">${captions[i]}</div>
      </div>
      <div class="q-main">
        <div class="question-text">${q.text}</div>
        <div class="answer-buttons">
          <button class="ans-btn ya"    onclick="answer('${key}',${i},'ya')">✅ Ya</button>
          <button class="ans-btn tidak" onclick="answer('${key}',${i},'tidak')">❌ Tidak</button>
        </div>
      </div>
    </div>`).join('');

    return `
    <div class="kuesioner-header">
      <div class="header-info"><h3>${d.title}</h3><p>${d.desc}</p></div>
    </div>
    <div class="tools-box">
      <div class="ti">🧰</div>
      <div><strong>Alat yang dibutuhkan</strong>${d.tools}</div>
    </div>
    <div class="tip-box">
      💡 <strong>Petunjuk:</strong> Jawab setiap pertanyaan berdasarkan kemampuan si kecil sehari-hari.
      Pilih <strong>Ya</strong> bila pernah, kadang, atau sering melakukan.
      Pilih <strong>Tidak</strong> bila belum pernah atau tidak bisa.
    </div>
    <div class="progress-label">
      <span id="plbl-${s}">0 / ${total} pertanyaan dijawab</span>
      <span id="ppct-${s}">0%</span>
    </div>
    <div class="progress-bar-wrap"><div class="progress-bar" id="pbar-${s}"></div></div>
    ${qs}
    <button class="btn-submit" id="bsub-${s}" onclick="submitResult('${key}')" disabled>🔍 Lihat Hasil Penilaian</button>
    <div class="result-box" id="res-${s}"></div>`;
}

function answer(key, idx, val) {
    const s = sk(key);
    state[key][idx] = val;
    const card = document.getElementById(`qcard-${s}-${idx}`);
    card.className = 'question-card answered-' + val;
    const btns = card.querySelectorAll('.ans-btn');
    btns[0].classList.toggle('selected', val === 'ya');
    btns[1].classList.toggle('selected', val === 'tidak');
    const answered = Object.keys(state[key]).length;
    const total = kpspData[key].questions.length;
    const pct = Math.round(answered / total * 100);
    document.getElementById(`pbar-${s}`).style.width = pct + '%';
    document.getElementById(`plbl-${s}`).textContent = `${answered} / ${total} pertanyaan dijawab`;
    document.getElementById(`ppct-${s}`).textContent = pct + '%';
    document.getElementById(`bsub-${s}`).disabled = answered < total;
}

function submitResult(key) {
    const s = sk(key);
    const yaCount = Object.values(state[key]).filter(v => v === 'ya').length;
    const total = kpspData[key].questions.length;
    const domains = getDomainCounts(key);

    const domainHTML = Object.entries(domains).map(([d, v]) => {
        const pct = v.total > 0 ? Math.round(v.ya / v.total * 100) : 0;
        return `<div class="domain-item ${d}">
            <div class="d-name">${domainLabel(d)}</div>
            <div style="font-size:11px;color:#888;margin-bottom:4px;">${v.ya}/${v.total} kemampuan tercapai</div>
            <div class="d-bar-wrap"><div class="d-bar" style="width:${pct}%"></div></div>
        </div>`;
    }).join('');

    const tidakItems = kpspData[key].questions
        .map((q, i) => state[key][i] === 'tidak' ? `<li>${q.label}: ${q.text.split('.')[0]}.</li>` : null)
        .filter(Boolean).join('');

    let cls, emoji, title, alertClass, alertMsg, interp, saran, catatan;

    if (yaCount >= 9) {
        cls = 'sesuai'; emoji = '🌟';
        title = 'Perkembangan Sesuai Usianya';
        alertClass = 'green';
        alertMsg = `✅ Skor si kecil <strong>${yaCount} dari ${total}</strong> — Perkembangan si kecil <strong>sesuai</strong> dengan usianya.`;
        interp = `Berdasarkan KPSP (Kuesioner Pra Skrining Perkembangan) dari Kemenkes RI, skor 9–10 berarti anak berkembang <strong>normal sesuai usianya</strong>. Ini artinya kemampuan motorik, bicara, dan sosial si kecil sudah sesuai dengan yang diharapkan di tahap usianya.`;
        saran = `<ul>
            <li>Teruskan stimulasi harian seperti bernyanyi, bermain, dan mengajak bicara.</li>
            <li>Jadwalkan pemeriksaan KPSP berikutnya sesuai usia si kecil (tiap 3 bulan hingga usia 2 tahun).</li>
            <li>Pastikan gizi si kecil tetap terpenuhi karena tumbuh kembang sangat dipengaruhi nutrisi.</li>
        </ul>`;
        catatan = null;
    } else if (yaCount >= 7) {
        cls = 'meragukan'; emoji = '🤔';
        title = 'Perlu Perhatian Lebih (Hasil Meragukan)';
        alertClass = 'yellow';
        alertMsg = `⚠️ Skor si kecil <strong>${yaCount} dari ${total}</strong> — Ada beberapa kemampuan yang <strong>belum terlihat</strong> dan perlu distimulasi lebih.`;
        interp = `Skor 7–8 dalam KPSP disebut <strong>"meragukan"</strong>, artinya: <em>belum dapat dipastikan apakah ada keterlambatan atau tidak</em>.`;
        saran = `<ul>
            <li>Lihat aspek yang nilainya "Tidak" di bawah, fokuskan stimulasi di sana.</li>
            <li><strong>Lakukan evaluasi ulang setelah 2 minggu</strong> dengan mengisi KPSP ini kembali.</li>
            <li>Jika setelah 2 minggu skor masih 7 atau 8, segera bawa si kecil ke <strong>posyandu, puskesmas, atau dokter anak</strong>.</li>
            <li>Ajak bicara, bermain, dan gerak aktif setiap hari.</li>
        </ul>`;
        catatan = `💬 <strong>Catatan untuk Kader Posyandu:</strong> Catat hasil ini dan pantau kembali perkembangan anak dalam 2 minggu. Bila tidak ada perubahan, rujuk ke tenaga kesehatan.`;
    } else {
        cls = 'penyimpangan'; emoji = '⚠️';
        title = 'Kemungkinan Ada Keterlambatan Perkembangan';
        alertClass = 'red';
        alertMsg = `🚨 Skor si kecil <strong>${yaCount} dari ${total}</strong> — Terdeteksi <strong>kemungkinan keterlambatan</strong> perkembangan yang perlu segera diperiksa lebih lanjut.`;
        interp = `Skor di bawah 7 dalam KPSP disebut <strong>"penyimpangan perkembangan"</strong>. Ini merupakan <em>tanda peringatan dini (red flag)</em> yang tidak boleh diabaikan.`;
        saran = `<ul>
            <li><strong>Segera bawa si kecil ke dokter anak atau puskesmas terdekat</strong> untuk pemeriksaan lebih lanjut.</li>
            <li>Dokter akan melakukan pemeriksaan fisik, neurologis, dan wawancara mendalam.</li>
            <li>Jangan tunda — semakin dini ditangani, semakin baik hasilnya.</li>
            <li>Tetap berikan stimulasi harian sambil menunggu jadwal pemeriksaan.</li>
        </ul>`;
        catatan = `💬 <strong>Catatan untuk Kader Posyandu:</strong> Hasil ini harus segera dirujuk ke tenaga kesehatan untuk pemeriksaan anamnesis, fisik, dan neurologis. Catat temuan ini di buku KIA anak.`;
    }

    const box = document.getElementById(`res-${s}`);
    box.className = `result-box ${cls}`;
    box.style.display = 'block';
    box.innerHTML = `
    <div class="result-header">
        <div class="result-emoji">${emoji}</div>
        <div class="result-title">${title}</div>
        <span class="result-score-badge">Skor Ya: ${yaCount} / ${total} pertanyaan</span>
    </div>
    <div class="result-body">
        <div class="alert-banner ${alertClass}">${alertMsg}</div>
        <div class="result-section">
            <div class="result-section-title">📋 Apa Artinya Skor Ini?</div>
            <div class="result-section-content">${interp}</div>
        </div>
        <div class="result-section">
            <div class="result-section-title">📊 Rincian per Aspek Perkembangan</div>
            <div class="domain-breakdown">${domainHTML}</div>
        </div>
        ${tidakItems ? `<div class="result-section">
            <div class="result-section-title">📝 Kemampuan yang Belum Terlihat</div>
            <div class="result-section-content"><ul>${tidakItems}</ul></div>
        </div>` : ''}
        <div class="result-section">
            <div class="result-section-title">💡 Langkah Selanjutnya untuk Bunda</div>
            <div class="result-section-content">${saran}</div>
        </div>
        ${catatan ? `<div class="alert-banner yellow" style="margin-top:4px;">${catatan}</div>` : ''}
        <div class="result-actions"><button class="btn-reset" onclick="resetQuiz('${key}')">🔄 Ulangi Kuesioner</button></div>
    </div>`;

    box.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function resetQuiz(key) {
    state[key] = {};
    document.getElementById(`panel-${sk(key)}`).innerHTML = buildPanel(key);
}

function switchAge(key, tabEl) {
    currentKey = key;
    document.querySelectorAll('.age-tab').forEach(t => t.classList.remove('active'));
    tabEl.classList.add('active');
    document.querySelectorAll('.kuesioner-panel').forEach(p => p.classList.remove('active'));
    const t = document.getElementById(`panel-${sk(key)}`);
    if (t) t.classList.add('active');
    tabEl.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
}

renderAll();
</script>

<?php include '../layout/footer.php'; ?>