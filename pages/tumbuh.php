<?php
$pageTitle = 'Resep MPASI';
$basePath  = '../';
include '../layout/header.php';
?>

<style>
    /* ── HERO ── */
    .mpasi-hero {
        background: var(--sand);
        padding: 28px 40px;
        border-bottom: 3px solid var(--sand-dark);
    }

    .mpasi-hero h2 {
        font-family: 'Nunito', sans-serif;
        font-size: 24px;
        font-weight: 900;
        margin-bottom: 10px;
        text-align: center;
    }

    .mpasi-hero p {
        font-size: 14px;
        color: var(--text-light);
        max-width: 820px;
        line-height: 1.75;
        text-align: center;
        margin: 0 auto;
    }

    /* ── AGE TABS ── */
    .age-tabs-wrapper {
        background: white;
        border-bottom: 2px solid #eee;
        position: sticky;
        top: 0;
        z-index: 90;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
    }

    .age-tabs {
        display: flex;
        justify-content: center;
        overflow-x: auto;
        scrollbar-width: none;
        padding: 0;
    }

    .age-tabs::-webkit-scrollbar {
        display: none;
    }

    .age-tab {
        flex: 1;
        min-width: 0;
        max-width: 200px;
        padding: 15px 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 800;
        color: var(--text-light);
        cursor: pointer;
        border: none;
        background: transparent;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        white-space: nowrap;
        text-align: center;
    }

    .age-tab:hover {
        color: var(--teal);
    }

    .age-tab.active {
        color: var(--teal-dark);
        border-bottom-color: var(--teal);
        background: var(--teal-light);
    }

    /* ── MAIN CONTAINER ── */
    .mpasi-container {
        max-width: 980px;
        margin: 0 auto;
        padding: 28px 20px 60px;
    }

    /* ── PANEL ── */
    .mpasi-panel {
        display: none;
    }

    .mpasi-panel.active {
        display: block;
        animation: fadeSlide 0.32s ease;
    }

    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* ── PAGE SUB-HEADER (per panel) ── */
    .mpasi-panel-header {
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
        border-radius: var(--radius);
        padding: 20px 24px;
        margin-bottom: 16px;
        color: white;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .mpasi-panel-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255,255,255,0.07);
        border-radius: 50%;
    }

    .age-badge {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        border-radius: 50px;
        padding: 4px 16px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: 0.3px;
    }

    .mpasi-panel-header h3 {
        font-family: 'Nunito', sans-serif;
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .mpasi-panel-header p {
        font-size: 13px;
        opacity: 0.9;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ── INFO ROW ── */
    .info-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 24px;
    }

    .info-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        border-left: 4px solid var(--teal);
    }

    .info-card:nth-child(2) { border-left-color: var(--accent); }
    .info-card:nth-child(3) { border-left-color: var(--green); }

    .info-icon { font-size: 22px; flex-shrink: 0; }

    .info-card h4 {
        font-size: 11px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 3px;
    }

    .info-card p {
        font-size: 13px;
        color: var(--text);
        font-weight: 600;
        line-height: 1.5;
    }

    /* ── SECTION TITLE ── */
    .section-title {
        font-family: 'Nunito', sans-serif;
        font-size: 18px;
        font-weight: 800;
        color: var(--teal-dark);
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: var(--teal-mid);
        border-radius: 2px;
    }

    /* ── RECIPE GRID ── */
    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 36px;
    }

    .recipe-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.22s, box-shadow 0.22s;
    }

    .recipe-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(74, 155, 168, 0.18);
    }

    .recipe-card-img-wrap {
        overflow: hidden;
        position: relative;
        height: 170px;
        background: var(--teal-light);
    }

    .recipe-card-img-wrap::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 48px;
        background: linear-gradient(to top, rgba(255,255,255,0.55), transparent);
        pointer-events: none;
    }

    .recipe-card-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .recipe-card:hover .recipe-card-img {
        transform: scale(1.05);
    }

    .recipe-card-emoji-placeholder {
        width: 100%;
        height: 170px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 64px;
        background: linear-gradient(135deg, var(--teal-light) 0%, var(--sand) 100%);
    }

    .recipe-card-header {
        padding: 12px 16px 10px;
    }

    .recipe-card-title {
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 800;
        color: var(--teal-dark);
        line-height: 1.35;
        margin-bottom: 6px;
    }

    .recipe-meta {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .recipe-tag {
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 50px;
        background: var(--teal-light);
        color: var(--teal-dark);
    }

    .recipe-card-body {
        padding: 10px 16px 16px;
    }

    .recipe-nutrients {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }

    .nutrient {
        flex: 1;
        text-align: center;
        background: var(--teal-light);
        border-radius: 10px;
        padding: 8px 4px;
    }

    .nutrient .val {
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 900;
        color: var(--teal-dark);
        display: block;
    }

    .nutrient .lbl {
        font-size: 10px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
    }

    .recipe-portions {
        font-size: 12px;
        color: var(--text-light);
        font-weight: 600;
        margin-bottom: 12px;
    }

    .btn-detail {
        width: 100%;
        background: var(--teal);
        color: #fff;
        border: none;
        border-radius: 50px;
        padding: 10px;
        font-family: 'Quicksand', sans-serif;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        transition: background 0.2s;
    }

    .btn-detail:hover {
        background: var(--teal-dark);
    }

    /* ── MODAL ── */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.45);
        z-index: 200;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.25s;
        backdrop-filter: blur(3px);
    }

    .modal-overlay.show {
        opacity: 1;
        pointer-events: all;
    }

    .modal {
        background: #fff;
        border-radius: 24px;
        max-width: 680px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        transform: translateY(30px) scale(0.97);
        transition: transform 0.25s;
        box-shadow: 0 20px 60px rgba(0,0,0,0.2);
    }

    .modal-overlay.show .modal {
        transform: translateY(0) scale(1);
    }

    .modal-header {
        position: relative;
        border-radius: 24px 24px 0 0;
        overflow: hidden;
    }

    .modal-header-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        filter: brightness(0.75);
    }

    .modal-header-emoji {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
    }

    .modal-header-content {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 16px 24px 20px;
        background: linear-gradient(to top, rgba(58,125,136,0.95) 0%, transparent 100%);
        color: #fff;
    }

    .modal-close {
        position: absolute;
        top: 12px; right: 12px;
        background: rgba(0,0,0,0.35);
        border: none;
        color: #fff;
        width: 32px; height: 32px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        z-index: 2;
    }

    .modal-close:hover { background: rgba(0,0,0,0.55); }

    .modal-header-content h2 {
        font-family: 'Nunito', sans-serif;
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 4px;
        text-shadow: 0 1px 4px rgba(0,0,0,0.4);
    }

    .modal-header-content p {
        font-size: 13px;
        opacity: 0.9;
        text-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }

    .modal-body {
        padding: 24px;
    }

    .modal-nutrients {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
    }

    .modal-nutrient {
        flex: 1;
        text-align: center;
        background: var(--teal-light);
        border-radius: 14px;
        padding: 14px 8px;
    }

    .modal-nutrient .val {
        font-family: 'Nunito', sans-serif;
        font-size: 20px;
        font-weight: 900;
        color: var(--teal-dark);
        display: block;
    }

    .modal-nutrient .lbl {
        font-size: 11px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
    }

    .modal-nutrient:nth-child(2) { background: #fff3e0; }
    .modal-nutrient:nth-child(2) .val { color: #e65100; }
    .modal-nutrient:nth-child(3) { background: #fce4ec; }
    .modal-nutrient:nth-child(3) .val { color: #c2185b; }

    .modal-section { margin-bottom: 20px; }

    .modal-section h3 {
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 800;
        color: var(--teal-dark);
        background: var(--teal-light);
        padding: 8px 14px;
        border-radius: 8px;
        margin-bottom: 10px;
        border-left: 3px solid var(--teal);
    }

    .ingredient-list { list-style: none; }

    .ingredient-list li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        padding: 6px 8px;
        border-radius: 8px;
        font-size: 13px;
        line-height: 1.5;
        transition: background 0.15s;
    }

    .ingredient-list li:hover { background: var(--teal-light); }

    .ingredient-list li::before {
        content: '•';
        color: var(--teal);
        font-weight: 900;
        flex-shrink: 0;
        margin-top: 1px;
    }

    .step-list {
        list-style: none;
        counter-reset: step;
    }

    .step-list li {
        display: flex;
        gap: 12px;
        padding: 10px 8px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.6;
        transition: background 0.15s;
    }

    .step-list li:hover { background: var(--teal-light); }

    .step-num {
        background: var(--teal);
        color: #fff;
        width: 24px; height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 800;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .tips-box {
        background: #fff8e1;
        border: 1px solid #ffe082;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 13px;
        color: #5d4037;
        line-height: 1.6;
        display: flex;
        gap: 10px;
        margin-bottom: 4px;
    }

    .tips-box .tip-icon { font-size: 20px; flex-shrink: 0; }

    .modal::-webkit-scrollbar { width: 6px; }
    .modal::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .modal::-webkit-scrollbar-thumb { background: var(--teal-mid); border-radius: 10px; }

    @media (max-width: 640px) {
        .info-row { grid-template-columns: 1fr; }
        .recipe-grid { grid-template-columns: 1fr 1fr; }
        .mpasi-hero { padding: 20px 16px; }
        .mpasi-container { padding: 14px 10px 50px; }
        .age-tab { font-size: 12px; padding: 12px 6px; }
        .modal-nutrients { flex-wrap: wrap; }
    }

    @media (max-width: 420px) {
        .recipe-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- HERO -->
<div class="mpasi-hero">
    <h2>Resep MPASI Si Kecil 🍼</h2>
    <p>
        <strong>MPASI (Makanan Pendamping ASI)</strong> adalah makanan tambahan yang diberikan mulai usia 6 bulan
        untuk melengkapi kebutuhan nutrisi bayi. Pilih resep sesuai usia dan kebutuhan si kecil.
        Setiap resep telah disesuaikan dengan <strong>tekstur, porsi, dan kandungan gizi</strong>
        berdasarkan panduan WHO dan Kemenkes RI.
    </p>
</div>

<!-- AGE TABS -->
<div class="age-tabs-wrapper">
    <div class="age-tabs" id="ageTabs">
        <button class="age-tab active" onclick="switchAge('6-8', this)">6–8 Bulan</button>
        <button class="age-tab" onclick="switchAge('9-11', this)">9–11 Bulan</button>
        <button class="age-tab" onclick="switchAge('12-23', this)">12–23 Bulan</button>
    </div>
</div>

<!-- MAIN CONTAINER -->
<div class="mpasi-container" id="mpasiContainer"></div>

<!-- MODAL -->
<div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
    <div class="modal" id="modalBox">
        <div class="modal-header">
            <div id="mHeaderMedia"></div>
            <button class="modal-close" onclick="closeModalDirect()">✕</button>
            <div class="modal-header-content">
                <h2 id="mTitle"></h2>
                <p id="mSubtitle"></p>
            </div>
        </div>
        <div class="modal-body">
            <div class="modal-nutrients">
                <div class="modal-nutrient"><span class="val" id="mKkal"></span><span class="lbl">Energi</span></div>
                <div class="modal-nutrient"><span class="val" id="mProtein"></span><span class="lbl">Protein</span></div>
                <div class="modal-nutrient"><span class="val" id="mLemak"></span><span class="lbl">Lemak</span></div>
            </div>
            <div class="tips-box">
                <span class="tip-icon">💡</span>
                <span id="mTipsText"></span>
            </div>
            <br>
            <div class="modal-section">
                <h3>🛒 Bahan-bahan</h3>
                <ul class="ingredient-list" id="mBahan"></ul>
            </div>
            <div class="modal-section" id="mBumbuSection">
                <h3>🌿 Bumbu</h3>
                <ul class="ingredient-list" id="mBumbu"></ul>
            </div>
            <div class="modal-section">
                <h3>👩‍🍳 Cara Membuat</h3>
                <ol class="step-list" id="mSteps"></ol>
            </div>
            <div class="modal-section">
                <h3>🍊 Buah Pelengkap</h3>
                <ul class="ingredient-list" id="mBuah"></ul>
            </div>
        </div>
    </div>
</div>

<script>
    const ageData = {
        '6-8': {
            badge: '6–8 Bulan',
            title: 'Resep MPASI 6–8 Bulan',
            desc: 'Tekstur bubur kental & makanan lumat. Disaring atau diblender hingga halus. ASI tetap menjadi sumber utama nutrisi (70%).',
            infoTextur: 'Bubur kental, makanan lumat, disaring halus',
            infoFrekuensi: '2–3x/hari menu utama + 1–2x selingan',
            infoPorsi: 'Mulai 2–3 sdm, tingkatkan hingga ½ mangkok (125 ml)',
            recipes: [
                {
                    img: 'bubur-ikan.jpeg',
                    title: 'Bubur Singkong Isi Ikan & Ayam',
                    tags: ['Karbohidrat', 'Protein Ganda'],
                    kkal: '91 kkal', protein: '3.1 gr', lemak: '3.5 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['75 gr singkong putih, rebus dan haluskan', '15 gr (2 sdm) daging ikan kembung cincang halus', '15 gr daging ayam cincang rebus', '250 ml air kaldu ayam', '5 gr (1 sdt) minyak kelapa', '20 gr (2 sdm) bayam segar, potong halus'],
                    bumbu: ['1 lembar daun salam', '1 batang sereh', '1 siung bawang merah (dihaluskan)', '1 siung bawang putih (dihaluskan)'],
                    steps: ['Tumis bumbu halus, lalu masukkan daun salam dan sereh.', 'Tambahkan air kaldu, masukkan singkong putih, daging ikan, daging ayam cincang rebus, aduk-aduk hingga setengah matang.', 'Masukkan daun bayam, aduk hingga matang. Jika airnya mengental dapat ditambahkan air matang.', 'Angkat, lalu saring halus atau diblender.'],
                    buah: ['100 gr (3 buah kecil) jeruk manis – diambil sarinya'],
                    tips: 'Kontribusi energi sebesar 45% dari kebutuhan makanan tambahan sehari. Pastikan singkong dimasak hingga benar-benar lunak sebelum dihaluskan.'
                },
                {
                    img: 'bubur-ayam.jpg',
                    title: 'Bubur Soto Ayam Santan',
                    tags: ['Soto', 'Kuah Kuning'],
                    kkal: '96 kkal', protein: '4.6 gr', lemak: '4.1 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['60 gr (6 sdm) Nasi putih', '45 gr (4.5 sdm) Daging ayam cincang', '30 gr (1 buah kecil) Tahu', '30 gr (3 sdm) Labu siam', '15 gr (1.5 sdm) Wortel', '5 gr (1 sdm) Minyak goreng', '30 ml (3 sdm) Santan', '300 ml Air kaldu ayam', '1 lembar Salam, 1 batang Sereh, 1 lembar Daun jeruk'],
                    bumbu: ['1 siung bawang merah', '1 siung bawang putih', '1 cm Kunyit', '1 cm Jahe'],
                    steps: ['Tumis bumbu halus sampai harum, masukan ayam cincang sampai berubah warna.', 'Masukan air kaldu ayam, santan, salam, sereh dan daun jeruk masak sampai mendidih.', 'Masukan nasi, tahu dan labu siam dan wortel yang sudah diiris kecil-kecil masak sampai semua bahan matang dan empuk.', 'Haluskan sampai tekstur yang diinginkan. Sajikan selagi hangat.'],
                    buah: ['100 gr (3 buah kecil) Jeruk – diambil sarinya'],
                    tips: 'Kontribusi energi 48% dari kebutuhan sehari. Warna kunyit memberikan warna kuning menarik yang disukai bayi.'
                },
                {
                    img: 'Bubur-Sup-Telur.jpg',
                    title: 'Bubur Sup Telur Daging Kacang Merah',
                    tags: ['Protein Tinggi', 'Serat'],
                    kkal: '98 kkal', protein: '45.1 gr', lemak: '3.6 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['50 gr (6 sdm) nasi', '30 gr (3 sdm) daging ayam cincang', '25 gr (½ butir) telur ayam', '10 gr (1 sdm) buncis', '10 gr (1 sdm) wortel', '10 gr (1 sdm) kacang merah', '10 gr (1 batang) bawang daun', '1 batang seledri', '300 ml kaldu ayam', '2.5 gr (½ sdt) minyak untuk menumis'],
                    bumbu: ['2 siung bawang merah', '2 siung bawang putih'],
                    steps: ['Didihkan air kaldu ayam, masukkan kacang merah dan masak sampai empuk.', 'Tumis bumbu halus sampai harum, masukkan daging ayam cincang, masak sampai berubah warna.', 'Masukan tumisan daging ayam kedalam air kaldu masak sampai daging empuk.', 'Masukkan nasi, buncis, dan wortel.', 'Tambahkan kocokan telur, aduk merata dan masak sampai matang.', 'Haluskan bubur sampai tekstur yang diinginkan, lalu sajikan.'],
                    buah: ['100 gr (2 buah) jeruk – diambil sarinya'],
                    tips: 'Kacang merah kaya zat besi dan serat yang baik untuk pencernaan bayi. Pastikan sudah benar-benar empuk sebelum dihaluskan.'
                },
                {
                    img: 'Bubur-Kanju.jpg',
                    title: 'Bubur Kanju Rumbi Ayam dan Udang',
                    tags: ['Rempah Khas', 'Protein Ganda'],
                    kkal: '87 kkal', protein: '5.1 gr', lemak: '2.9 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['60 gr (6 sdm) Nasi putih', '30 gr (3 sdm) daging ayam bagian dada', '20 gr udang segar', '15 gr wortel', '15 gr jagung pipil', '15 ml santan', '350 ml kaldu ayam', '2 lembar daun pandan'],
                    bumbu: ['1 siung bawang merah & putih', '½ buah kapulaga', '1 gr ketumbar', '1 cm kayumanis', '1 buah cengkeh', '¼ sdt merica', '¼ sdt jintan campur adas', '¼ buah pekak', 'Seujung jari buah pala'],
                    steps: ['Cuci bersih daging ayam, rebus sampai setengah matang, potong dadu.', 'Cuci dan bersihkan udang, buang kepala, rebus hingga berubah warna, buang kulit, potong 2–3 bagian.', 'Tumis bumbu halus, masukkan daun pandan. Tambahkan air kaldu, masak nasi hingga lembek menyerupai bubur.', 'Tambahkan potongan ayam, udang, wortel dan jagung, masak sambil sesekali diaduk.', 'Matikan api, saring sesuai tekstur yang diinginkan. Sajikan.'],
                    buah: ['50 gr (6 potong kecil) Pepaya'],
                    tips: 'Kontribusi energi 45% dari kebutuhan sehari. Rempah-rempah khas Nusantara memberikan aroma yang memperkenalkan cita rasa lokal pada bayi.'
                },
                {
                    img: 'Puding-Kentang.jpg',
                    title: 'Puding Kentang Ayam dan Telur',
                    tags: ['Kukus', 'Puding Bayi'],
                    kkal: '95 kkal', protein: '4.0 gr', lemak: '3.6 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['100 gr kentang, dikukus dan dihaluskan', '30 gr (3 sdm) daging ayam cincang', '10 gr (1 butir) telur puyuh', '15 gr (1 buah) tahu kecil, potong dadu kecil', '15 gr (1.5 sdm) wortel parut', '10 gr (1 sdm) labu kuning', '15 ml santan', '1 batang sereh, 1 lembar daun salam', '1 sdm minyak, 50 ml air kaldu ayam'],
                    bumbu: ['2 siung bawang merah', '2 siung bawang putih'],
                    steps: ['Tumis bumbu halus sampai harum, tambahkan daun salam dan sereh.', 'Masukkan ayam cincang masak sampai berubah warna, lalu masukan kentang, labu kuning, tahu dan wortel aduk sampai merata.', 'Tambahkan santan dan air kaldu aduk merata, matikan api.', 'Kocok telur lepas, campurkan pada tumisan. Siapkan wadah tahan panas diolesi minyak, masukkan adonan dan kukus ±20 menit.', 'Sajikan selagi hangat.'],
                    buah: ['100 gr (2 buah) jeruk – diambil sarinya'],
                    tips: 'Kontribusi energi 47.5% dari kebutuhan sehari. Puding ini memiliki tekstur lembut yang mudah ditelan bayi dan kaya nutrisi.'
                }
            ]
        },
        '9-11': {
            badge: '9–11 Bulan',
            title: 'Resep MPASI 9–11 Bulan',
            desc: 'Makanan dicincang halus dan makanan yang dapat dipegang bayi. ASI dan MP-ASI memenuhi kebutuhan masing-masing 50%.',
            infoTextur: 'Dicincang halus, dipotong kecil, atau diiris-iris',
            infoFrekuensi: '3–4x/hari menu utama + 1–2x selingan',
            infoPorsi: '½ – ¾ mangkok ukuran 250 ml (125–200 ml)',
            recipes: [
                {
                    img: 'Nasi-Tim-Tuna.jpg',
                    title: 'Nasi Tim Ikan Tuna Telur Puyuh',
                    tags: ['Tim', 'Omega-3'],
                    kkal: '120 kkal', protein: '4.6 gr', lemak: '4.3 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['115 gr (12 sdm) nasi putih', '30 gr (1 potong kecil) ikan tuna segar, haluskan', '30 gr (3 butir) telur puyuh', '15 gr (1 potong besar) wortel', '10 gr (1 buah sedang) tomat', '7.5 gr (1.5 sdt) minyak kelapa', '75 cc (⅓ gelas belimbing) kaldu ayam', '50 gr (½ potong) pepaya, haluskan untuk saus'],
                    bumbu: [],
                    steps: ['Masukkan nasi, ikan tuna, telur puyuh, minyak kelapa ke dalam mangkok tim.', 'Tambahkan air kaldu.', 'Masukkan wortel dan tomat, tim hingga matang.', 'Angkat, sajikan dengan saus papaya.'],
                    buah: ['180 gr (1 potong besar) semangka'],
                    tips: 'Kontribusi energi 40% dari kebutuhan sehari. Ikan tuna kaya omega-3 yang baik untuk perkembangan otak bayi.'
                },
                {
                    img: 'Nasi-tim-lele.jpg',
                    title: 'Nasi Tim Ayam Lele Cincang',
                    tags: ['Tim', 'Ikan Air Tawar'],
                    kkal: '125 kkal', protein: '4.5 gr', lemak: '4.9 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['100 gr (10 sdm) nasi putih', '30 gr (3 sdm) daging ayam cincang', '10 gr (1 sdm) daging ikan lele', '10 gr (1 sdm) wortel', '5 ml (1 sdt) minyak goreng', '10 ml (1 sdm) santan kental', '1.5 sdm bawang bombay iris halus', '200 ml kaldu ayam'],
                    bumbu: [],
                    steps: ['Masukkan nasi, daging ayam cincang, ikan lele, bawang bombay, minyak dan santan ke dalam mangkok tim.', 'Tambahkan air kaldu.', 'Masukkan wortel, masak hingga lunak dan matang.', 'Angkat dan sajikan.'],
                    buah: ['180 gr (1 potong besar) semangka'],
                    tips: 'Kontribusi energi 41% dari kebutuhan sehari. Ikan lele merupakan sumber protein hewani yang terjangkau dan mudah ditemukan.'
                },
                {
                    img: 'Mie-Kukus.jpg',
                    title: 'Mie Kukus Telur Puyuh',
                    tags: ['Kukus', 'Finger Food'],
                    kkal: '135 kkal', protein: '5.1 gr', lemak: '7.6 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['85 gr (3 bungkus) mie instan batita atau mie keriting', '60 gr (6 butir) telur puyuh', '50 gr (5 sdm) wortel parut', '50 gr (5 sdm) keju parut', '10 gr (1 batang) bawang daun iris', 'Minyak untuk menggoreng', 'Bumbu mie instan batita secukupnya', '300 ml air'],
                    bumbu: [],
                    steps: ['Didihkan air 300 ml, masukkan mie instan sampai lunak dan matang.', 'Tambahkan wortel parut, bawang daun, keju parut, dan bumbu mie instan batita secukupnya, aduk sampai merata.', 'Masukkan 1 sdm adonan mie ke dalam wadah tahan panas yang diolesi minyak dan masukan telur puyuh rebus.', 'Kukus selama 15 menit.', 'Setelah matang boleh langsung dikonsumsi atau digoreng sampai kuning keemasan.'],
                    buah: ['150 gr (6 potong kecil) Pepaya'],
                    tips: 'Kontribusi energi 45% dari kebutuhan sehari. Bentuk yang bisa dipegang membantu melatih motorik halus bayi.'
                },
                {
                    img: 'Nasi-Tim-Ikan-Telur-Sayuran.jpg',
                    title: 'Nasi Tim Ikan Telur Sayuran',
                    tags: ['Tim', 'Sayuran Hijau'],
                    kkal: '117 kkal', protein: '4.8 gr', lemak: '4.5 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['100 gr (10 sdm) nasi putih', '30 gr (3 butir) telur puyuh, kocok', '30 gr (3 sdm) ikan kembung fillet', '10 gr (1 sdm) sawi hijau, iris', '20 gr (2 sdm) tomat, cincang', '300 ml kaldu ayam', '7.5 ml (1.5 sdt) minyak kelapa'],
                    bumbu: [],
                    steps: ['Masak kaldu, nasi, minyak kelapa, dan ikan kembung hingga lunak dan menjadi bubur.', 'Masukkan sawi hijau dan tomat.', 'Masukkan telur puyuh yang sudah dikocok, aduk perlahan hingga rata dan matang.', 'Angkat dan sajikan.'],
                    buah: ['180 gr buah semangka'],
                    tips: 'Kontribusi energi 39% dari kebutuhan sehari. Sawi hijau kaya vitamin C dan zat besi yang baik untuk imunitas bayi.'
                },
                {
                    img: 'Tim-Bubur-Manado-Daging-dan-Udang.jpg',
                    title: 'Tim Bubur Manado Daging dan Udang',
                    tags: ['Bubur Manado', 'Protein Ganda'],
                    kkal: '119 kkal', protein: '6.4 gr', lemak: '4.4 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['50 gr (5 sdm) nasi putih', '40 gr (4 sdm) labu kuning, potong dadu', '40 gr (4 sdm) daging sapi cincang', '30 gr (3 ekor) udang kupas', '20 gr (2 sdm) jagung pipil', '10 gr (1 sdm) bayam', '5 ml (1 sdt) minyak goreng', 'Garam secukupnya', '10 gr daun bawang diiris', '100 cc kaldu daging'],
                    bumbu: ['1 siung bawang merah', '1 siung bawang putih'],
                    steps: ['Tumis bumbu halus sampai harum.', 'Masukkan daging sapi dan udang, tumis hingga berubah warna, lalu tambahkan air kaldu, masak sampai mendidih.', 'Masukkan nasi, labu kuning, jagung dan bayam.', 'Masukkan daun bawang yang sudah diiris, masak hingga menyusut.', 'Tambahkan garam secukupnya, koreksi rasa. Sajikan.'],
                    buah: ['180 gr (1 potong) buah naga'],
                    tips: 'Kontribusi energi 39.7% dari kebutuhan sehari. Labu kuning kaya beta-karoten yang baik untuk penglihatan bayi.'
                }
            ]
        },
        '12-23': {
            badge: '12–23 Bulan',
            title: 'Resep MPASI 12–23 Bulan',
            desc: 'Makanan keluarga yang diiris-iris jika diperlukan. Kebutuhan MP-ASI meningkat menjadi 70% dengan kalori +550 per hari.',
            infoTextur: 'Makanan keluarga, diiris-iris jika diperlukan',
            infoFrekuensi: '3–4x/hari menu utama + 1–2x selingan',
            infoPorsi: '¾ – 1 mangkok ukuran 250 ml per makan',
            recipes: [
                {
                    img: 'Nasi-Sup-Telur.jpg',
                    title: 'Nasi Sup Telur Puyuh Bola Tahu Ayam',
                    tags: ['Sup', 'Finger Food'],
                    kkal: '260 kkal', protein: '10.4 gr', lemak: '10.7 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['150 gr (15 sdm) nasi putih', '45 gr tahu putih', '60 gr (±5 sdm) daging ayam cincang', '60 gr (6 butir) telur puyuh rebus', '30 gr (3 sdm) wortel', '30 gr (3 sdm) jagung pipil kuning', '30 gr (3 sdm) brokoli', '15 gr tepung tapioka', '10 gr bawang goreng', 'Air, garam, gula, merica secukupnya'],
                    bumbu: ['2 siung bawang merah', '2 siung bawang putih'],
                    steps: ['Rebus air sampai mendidih. Campurkan tahu, daging ayam cincang, bumbu halus, garam, gula, merica, dan tapioka, uleni hingga bisa dibentuk.', 'Ambil adonan 1 sendok teh, bentuk bulat dan masukkan ke air mendidih.', 'Setelah bola-bola mengapung, masukan wortel dan jagung, tunggu sejenak lalu masukan brokoli dan telur puyuh.', 'Masukan garam, gula, merica, bawang daun dan seledri. Koreksi rasa.', 'Sajikan dengan nasi dan taburan bawang goreng.'],
                    buah: ['135 gr (3 potong) Melon'],
                    tips: 'Kontribusi energi 47.2% dari kebutuhan sehari. Bola tahu ayam yang kenyal menjadi finger food yang disukai anak.'
                },
                {
                    img: 'Nasi-Soto-Ayam.jpg',
                    title: 'Nasi Soto Ayam Kuah Kuning',
                    tags: ['Soto', 'Kuah Kuning'],
                    kkal: '263 kkal', protein: '9.5 gr', lemak: '10.9 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['150 gr (15 sdm) nasi', '100 gr (2 potong) ayam dengan tulang', '10 gr (1 sdm) soun', '60 gr (6 butir) telur puyuh', '30 gr (3 sdm) toge', '10 gr (1 sdm) minyak goreng', '1500 ml air untuk merebus', 'Garam, gula, merica secukupnya'],
                    bumbu: ['1 butir kemiri', '1 siung bawang merah & putih', '½ cm jahe & kunyit', '1.4 sdt jinten', '½ sdt ketumbar', '1 lembar daun salam, 1 batang serai, 1 lembar daun jeruk, ½ cm lengkuas'],
                    steps: ['Rebus ayam hingga setengah matang, tambahkan serai geprek, daun salam, daun jeruk, dan lengkuas.', 'Tumis bumbu yang dihaluskan hingga harum dan matang, lalu masukkan ke dalam rebusan ayam.', 'Tambahkan garam, gula dan merica. Masak hingga ayam matang dan empuk. Koreksi rasa.', 'Daging ayam diangkat dan disuir-suir.', 'Siapkan mangkuk berikan soun yang sudah direndam, toge, suiran daging ayam, dan telur puyuh rebus.', 'Tambahkan kuah soto, taburkan daun bawang, seledri, dan bawang goreng. Sajikan dengan nasi.'],
                    buah: ['(Buah sesuai selera)'],
                    tips: 'Kontribusi energi 47.8% dari kebutuhan sehari. Soto ayam kuah kuning kaya rempah yang baik untuk imunitas anak.'
                },
                {
                    img: 'Sup-Telur-Puyuh.jpg',
                    title: 'Sup Telur Puyuh Ikan Air Tawar Labu Kuning',
                    tags: ['Sup', 'Ikan Air Tawar'],
                    kkal: '261 kkal', protein: '13.6 gr', lemak: '9.1 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['150 gr (15 sdm) nasi putih', '70 gr (7 sdm) kentang, potong dadu', '50 gr (5 sdm) labu kuning, potong dadu', '120 gr (12 sdm) ikan nila kukus, disuwir', '60 gr (6 butir) telur puyuh rebus', '15 gr (3 sdt) kacang merah', '45 gr (4.5 sdm) tomat, potong dadu', '10 gr bawang daun', '5 gr bawang merah goreng', '5 gr bawang putih goreng', '150 ml kaldu ayam'],
                    bumbu: [],
                    steps: ['Rebus kaldu ayam hingga mendidih, masukkan kentang, kacang merah, dan labu kuning hingga setengah matang.', 'Masukkan suwiran ikan nila kukus, bawang merah goreng dan bawang putih goreng, masak hingga matang.', 'Tambahkan tomat, bawang daun, bawang goreng, dan telur puyuh, aduk perlahan.', 'Tambahkan garam, gula dan merica secukupnya dan aduk rata.', 'Angkat dan sajikan dengan buah.'],
                    buah: ['150 gr (6 potong) pepaya'],
                    tips: 'Kontribusi energi 47.5% dari kebutuhan sehari. Ikan nila kaya protein dan mudah dicerna oleh anak.'
                },
                {
                    img: 'Nasi-Ikan-Kuah-Kuning.jpg',
                    title: 'Nasi Ikan Kuah Kuning',
                    tags: ['Kuah Kuning', 'Ikan Kembung'],
                    kkal: '267 kkal', protein: '28.5 gr', lemak: '10.7 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['150 gr (15 sdm) nasi', '360 gr (3 ekor) ikan kembung', '75 gr labu siam', '75 gr tempe', '60 gr (1 buah besar) tomat', '15 ml minyak goreng', '35 ml santan', '750 ml air', '2 buah jeruk nipis'],
                    bumbu: ['5 siung bawang merah', '3 siung bawang putih', '3 buah kemiri', '2 cm jahe', '2 cm kunyit', '2 lembar daun salam, 1 batang sereh, 2 cm laos'],
                    steps: ['Bersihkan ikan, lumuri garam dan jeruk nipis 10 menit, bilas. Lumuri lagi 5 menit.', 'Panaskan minyak, goreng ikan kembung sampai matang, sisihkan.', 'Tumis bumbu halus, tambahkan sereh, salam dan laos, tunggu sampai mendidih.', 'Masukkan labu siam dan tempe, masak sampai matang.', 'Tambahkan santan, masukkan ikan goreng.', 'Tambahkan garam, gula, tomat, koreksi rasa. Sajikan dengan nasi.'],
                    buah: ['270 gr semangka'],
                    tips: 'Kontribusi energi 48.5% dari kebutuhan sehari. Ikan kembung kaya omega-3 dan kunyit memiliki sifat anti-inflamasi yang baik.'
                },
                {
                    img: 'Nugget-Tempe-Ayam-Sayuran.jpg',
                    title: 'Nugget Tempe Ayam Sayuran',
                    tags: ['Nugget', 'Finger Food', 'Tempe'],
                    kkal: '191 kkal', protein: '10.5 gr', lemak: '9.0 gr',
                    porsi: 'Resep untuk 3 porsi',
                    bahan: ['200 gr tempe dipotong kotak kecil, kukus', '100 gr daging ayam cincang, haluskan', '100 gr (2 butir) telur ayam, kocok', '50 gr (5 sdm) wortel', '50 gr (5 sdm) keju parut', '10 gr bawang daun iris halus', '10 gr bawang goreng halus', '10 gr bawang putih halus', '20 gr (2 sdm) tepung terigu', '20 gr (2 sdm) tepung tapioka'],
                    bumbu: ['Bahan pelapis: 30 gr tepung terigu, 100 ml air, 100 gr tepung panir'],
                    steps: ['Campurkan tempe, ayam cincang, wortel, keju, bawang daun, tepung terigu, tapioka, telur, bawang goreng. Aduk rata.', 'Olesi loyang dengan minyak, masukkan adonan dan ratakan. Kukus 30 menit.', 'Setelah dingin potong sesuai ukuran yang diinginkan.', 'Cairkan terigu dengan air. Celupkan nugget ke tepung basah, gulingkan ke tepung panir.', 'Simpan di kulkas 30 menit. Goreng di minyak panas sampai kuning keemasan.', 'Sajikan selagi hangat.'],
                    buah: ['270 gr buah semangka'],
                    tips: 'Kontribusi energi 34.7% dari kebutuhan sehari. Nugget tempe ayam bisa disimpan di freezer untuk stok hingga 2 minggu.'
                }
            ]
        }
    };

    let currentAge = '6-8';

    function buildPanel(ageKey) {
        const d = ageData[ageKey];
        return `
            <div class="mpasi-panel-header">
                <div class="age-badge">${d.badge}</div>
                <h3>${d.title}</h3>
                <p>${d.desc}</p>
            </div>
            <div class="info-row">
                <div class="info-card">
                    <span class="info-icon">🍼</span>
                    <div><h4>Tekstur</h4><p>${d.infoTextur}</p></div>
                </div>
                <div class="info-card">
                    <span class="info-icon">🕐</span>
                    <div><h4>Frekuensi</h4><p>${d.infoFrekuensi}</p></div>
                </div>
                <div class="info-card">
                    <span class="info-icon">🥣</span>
                    <div><h4>Porsi Per Makan</h4><p>${d.infoPorsi}</p></div>
                </div>
            </div>
            <div class="section-title">🍳 Pilihan Resep</div>
            <div class="recipe-grid" id="grid-${ageKey.replace('-','_')}"></div>
        `;
    }

    function renderAll() {
        const container = document.getElementById('mpasiContainer');
        container.innerHTML = '';
        Object.keys(ageData).forEach(key => {
            const panel = document.createElement('div');
            panel.id = `panel-${key.replace('-','_')}`;
            panel.className = 'mpasi-panel' + (key === currentAge ? ' active' : '');
            panel.innerHTML = buildPanel(key);
            container.appendChild(panel);
            renderRecipes(key);
        });
    }

    function renderRecipes(ageKey) {
        const gridId = `grid-${ageKey.replace('-','_')}`;
        const grid = document.getElementById(gridId);
        if (!grid) return;
        const recipes = ageData[ageKey].recipes;
        grid.innerHTML = '';
        recipes.forEach((r, i) => {
            const card = document.createElement('div');
            card.className = 'recipe-card';
            card.style.animationDelay = (i * 0.07) + 's';

            let mediaHTML = r.img
                ? `<div class="recipe-card-img-wrap">
                        <img class="recipe-card-img" src="${r.img}" alt="${r.title}"
                             onerror="this.parentElement.innerHTML='<div class=\\'recipe-card-emoji-placeholder\\'>🍽️</div>'">
                   </div>`
                : `<div class="recipe-card-img-wrap"><div class="recipe-card-emoji-placeholder">🍽️</div></div>`;

            card.innerHTML = `
                ${mediaHTML}
                <div class="recipe-card-header">
                    <div class="recipe-card-title">${r.title}</div>
                    <div class="recipe-meta">${r.tags.map(t => `<span class="recipe-tag">${t}</span>`).join('')}</div>
                </div>
                <div class="recipe-card-body">
                    <div class="recipe-nutrients">
                        <div class="nutrient"><span class="val">${r.kkal}</span><span class="lbl">Energi</span></div>
                        <div class="nutrient"><span class="val">${r.protein}</span><span class="lbl">Protein</span></div>
                        <div class="nutrient"><span class="val">${r.lemak}</span><span class="lbl">Lemak</span></div>
                    </div>
                    <div class="recipe-portions">📦 ${r.porsi}</div>
                    <button class="btn-detail" onclick="openModal('${ageKey}', ${i})">Lihat Resep Lengkap →</button>
                </div>
            `;
            grid.appendChild(card);
        });
    }

    function switchAge(ageKey, tabEl) {
        currentAge = ageKey;
        document.querySelectorAll('.age-tab').forEach(t => t.classList.remove('active'));
        tabEl.classList.add('active');
        document.querySelectorAll('.mpasi-panel').forEach(p => p.classList.remove('active'));
        const panel = document.getElementById(`panel-${ageKey.replace('-','_')}`);
        if (panel) panel.classList.add('active');
        tabEl.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
    }

    function openModal(ageKey, idx) {
        const r = ageData[ageKey].recipes[idx];

        const headerMedia = document.getElementById('mHeaderMedia');
        headerMedia.innerHTML = r.img
            ? `<img class="modal-header-img" src="${r.img}" alt="${r.title}"
                    onerror="this.outerHTML='<div class=\\'modal-header-emoji\\'>🍽️</div>'">`
            : `<div class="modal-header-emoji">🍽️</div>`;

        document.getElementById('mTitle').textContent = r.title;
        document.getElementById('mSubtitle').textContent = r.porsi + ' · ' + ageData[ageKey].badge;
        document.getElementById('mKkal').textContent = r.kkal;
        document.getElementById('mProtein').textContent = r.protein;
        document.getElementById('mLemak').textContent = r.lemak;
        document.getElementById('mTipsText').textContent = r.tips;

        document.getElementById('mBahan').innerHTML = r.bahan.map(b => `<li>${b}</li>`).join('');

        const bumbuSection = document.getElementById('mBumbuSection');
        const bumbuEl = document.getElementById('mBumbu');
        if (r.bumbu && r.bumbu.length > 0) {
            bumbuSection.style.display = '';
            bumbuEl.innerHTML = r.bumbu.map(b => `<li>${b}</li>`).join('');
        } else {
            bumbuSection.style.display = 'none';
        }

        document.getElementById('mSteps').innerHTML =
            r.steps.map((s, i) => `<li><span class="step-num">${i + 1}</span><span>${s}</span></li>`).join('');

        document.getElementById('mBuah').innerHTML = r.buah.map(b => `<li>${b}</li>`).join('');

        document.getElementById('modalOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal(e) {
        if (e.target === document.getElementById('modalOverlay')) closeModalDirect();
    }

    function closeModalDirect() {
        document.getElementById('modalOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    renderAll();
</script>

<?php include '../layout/footer.php'; ?>