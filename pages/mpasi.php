<?php
$pageTitle = 'MPASI';
$basePath  = '../';
include '../layout/header.php';
?>
<div class="mpasi-page">
<style>
    :root {
        --teal: #4a9ba8;
        --teal-dark: #3a7d88;
        --teal-light: #e8f4f6;
        --teal-mid: #b2d8df;
        --sand: #f0e9d2;
        --sand-dark: #e0d5b5;
        --text: #3a3a3a;
        --text-light: #666;
        --accent: #f4a04a;
        --accent-dark: #e08830;
        --green: #5cb85c;
        --red: #d9534f;
        --yellow: #f0ad4e;
        --radius: 16px;
        --shadow: 0 4px 20px rgba(74, 155, 168, 0.15);
        --shadow-card: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Quicksand', sans-serif;
        background: #f5f7f8;
        color: var(--text);
        min-height: 100vh;
    }

    .brand-logo {
        font-family: 'Nunito', sans-serif;
        font-weight: 900;
        font-size: 26px;
        letter-spacing: -0.5px;
    }

    .brand-logo span:first-child {
        color: var(--teal-dark);
    }

    .brand-logo span:last-child {
        color: var(--accent);
    }


    .age-tabs-wrap {
        background: var(--teal-light);
        border-bottom: 3px solid var(--teal-mid);
        padding-top: 10px;
    }

    .age-tabs {
        display: flex;
        justify-content: center;
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .age-tab {
        padding: 14px 28px;
        font-family: 'Quicksand', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: var(--text-light);
        cursor: pointer;
        border: none;
        background: transparent;
        border-bottom: 3px solid transparent;
        margin-bottom: -3px;
        transition: all 0.2s;
        white-space: nowrap;
    }

    .age-tab:hover {
        color: var(--teal-dark);
    }

    .age-tab.active {
        color: var(--teal-dark);
        border-bottom: 3px solid var(--teal-dark);
        font-weight: 700;
    }

    .page-header {
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
        padding: 40px 20px 30px;
        text-align: center;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
    }

    .page-header::after {
        content: '';
        position: absolute;
        bottom: -60px;
        left: -30px;
        width: 160px;
        height: 160px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .page-header h1 {
        font-family: 'Nunito', sans-serif;
        font-size: 28px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .page-header p {
        font-size: 14px;
        opacity: 0.88;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    .age-badge {
        display: inline-block;
        background: var(--accent);
        color: #fff;
        border-radius: 50px;
        padding: 4px 16px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 12px;
        letter-spacing: 0.3px;
    }

    .main {
        max-width: 980px;
        margin: 0 auto;
        padding: 28px 20px 60px;
    }

    .info-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        margin-bottom: 28px;
    }

    .info-card {
        background: #fff;
        border-radius: var(--radius);
        padding: 18px 16px;
        box-shadow: var(--shadow-card);
        display: flex;
        align-items: flex-start;
        gap: 12px;
        border-left: 4px solid var(--teal);
        animation: fadeUp 0.4s ease both;
    }

    .info-card:nth-child(2) {
        border-left-color: var(--accent);
        animation-delay: 0.1s;
    }

    .info-card:nth-child(3) {
        border-left-color: var(--green);
        animation-delay: 0.2s;
    }

    .info-icon {
        font-size: 24px;
        flex-shrink: 0;
    }

    .info-card h3 {
        font-size: 12px;
        color: var(--text-light);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .info-card p {
        font-size: 13px;
        color: var(--text);
        font-weight: 600;
        line-height: 1.5;
    }

    .section-title {
        font-family: 'Nunito', sans-serif;
        font-size: 20px;
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

    .recipe-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 36px;
    }

    .recipe-card {
        background: #fff;
        border-radius: var(--radius);
        box-shadow: var(--shadow-card);
        overflow: hidden;
        cursor: pointer;
        transition: transform 0.22s, box-shadow 0.22s;
        animation: fadeUp 0.4s ease both;
    }

    .recipe-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 32px rgba(74, 155, 168, 0.18);
    }

    /* ── IMAGE WRAPPER ── */
    .recipe-card-img-wrap {
        overflow: hidden;
        position: relative;
        height: 170px;
        background: var(--teal-light);
    }

    .recipe-card-img-wrap::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 48px;
        background: linear-gradient(to top, rgba(255, 255, 255, 0.55), transparent);
        pointer-events: none;
    }

    /* Gambar file lokal */
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

    /* Fallback emoji jika tidak ada gambar */
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
        background: #fff;
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
        gap: 8px;
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

    .recipe-tag.protein {
        background: #fff3e0;
        color: #e65100;
    }

    .recipe-tag.energy {
        background: #f3e5f5;
        color: #7b1fa2;
    }

    .recipe-card-body {
        padding: 12px 16px 16px;
    }

    .recipe-nutrients {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
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
        font-size: 16px;
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
        background: rgba(0, 0, 0, 0.45);
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
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
    }

    .modal-overlay.show .modal {
        transform: translateY(0) scale(1);
    }

    .modal-header {
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
        padding: 0;
        color: #fff;
        border-radius: 24px 24px 0 0;
        position: relative;
        overflow: hidden;
    }

    .modal-header-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        border-radius: 24px 24px 0 0;
        filter: brightness(0.75);
    }

    /* Fallback emoji header modal */
    .modal-header-emoji {
        width: 100%;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
        border-radius: 24px 24px 0 0;
    }

    .modal-header-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 16px 24px 20px;
        background: linear-gradient(to top, rgba(58, 125, 136, 0.95) 0%, transparent 100%);
    }

    .modal-close {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(0, 0, 0, 0.35);
        border: none;
        color: #fff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        font-size: 18px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
        z-index: 2;
    }

    .modal-close:hover {
        background: rgba(0, 0, 0, 0.55);
    }

    .modal-header h2 {
        font-family: 'Nunito', sans-serif;
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 4px;
        padding-right: 10px;
        text-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    }

    .modal-header p {
        font-size: 13px;
        opacity: 0.9;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }

    .modal-body {
        padding: 24px;
    }

    .modal-nutrients {
        display: flex;
        gap: 12px;
        margin-bottom: 24px;
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
        font-size: 22px;
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

    .modal-nutrient:nth-child(2) {
        background: #fff3e0;
    }

    .modal-nutrient:nth-child(2) .val {
        color: #e65100;
    }

    .modal-nutrient:nth-child(3) {
        background: #fce4ec;
    }

    .modal-nutrient:nth-child(3) .val {
        color: #c2185b;
    }

    .modal-section {
        margin-bottom: 20px;
    }

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

    .ingredient-list {
        list-style: none;
    }

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

    .ingredient-list li:hover {
        background: var(--teal-light);
    }

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
        counter-increment: step;
        display: flex;
        gap: 12px;
        padding: 10px 8px;
        border-radius: 10px;
        font-size: 13px;
        line-height: 1.6;
        transition: background 0.15s;
    }

    .step-list li:hover {
        background: var(--teal-light);
    }

    .step-num {
        background: var(--teal);
        color: #fff;
        width: 24px;
        height: 24px;
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
    }

    .tips-box .tip-icon {
        font-size: 20px;
        flex-shrink: 0;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal::-webkit-scrollbar {
        width: 6px;
    }

    .modal::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .modal::-webkit-scrollbar-thumb {
        background: var(--teal-mid);
        border-radius: 10px;
    }

    @media (max-width: 640px) {
        .info-row {
            grid-template-columns: 1fr;
        }

        .recipe-grid {
            grid-template-columns: 1fr 1fr;
        }

        .age-tab {
            padding: 12px 14px;
            font-size: 12px;
        }

        .navbar-brand {
            min-width: 120px;
            padding: 0 16px;
        }

        .modal-nutrients {
            flex-wrap: wrap;
        }
    }

    @media (max-width: 420px) {
        .recipe-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

    <!-- AGE TABS -->
    <div class="age-tabs-wrap">
        <div class="age-tabs">
            <button class="age-tab active" onclick="switchAge('6-8')">6–8 Bulan</button>
            <button class="age-tab" onclick="switchAge('9-11')">9–11 Bulan</button>
            <button class="age-tab" onclick="switchAge('12-23')">12–23 Bulan</button>
        </div>
    </div>

    <!-- PAGE HEADER -->
    <div class="page-header">
        <span class="age-badge" id="ageBadge">6–8 Bulan</span>
        <h1 id="pageTitle">Resep MPASI 6-8 Bulan</h1>
        <p id="pageDesc">Tekstur bubur kental & makanan lumat. Disaring atau diblender hingga halus. ASI tetap menjadi
            sumber utama nutrisi (70%).</p>
    </div>

    <!-- MAIN -->
    <div class="main">
        <div class="info-row" id="infoRow">
            <div class="info-card">
                <span class="info-icon">🍼</span>
                <div>
                    <h3>Tekstur</h3>
                    <p id="infoTextur">Bubur kental, makanan lumat, disaring halus</p>
                </div>
            </div>
            <div class="info-card">
                <span class="info-icon">🕐</span>
                <div>
                    <h3>Frekuensi</h3>
                    <p id="infoFrekuensi">2-3x/hari menu utama + 1-2x selingan</p>
                </div>
            </div>
            <div class="info-card">
                <span class="info-icon">🥣</span>
                <div>
                    <h3>Porsi Per Makan</h3>
                    <p id="infoPorsi">Mulai 2-3 sdm, tingkatkan hingga ½ mangkok (125ml)</p>
                </div>
            </div>
        </div>

        <div class="section-title">🍳 Pilihan Resep</div>
        <div class="recipe-grid" id="recipeGrid"></div>
    </div>

    <!-- MODAL -->
    <div class="modal-overlay" id="modalOverlay" onclick="closeModal(event)">
        <div class="modal" id="modalBox">
            <div class="modal-header">
                <!-- Diisi dinamis oleh JS: <img> atau <div emoji> -->
                <div id="mHeaderMedia"></div>
                <button class="modal-close" onclick="closeModalDirect()">✕</button>
                <div class="modal-header-content">
                    <h2 id="mTitle"></h2>
                    <p id="mSubtitle"></p>
                </div>
            </div>
            <div class="modal-body">
                <div class="modal-nutrients">
                    <div class="modal-nutrient"><span class="val" id="mKkal"></span><span class="lbl">Energi</span>
                    </div>
                    <div class="modal-nutrient"><span class="val" id="mProtein"></span><span class="lbl">Protein</span>
                    </div>
                    <div class="modal-nutrient"><span class="val" id="mLemak"></span><span class="lbl">Lemak</span>
                    </div>
                </div>
                <div class="tips-box" id="mTips">
                    <span class="tip-icon">💡</span>
                    <span id="mTipsText"></span>
                </div>
                <br>
                <div class="modal-section" id="mBahanSection">
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
                <div class="modal-section" id="mBuahSection">
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
                title: 'Resep MPASI 6-8 Bulan',
                desc: 'Tekstur bubur kental & makanan lumat. Disaring atau diblender hingga halus. ASI tetap menjadi sumber utama nutrisi (70%).',
                infoTextur: 'Bubur kental, makanan lumat, disaring halus',
                infoFrekuensi: '2-3x/hari menu utama + 1-2x selingan',
                infoPorsi: 'Mulai 2-3 sdm, tingkatkan hingga ½ mangkok (125ml)',
                recipes: [
                    {
                        img: '../assets/img/bubur-ikan.jpeg',   // ← file lokal
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
                        img: '../assets/img/bubur-ayam.jpg',   // ← file lokal
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
                        img: '../assets/img/Bubur-Sup-Telur.jpg',   // ← file lokal
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
                        img: '../assets/img/Bubur-Kanju.jpg',   // ← file lokal
                        title: 'Bubur Kanji Rumbi Ayam dan Udang',
                        tags: ['Rempah Khas', 'Protein Ganda'],
                        kkal: '87 kkal', protein: '5.1 gr', lemak: '2.9 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['60 gr (6 sdm) Nasi putih', '30 gr (3 sdm) daging ayam bagian dada', '20 gr udang segar', '15 gr wortel', '15 gr jagung pipil', '15 ml santan', '350 ml kaldu ayam', '2 lembar daun pandan'],
                        bumbu: ['1 siung bawang merah & putih', '½ buah kapulaga', '1 gr ketumbar', '1 cm kayumanis', '1 buah cengkeh', '¼ sdt merica', '¼ sdt jintan campur adas', '¼ buah pekak', 'Seujung jari buah pala'],
                        steps: ['Cuci bersih daging ayam, rebus sampai setengah matang, potong dadu.', 'Cuci dan bersihkan udang, buang kepala, rebus hingga berubah warna, buang kulit, potong 2-3 bagian.', 'Tumis bumbu halus, masukkan daun pandan. Tambahkan air kaldu, masak nasi hingga lembek menyerupai bubur.', 'Tambahkan potongan ayam, udang, wortel dan jagung, masak sambil sesekali diaduk.', 'Matikan api, saring sesuai tekstur yang diinginkan. Sajikan.'],
                        buah: ['50 gr (6 potong kecil) Pepaya'],
                        tips: 'Kontribusi energi 45% dari kebutuhan sehari. Rempah-rempah khas Nusantara memberikan aroma yang memperkenalkan cita rasa lokal pada bayi.'
                    },
                    {
                        img: '../assets/img/Puding-Kentang.jpg',   // ← file lokal
                        title: 'Puding Kentang Ayam dan Telur',
                        tags: ['Kukus', 'Puding Bayi'],
                        kkal: '95 kkal', protein: '4.0 gr', lemak: '3.6 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['100 gr kentang, dikukus dan dihaluskan', '30 gr (3 sdm) daging ayam cincang', '10 gr (1 butir) telur puyuh', '15 gr (1 buah) tahu kecil, potong dadu kecil', '15 gr (1.5 sdm) wortel parut', '10 gr (1 sdm) labu kuning', '15 ml santan', '1 batang sereh, 1 lembar daun salam', '1 sdm minyak, 50 ml air kaldu ayam'],
                        bumbu: ['2 siung bawang merah', '2 siung bawang putih'],
                        steps: ['Tumis bumbu halus sampai harum, tambahkan daun salam dan sereh.', 'Masukkan ayam cincang masak sampai berubah warna, lalu masukan kentang, labu kuning, tahu dan wortel aduk sampai merata.', 'Tambahkan santan dan air kaldu aduk merata, matikan api.', 'Kocok telur lepas, campurkan pada tumisan. Siapkan wadah tahan panas diolesi minyak, masukkan adonan dan kukus ±20 menit.', 'Sajikan selagi hangat.'],
                        buah: ['100 gr (2 buah) jeruk – diambil sarinya'],
                        tips: 'Kontribusi energi 47.5% dari kebutuhan sehari. Puding ini memiliki tekstur lembut yang mudah ditelan bayi dan kaya nutrisi.'
                    },
                    {
                        img: '../assets/img/Roti-Kukus-Kacang.jpg',
                        title: 'Roti Kukus Kacang',
                        tags: ['Roti', 'Camilan Sehat'],
                        kkal: '76.2 kkal', protein: '2.5 gr', lemak: '2.6 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['6 lembar Roti Tawar', '3 sdt Selai Kacang'],
                        bumbu: [],
                        steps: ['Oles roti tawar dengan selai kacang.', 'Kukus selama 10 menit hingga roti lembut.', 'Roti Kukus Kacang siap untuk disajikan.'],
                        buah: ['90 gr pisang ambon - lumat halus'],
                        tips: 'Kandungan Karbohidrat Total: 11.1 g, Gula: 3.3 g, Natrium: 82.6 mg, Kalsium: 21.5 mg, Zat Besi: 0.6 mg. Memberikan variasi tekstur roti kukus lembut yang kaya protein nabati dari selai kacang.'
                    },
                    {
                        img: '../assets/img/Bubur-Jagung-Muda-Hati-Ayam.jpg',
                        title: 'Bubur Jagung Muda Hati Ayam',
                        tags: ['Hati Ayam', 'Santan Cair'],
                        kkal: '98.3 kkal', protein: '4.9 gr', lemak: '4.1 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['6 sdm nasi', '1 buah hati ayam segar, cincang halus', '1 potong tempe murni, potong kecil', '1.5 batang jagung muda / baby corn', '6 sdm santan cair murni', '2 gelas belimbing air matang'],
                        bumbu: ['1 siung bawang merah iris tipis', '1 siung bawang putih iris tipis', '1 lembar daun salam', '1 lembar daun jeruk', '1 irisan kecil lengkuas, geprek'],
                        steps: ['Nyalakan kompor, masukkan air matang ke dalam panci.', 'Masukkan nasi, hati ayam, jagung muda/baby corn, daun salam, daun jeruk, lengkuas.', 'Aduk, tunggu sampai mendidih.', 'Masukkan santan, aduk hingga merata, tunggu sampai matang.', 'Saring sesuaikan tekstur yang kental, lalu sajikan.'],
                        buah: ['100 gr puree buah naga'],
                        tips: 'Kandungan Karbohidrat: 10.7 g, Zat Besi (Fe): 1.9 mg, Vitamin A: 495.7 mcg. Hati ayam sangat bagus untuk mendongkrak cadangan zat besi bayi.'
                    },
                    {
                        img: '../assets/img/Barongko.jpg',
                        title: 'Barongko',
                        tags: ['Kue Tradisional', 'Pisang'],
                        kkal: '57.1 kkal', protein: '2.2 gr', lemak: '2.7 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['6 sdm pisang kepok halus', '3 sdm santan kental', '1 butir telur ayam ras (kocok lepas)'],
                        bumbu: [],
                        steps: ['Kocok telur, lalu campur dengan pisang halus dan santan.', 'Masukkan ke dalam wadah tahan panas.', 'Kukus 10-20 menit, lalu sajikan.'],
                        buah: ['80 gr alpukat - lumat halus'],
                        tips: 'Kandungan Karbohidrat: 6.1 g, Zat Besi (Fe): 0.6 mg, Vitamin A: 9.2 mcg. Barongko memiliki tekstur yang sangat lembut alami, ramah bagi pencernaan bayi.'
                    },
                    {
                        img: '../assets/img/Kentang-Tumbuk-Keju.jpg',
                        title: 'Kentang Tumbuk Keju',
                        tags: ['Kentang', 'Keju & Susu'],
                        kkal: '95.3 kkal', protein: '3.6 gr', lemak: '6.6 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['150 gr Kentang', '45 gr Keju parut', '225 ml Susu formula/ASI/UHT cair', '1.5 sdm Mentega'],
                        bumbu: [],
                        steps: ['Kukus kentang hingga matang.', 'Tambahkan mentega.', 'Tumbuk hingga halus.', 'Masak susu cair dengan keju hingga keju meleleh seluruhnya.', 'Kentang tumbuk keju siap untuk disajikan.'],
                        buah: ['100 gr melon - diambil sarinya'],
                        tips: 'Kandungan Karbohidrat Total: 6.1 g, Gula: 2.3 g, Natrium: 63.5 mg, Vitamin A: 203 IU, Vitamin C: 2.2 mg, Kalsium: 99.8 mg, Zinc: 0.5 mg. Kombinasi gurih keju dan mentega tinggi kalori/lemak esensial.'
                    }
                ]
            },
            '9-11': {
                badge: '9–11 Bulan',
                title: 'Resep MPASI 9-11 Bulan',
                desc: 'Makanan dicincang halus dan makanan yang dapat dipegang bayi. ASI dan MP-ASI memenuhi kebutuhan masing-masing 50%.',
                infoTextur: 'Dicincang halus, dipotong kecil, atau diiris-iris',
                infoFrekuensi: '3-4x/hari menu utama + 1-2x selingan',
                infoPorsi: '½ – ¾ mangkok ukuran 250 ml (125–200 ml)',
                recipes: [
                    {
                        img: '../assets/img/Nasi-Tim-Tuna.jpg',
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
                        img: '../assets/img/Nasi-tim-lele.jpg',   // ← file lokal
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
                        img: '../assets/img/Mie-Kukus.jpg',   // ← file lokal
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
                        img: '../assets/img/Nasi-Tim-Ikan-Telur-Sayuran.jpg',   // ← file lokal
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
                        img: '../assets/img/Tim-Bubur-Manado-Daging-dan-Udang.jpg',   // ← file lokal
                        title: 'Tim Bubur Manado Daging dan Udang',
                        tags: ['Bubur Manado', 'Protein Ganda'],
                        kkal: '119 kkal', protein: '6.4 gr', lemak: '4.4 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['50 gr (5 sdm) nasi putih', '40 gr (4 sdm) labu kuning, potong dadu', '40 gr (4 sdm) daging sapi cincang', '30 gr (3 ekor) udang kupas', '20 gr (2 sdm) jagung pipil', '10 gr (1 sdm) bayam', '5 ml (1 sdt) minyak goreng', 'Garam secukupnya', '10 gr daun bawang diiris', '100 cc kaldu daging'],
                        bumbu: ['1 siung bawang merah', '1 siung bawang putih'],
                        steps: ['Tumis bumbu halus sampai harum.', 'Masukkan daging sapi dan udang, tumis hingga berubah warna, lalu tambahkan air kaldu, masak sampai mendidih.', 'Masukkan nasi, labu kuning, jagung dan bayam.', 'Masukkan daun bawang yang sudah diiris, masak hingga menyusut.', 'Tambahkan garam secukupnya, koreksi rasa. Sajikan.'],
                        buah: ['180 gr (1 potong) buah naga'],
                        tips: 'Kontribusi energi 39.7% dari kebutuhan sehari. Labu kuning kaya beta-karoten yang baik untuk penglihatan bayi.'
                    },
                    {
                        img: '../assets/img/Krim-Kentang-Ikan-Kembung.jpg',
                        title: 'Krim Kentang Ikan Kembung',
                        tags: ['Ikan Kembung', 'Krim Lembut'],
                        kkal: '157 kkal', protein: '8.8 gr', lemak: '10.5 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['225 gr Daging Ikan Kembung', '60 gr Keju Parut', '3 sdm Mentega', '300 gr Kentang', '90 gr Tahu putih', '225 ml Susu UHT/Formula'],
                        bumbu: [],
                        steps: ['Rebus ikan kembung selama 15 Menit.', 'Campurkan semua bahan dalam satu wadah tahan panas.', 'Kukus selama 15 Menit atau hingga matang.', 'Aduk hingga tercampur rata.', 'Krim Kentang Ikan Kembung siap disajikan.'],
                        buah: ['120 gr buah pisang - potong dadu'],
                        tips: 'Kandungan Karbohidrat Total: 7.4 g, Gula: 1.9 g, Natrium: 68.6 mg, Kalsium: 120 mg, Zat Besi: 0.9 mg, Zinc: 0.7 mg. Tekstur kental krimi berpadu asam lemak esensial laut lokal.'
                    },
                    {
                        img: '../assets/img/Stick-Kentang-Keju.jpg',
                        title: 'Stick Kentang Keju',
                        tags: ['Finger Food', 'Camilan Bayi'],
                        kkal: '121 kkal', protein: '4.0 gr', lemak: '9.5 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['3 buah Kentang ukuran sedang', '75 gram Keju cheddar parut', '12 sdm Tepung Maizena', '3 butir Telur ayam', 'Daun Seledri Secukupnya (iris halus)'],
                        bumbu: [],
                        steps: ['Potong dadu kentang, kemudian rebus hingga matang.', 'Setelah itu, lumatkan kentang sampai halus dan lembut.', 'Tambahkan keju parut dan tepung maizena.', 'Kemudian masukkan daun seledri dan telur ayam.', 'Aduk semua adonan hingga kalis dan lembut.', 'Bentuk adonan memanjang dan goreng di minyak baru hingga kecokelatan.', 'Stick kentang keju siap dihidangkan untuk si kecil.'],
                        buah: ['150 gr mangga - potong dadu'],
                        tips: 'Kandungan Karbohidrat Total: 5.8 g, Gula: 2.3 g, Natrium: 87.8 mg, Kalsium: 100 mg, Zat Besi: 0.6 mg, Zinc: 0.6 mg. Sangat cocok melatih koordinasi tangan-mulut bayi.'
                    },
                    {
                        img: '../assets/img/Ayam-Telur-Kukus.jpg',
                        title: 'Ayam Telur Kukus',
                        tags: ['Kukus Tradisional', 'Protein Tinggi'],
                        kkal: '290 kkal', protein: '15.0 gr', lemak: '19.0 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['300 gr dada ayam fillet', '3 butir telur ayam ras', '15 sdm santan kental murni', '3 buah tahu putih', '1.5 buah wortel parut', '9 lembar daun salam', 'Daun pisang secukupnya untuk membungkus'],
                        bumbu: ['6 buah bawang merah', '3 buah bawang putih', '3 buah kemiri', '3 cm kunyit', '3 cm jahe'],
                        steps: ['Ulek semua bumbu halus.', 'Potong kecil-kecil ayam fillet kemudian cincang halus dengan pisau, campurkan dengan tahu hancur, telur, santan, dan bumbu halus.', 'Campur adonan ayam dengan wortel parut dan aduk merata.', 'Siapkan selembar daun pisang yang di beri selembar daun salam di atasnya.', 'Tuangkan 2 sdm adonan ayam, gulung daun pisang dan lipat di kedua ujungnya yang terbuka.', 'Lakukan hingga adonan habis, kemudian kukus ± 20 menit dengan api kecil sampai matang, lalu sajikan dengan dicincang kasar.'],
                        buah: ['120 gr buah pepaya - potong dadu'],
                        tips: 'Kandungan Karbohidrat: 20.5 g. Menu padat protein ganda dan lemak sehat yang efektif menambah berat badan anak.'
                    },
                    {
                        img: '../assets/img/Telur-Orak-Arik-Bayam-Tahu.jpg',
                        title: 'Telur Orak-Arik Bayam Tahu',
                        tags: ['Tumis Cepat', 'Bahan Ekonomis'],
                        kkal: '180 kkal', protein: '12.0 gr', lemak: '8.0 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['3 butir telur ayam', '1.5 potong tahu putih (haluskan)', '3 genggam daun bayam segar (cincang kasar)', 'Unsalted butter / minyak zaitun / minyak kelapa baru untuk menumis'],
                        bumbu: ['Sedikit garam halus (opsional sesuai batas usia)'],
                        steps: ['Tumis bayam cincang dengan sedikit butter/minyak hingga layu.', 'Tambahkan tahu putih yang sudah dihaluskan, aduk rata.', 'Masukkan kocokan telur, orak-arik bersama tahu bayam hingga matang sempurna.', 'Sajikan mendampingi nasi tim lembut hangat anak.'],
                        buah: ['150 gr melon - potong dadu'],
                        tips: 'Menu kilat kaya nutrisi esensial zat besi dari bayam serta protein padat murni hewani-nabati.'
                    }
                ]
            },
            '12-23': {
                badge: '12–23 Bulan',
                title: 'Resep MPASI 12-23 Bulan',
                desc: 'Makanan keluarga yang diiris-iris jika diperlukan. Kebutuhan MP-ASI meningkat menjadi 70% dengan kalori +550 per hari.',
                infoTextur: 'Makanan keluarga, diiris-iris jika diperlukan',
                infoFrekuensi: '3-4x/hari menu utama + 1-2x selingan',
                infoPorsi: '¾ – 1 mangkok ukuran 250 ml per makan',
                recipes: [
                    {
                        img: '../assets/img/Nasi-Sup-Telur.jpg',
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
                        img: '../assets/img/Nasi-Soto-Ayam.jpg',
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
                        img: '../assets/img/Sup-Telur-Puyuh.jpg',
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
                        img: '../assets/img/Nasi-Ikan-Kuah-Kuning.jpg',
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
                        img: '../assets/img/Nugget-Tempe-Ayam-Sayuran.jpg',
                        title: 'Nugget Tempe Ayam Sayuran',
                        tags: ['Nugget', 'Finger Food', 'Tempe'],
                        kkal: '191 kkal', protein: '10.5 gr', lemak: '9.0 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: ['200 gr tempe dipotong kotak kecil, kukus', '100 gr daging ayam cincang, haluskan', '100 gr (2 butir) telur ayam, kocok', '50 gr (5 sdm) wortel', '50 gr (5 sdm) keju parut', '10 gr bawang daun iris halus', '10 gr bawang goreng halus', '10 gr bawang putih halus', '20 gr (2 sdm) tepung terigu', '20 gr (2 sdm) tepung tapioka'],
                        bumbu: ['Bahan pelapis: 30 gr tepung terigu, 100 ml air, 100 gr tepung panir'],
                        steps: ['Campurkan tempe, ayam cincang, wortel, keju, bawang daun, tepung terigu, tapioka, telur, bawang goreng. Aduk rata.', 'Olesi loyang dengan minyak, masukkan adonan dan ratakan. Kukus 30 menit.', 'Setelah dingin potong sesuai ukuran yang diinginkan.', 'Cairkan terigu dengan air. Celupkan nugget ke tepung basah, gulingkan ke tepung panir.', 'Simpan di kulkas 30 menit. Goreng di minyak panas sampai kuning keemasan.', 'Sajikan selagi hangat.'],
                        buah: ['270 gr buah semangka'],
                        tips: 'Kontribusi energi 34.7% dari kebutuhan sehari. Nugget tempe ayam bisa disimpan di freezer untuk stok hingga 2 minggu.'
                    },
                    {
                        img: '../assets/img/Kentang-Tuna-Saus-Bayam.jpg',
                        title: 'Kentang Tuna Saus Bayam',
                        tags: ['Saus Creamy', 'Omega-3'],
                        kkal: '215 kkal', protein: '12.4 gr', lemak: '11.8 gr',
                        porsi: 'Resep untuk 1 porsi',
                        bahan: [
                            '35 gr daging ikan tuna (kukus/panggang, haluskan dengan garpu)',
                            '40 gr kentang (kupas, kukus, haluskan dengan garpu)',
                            '2 sdm daun bayam (kukus, iris halus)',
                            '100 ml susu cair'
                        ],
                        bumbu: ['1/2 sdm tepung maizena',
                            '1 sdm mentega tawar',
                            '1 iris bawang bombay (cincang halus)'
                        ],
                        steps: [
                            'Masukkan ikan tuna halus dan kentang lumat ke dalam mangkuk saji, sisihkan.',
                            'Panaskan mentega di wajan, tumis bawang bombay hingga harum.',
                            'Masukkan tepung maizena sambil terus diaduk cepat.',
                            'Tuangkan susu cair perlahan, aduk terus di atas api kecil hingga teksturnya agak kental, lalu angkat.',
                            'Tambahkan daun bayam iris ke dalam saus, aduk hingga tercampur rata.',
                            'Tuangkan saus krim bayam hangat ke dalam wadah berisi kentang dan ikan tuna. Sajikan.'
                        ],
                        buah: ['120 gr pepaya - potong dadu'],
                        tips: 'Menu barat versi lokal yang kaya akan zat besi, kalsium dari susu, serta omega-3 dari ikan tuna untuk stimulasi kecerdasan otak anak usia di atas 1 tahun.'
                    },
                    {
                        img: '../assets/img/Opor-Tahu-Tempe-tanpa-Santan.png',
                        title: 'Opor Tahu Tempe tanpa Santan',
                        tags: ['Menu Kuah', 'Nabati'],
                        kkal: '145 kkal', protein: '7.8 gr', lemak: '6.5 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: [
                            '1 buah tempe murni (potong kecil-kecil/cincang kasar)',
                            '2 buah tahu putih (potong kecil-kecil/hancurkan kasar)',
                            'Secukupnya air matang untuk kuah',
                            '1 batang serai (memarkan)',
                            '3 lembar daun jeruk',
                            '1 lembar daun salam',
                            '1 cm lengkuas (geprek)',
                            '1/2 sdt gula pasir',
                            'Sejumput garam (opsional)'  
                        ],  
                        bumbu: [
                            '3 butir bawang merah',
                            '2 siung bawang putih',
                            '1/4 sdt lada bubuk (sejumput saja)'
                        ],
                        steps: [
                            'Haluskan bumbu (bawang merah, bawang putih, lada bubuk).',
                            'Tumis bumbu halus dengan sedikit minyak hingga layu dan wangi.',
                            'Masukkan serai, daun jeruk, daun salam, dan lengkuas. Aduk-aduk hingga rata, lalu tuangkan air secukupnya.',
                            'Masukkan potongan tahu dan tempe ke dalam kuah opor.',
                            'Tambahkan gula dan sejumput garam, aduk rata dan masak dengan api kecil hingga bumbu meresap sempurna ke dalam tahu tempe.',
                            'Cek rasa, angkat, lalu sesuaikan tekstur cincang kasarnya sebelum disajikan hangat bersama nasi tim anak.'
                        ],
                        buah: ['120 gr pisang - lumat halus'],
                        tips: 'Meskipun tanpa santan, perpaduan tahu dan tempe tetap memberikan asupan protein nabati yang padat kalori dan sangat ramah di kantong.'
                    },
                    {
                        img: '../assets/img/Sup-Rolade-Daging.png"',
                        title: 'Sup Rolade Daging',
                        tags: ['Sup Bening', 'Sup Daging'],
                        kkal: '245 kkal', protein: '11.2 gr', lemak: '9.8 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: [
                            '2 gulung rolade ayam/daging sapi (potong bulat/ukuran suapan anak)',
                            '1 buah wortel ukuran besar (potong dadu kecil)',
                            '1 buah kentang ukuran besar (potong dadu kecil)',
                            '1300 ml air kaldu asli (ayam atau sapi)',
                            '1 batang bawang prei (iris tipis)',
                            '2 batang seledri (iris halus)',
                            'Secukupnya minyak untuk menumis bumbu',
                            'Secukupnya bawang goreng untuk taburan'
                        ],
                        bumbu: [
                            '5-6 siung bawang putih (haluskan dengan sedikit air kaldu)',
                            'Sejumput merica bubuk',
                            'Secukupnya garam dan gula'
                        ],
                        steps: [
                            'Siapkan semua bahan. Haluskan bawang putih menggunakan blender dengan menambahkan sedikit air kaldu.',
                            'Panaskan wajan dengan sedikit minyak, tumis bumbu bawang putih halus hingga harum.',
                            'Masukkan potongan wortel, aduk rata, lalu beri sedikit air kaldu agar tidak gosong.',
                            'Tuangkan sisa air kaldu secara keseluruhan, lalu masukkan potongan kentang. Masak hingga wortel dan kentang setengah empuk.',
                            'Masukkan potongan rolade, sejumput merica, dan secukupnya garam/gula. Masak sebentar hingga semua bahan matang sempurna, lalu koreksi rasa.',
                            'Matikan kompor, masukkan irisan bawang prei dan seledri, aduk rata.',
                            'Tuang ke dalam wadah saji anak, taburkan bawang merah goreng di atasnya, dan sajikan bersama nasi hangat.'
                        ],
                        buah: ['150 gr buah semangka - potong dadu'],
                        tips: 'Air kaldu asli memberikan rasa gurih alami yang kuat, sehingga kamu tidak perlu menambahkan MSG atau penyedap rasa buatan untuk menggugah selera makan si kecil.'
                    },
                    {
                        img: '../assets/img/Pastel-Tutup-Gindara.png',
                        title: 'Pastel Tutup Gindara',
                        tags: ['Panggang', 'Omega-3 Tinggi'],
                        kkal: '240 kkal', protein: '11.5 gr', lemak: '10.2 gr',
                        porsi: 'Resep untuk 3 porsi',
                        bahan: [
                            '150 gr kentang (kupas, cuci bersih)',
                            '10 gr wortel (cincang halus)',
                            '10 gr buncis (cincang halus)',
                            '30 gr fillet ikan gindara (pastikan bebas duri, cincang kasar)',
                            '1 butir telur ayam (rebus hingga matang ±15 menit, kupas, potong tipis)',
                            'Secukupnya air matang (sedikit saja untuk mematangkan tumisan)',
                            'Secukupnya minyak zaitun atau unsalted butter untuk menumis'
                        ],
                        bumbu: [
                            'Bawang putih secukupnya (cincang halus)',
                            'Bawang bombay secukupnya (cincang halus)',
                            'Unsalted butter secukupnya (untuk campuran kentang lumat)',
                            'Rempah oregano secukupnya',
                            'Rempah thyme secukupnya',
                            'Rempah basil secukupnya',
                            'Rempah rosemary secukupnya'
                        ],
                        steps: [
                            'Rebus buncis dan wortel yang sudah dicincang selama 3 menit, angkat dan tiriskan.',
                            'Rebus kentang selama 30 menit atau sampai benar-benar matang empuk, hancurkan/lumatkan selagi hangat, lalu balur dan aduk rata dengan unsalted butter. Sisihkan.',
                            'Panaskan minyak zaitun atau unsalted butter di wajan, tumis bawang putih dan bawang bombay hingga wangi.',
                            'Masukkan buncis, wortel, dan ikan gindara. Pastikan ikan gindara terurai hancur saat ditumis.',
                            'Taburkan rempah oregano, basil, thyme, dan rosemary secukupnya untuk aroma herbal yang harum.',
                            'Tambahkan sedikit air matang, aduk perlahan dan diamkan sampai air mendidih serta ikan matang, lalu angkat.',
                            'Siapkan wadah atau aluminium foil cup cup tahan panas, tuangkan tumisan ikan gindara, sayuran, beserta sisa cairan kaldunya di lapisan paling bawah.',
                            'Letakkan irisan telur rebus secara merata di atas lapisan tumisan ikan.',
                            'Tutup bagian paling atas dengan adonan kentang lumat secara rapi hingga menutupi seluruh permukaan wadah.',
                            'Panggang di dalam oven dengan suhu 180°C selama 20 menit hingga bagian atas kentang agak set dan harum (Catatan: Suhu oven disesuaikan dari resep asli agar kue matang ideal tanpa gosong).',
                            'Angkat, biarkan agak hangat, dan Pastel Tutup Gindara siap disajikan untuk si kecil.'
                        ],
                        buah: ['120 gr jeruk manis potong'],
                        tips: 'Ikan gindara memiliki kandungan minyak alami yang sangat kaya akan lemak sehat dan omega-3, berpadu dengan aroma rempah herbal esensial yang sangat bagus untuk merangsang indra penciuman dan nafsu makan anak balita.'
                    }
                ]
            }
        };

        let currentAge = '6-8';

        function switchAge(age) {
            currentAge = age;
            document.querySelectorAll('.age-tab').forEach((t, i) => {
                const ages = ['6-8', '9-11', '12-23'];
                t.classList.toggle('active', ages[i] === age);
            });
            const data = ageData[age];
            document.getElementById('ageBadge').textContent = data.badge;
            document.getElementById('pageTitle').textContent = data.title;
            document.getElementById('pageDesc').textContent = data.desc;
            document.getElementById('infoTextur').textContent = data.infoTextur;
            document.getElementById('infoFrekuensi').textContent = data.infoFrekuensi;
            document.getElementById('infoPorsi').textContent = data.infoPorsi;
            renderRecipes(data.recipes);
        }

        function renderRecipes(recipes) {
            const grid = document.getElementById('recipeGrid');
            grid.innerHTML = '';
            recipes.forEach((r, i) => {
                const card = document.createElement('div');
                card.className = 'recipe-card';
                card.style.animationDelay = (i * 0.07) + 's';

                // Tentukan tampilan gambar: file lokal atau emoji placeholder
                let mediaHTML = '';
                if (r.img) {
                    // Gunakan file gambar lokal
                    mediaHTML = `
                        <div class="recipe-card-img-wrap">
                            <img class="recipe-card-img" src="${r.img}"
                                 alt="${r.title}"
                                 onerror="this.parentElement.innerHTML='<div class=\\'recipe-card-emoji-placeholder\\'>${r.emoji || '🍽️'}</div>'">
                        </div>`;
                } else {
                    // Fallback emoji untuk resep tanpa file gambar
                    mediaHTML = `
                        <div class="recipe-card-img-wrap">
                            <div class="recipe-card-emoji-placeholder">${r.emoji || '🍽️'}</div>
                        </div>`;
                }

                card.innerHTML = `
                    ${mediaHTML}
                    <div class="recipe-card-header">
                        <div class="recipe-card-title">${r.title}</div>
                        <div class="recipe-meta">
                            ${r.tags.map(t => `<span class="recipe-tag">${t}</span>`).join('')}
                        </div>
                    </div>
                    <div class="recipe-card-body">
                        <div class="recipe-nutrients">
                            <div class="nutrient"><span class="val">${r.kkal}</span><span class="lbl">Energi</span></div>
                            <div class="nutrient"><span class="val">${r.protein}</span><span class="lbl">Protein</span></div>
                            <div class="nutrient"><span class="val">${r.lemak}</span><span class="lbl">Lemak</span></div>
                        </div>
                        <div class="recipe-portions">📦 ${r.porsi}</div>
                        <button class="btn-detail" onclick="openModal(${i})">Lihat Resep Lengkap →</button>
                    </div>
                `;
                grid.appendChild(card);
            });
        }

        function openModal(idx) {
            const r = ageData[currentAge].recipes[idx];

            // Header modal: gambar lokal atau emoji
            const headerMedia = document.getElementById('mHeaderMedia');
            if (r.img) {
                headerMedia.innerHTML = `
                    <img id="mHeaderImg" class="modal-header-img" src="${r.img}" alt="${r.title}"
                         onerror="this.outerHTML='<div class=\\'modal-header-emoji\\'>${r.emoji || '🍽️'}</div>'">`;
            } else {
                headerMedia.innerHTML = `<div class="modal-header-emoji">${r.emoji || '🍽️'}</div>`;
            }

            document.getElementById('mTitle').textContent = r.title;
            document.getElementById('mSubtitle').textContent = r.porsi + ' · ' + ageData[currentAge].badge;
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

        // Init
        renderRecipes(ageData['6-8'].recipes);
    </script>
</div>
<?php include '../layout/footer.php'; ?>
