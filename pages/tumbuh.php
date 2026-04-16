<?php
$pageTitle = 'Tumbuh Kembang';
$basePath  = '../';
include '../layout/header.php';
?>

<style>
    /* CSS spesifik untuk fitur Tumbuh Kembang */
    .tk-hero {
        background: #f0e9d2; /* Warna sand dari kode asli */
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 25px;
        border-bottom: 3px solid #e0d5b5;
    }

    .tk-hero h2 {
        font-family: 'Nunito', sans-serif;
        font-size: 24px;
        font-weight: 900;
        margin-bottom: 10px;
        text-align: center;
    }

    .tk-hero p {
        font-size: 14px;
        color: #666;
        max-width: 820px;
        line-height: 1.75;
        text-align: center;
        margin: 0 auto;
    }

    .age-tabs-wrapper {
        background: white;
        border-bottom: 2px solid #eee;
        position: sticky;
        top: 68px; /* Sesuaikan dengan tinggi navbar kamu */
        z-index: 90;
        margin: 0 -80px 25px; /* Menyeimbangkan padding page-wrapper */
        padding: 0 80px;
    }

    .age-tabs {
        display: flex;
        justify-content: center;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .age-tab {
        flex: 1;
        min-width: 120px;
        padding: 15px 10px;
        font-family: 'Nunito', sans-serif;
        font-size: 14px;
        font-weight: 800;
        color: var(--text-mid);
        cursor: pointer;
        border-bottom: 3px solid transparent;
        transition: all 0.2s;
        text-align: center;
    }

    .age-tab.active {
        color: var(--teal);
        border-bottom-color: var(--teal);
        background: var(--teal-light);
    }

    /* Styling Kuesioner */
    .question-card {
        background: white;
        border-radius: 14px;
        padding: 20px;
        margin-bottom: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        border-left: 5px solid #eee;
    }

    .question-card.answered-ya { border-left-color: #5cb85c; background: #f9fff9; }
    .question-card.answered-tidak { border-left-color: #d9534f; background: #fff9f9; }

    .q-top { display: flex; gap: 15px; margin-bottom: 15px; }
    .qnum {
        width: 30px; height: 30px; background: var(--teal); color: white;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-weight: bold; flex-shrink: 0;
    }

    .answer-buttons { display: flex; gap: 10px; }
    .ans-btn {
        flex: 1; padding: 10px; border-radius: 10px; border: 2px solid #ddd;
        background: white; font-weight: bold; cursor: pointer; transition: 0.2s;
    }
    .ans-btn.ya:hover, .ans-btn.ya.selected { background: #5cb85c; color: white; border-color: #5cb85c; }
    .ans-btn.tidak:hover, .ans-btn.tidak.selected { background: #d9534f; color: white; border-color: #d9534f; }

    .result-box {
        padding: 30px; border-radius: 20px; text-align: center; margin-top: 30px;
        display: none; animation: fadeIn 0.5s;
    }
    .result-box.sesuai { background: #e8f5e9; border: 2px solid #4caf50; }
    .result-box.meragukan { background: #fffde7; border: 2px solid #fbc02d; }
    .result-box.penyimpangan { background: #ffebee; border: 2px solid #ef5350; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    
    @media (max-width: 820px) {
        .age-tabs-wrapper { margin: 0 -24px 20px; padding: 0 24px; }
    }
</style>

<div class="page-wrapper">
    <div class="page-title-bar">
        <h1>📈 Tumbuh Kembang</h1>
        <p>Pantau milestone perkembangan buah hati Anda sesuai standar Kemenkes RI.</p>
    </div>

    <div class="tk-hero">
        <h2>Hai Bunda!</h2>
        <p>
            Gunakan <strong>KPSP (Kuesioner Pra Skrining Perkembangan)</strong> untuk melihat perkembangan anak pada 4 aspek: 
            Motorik Kasar, Motorik Halus, Bicara & Bahasa, serta Sosialisasi & Kemandirian.
        </p>
    </div>

    <!-- Navigasi Usia -->
    <div class="age-tabs-wrapper">
        <div class="age-tabs" id="ageTabs">
            <div class="age-tab active" data-key="0-2" onclick="switchAge('0-2', this)">0–2 Bulan</div>
            <div class="age-tab" data-key="3-5" onclick="switchAge('3-5', this)">3–5 Bulan</div>
            <div class="age-tab" data-key="6-8" onclick="switchAge('6-8', this)">6–8 Bulan</div>
            <div class="age-tab" data-key="9-11" onclick="switchAge('9-11', this)">9–11 Bulan</div>
            <div class="age-tab" data-key="12-17" onclick="switchAge('12-17', this)">12–17 Bulan</div>
            <div class="age-tab" data-key="18-23" onclick="switchAge('18-23', this)">18–23 Bulan</div>
        </div>
    </div>

    <!-- Wadah Kuesioner (Akan diisi oleh JS) -->
    <div id="kuesionerContainer"></div>

    <div style="margin-top:28px;">
        <a href="../index.php" style="color:var(--teal);font-size:.9rem;font-weight:600;text-decoration:none;">← Kembali ke Beranda</a>
    </div>
</div>

<script>
    // Copy data kpspData dari file asli kamu ke sini
    const kpspData = {
        '0-2': {
            title: 'KPSP Bayi Umur 0-2 Bulan',
            desc: 'Bayi mulai mengangkat kepala, merespons suara, dan membalas senyuman.',
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
                    { text: 'Apakah bayi suka tertawa terbahak-bahak meskipun tidak digelitik atau diusik?', domain: 'bicara', label: 'Bicara & Bahasa' },
                ]
            },
            '3-5': {
                title: 'KPSP Bayi Umur 3-5 Bulan',
                desc: 'Bayi mampu berbalik posisi, meraih dan memegang benda, serta mulai mengoceh dan menirukan ekspresi wajah orang di sekitarnya.',
                tools: 'Gulungan wool merah, pensil, kismis/kacang/uang logam, mainan',
                questions: [
                    { text: 'Saat bayi berbaring telentang, gerakkan gulungan wool merah dari kiri ke kanan di depan matanya. Apakah kepalanya ikut berputar penuh mengikuti gerakan tersebut dari satu sisi ke sisi yang lain?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Saat bayi duduk di pangkuan Anda, sentuhkan ujung pensil ke punggung tangan atau ujung jari bayi (bukan di telapak tangan). Apakah bayi langsung menggenggam pensil tersebut selama beberapa detik?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Saat bayi duduk di pangkuan Anda, apakah ia bisa memperhatikan atau menatap benda kecil sebesar kacang, kismis, atau uang logam? Jawab "Tidak" jika ia tidak dapat mengarahkan matanya.', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Saat bayi duduk di pangkuan Anda, apakah ia mencoba meraih mainan yang diletakkan agak jauh, namun masih dalam jangkauan tangannya?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Apakah bayi pernah berguling sendiri minimal 2 kali, dari posisi telentang ke tengkurap atau sebaliknya?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Saat bayi berbaring telentang, pegang kedua tangannya lalu tarik perlahan ke posisi duduk. Apakah kepala bayi ikut terangkat dan tidak terkulai ke belakang? Jawab "Tidak" jika kepala bayi jatuh kembali.', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Saat bayi tengkurap di permukaan yang datar, apakah ia bisa mengangkat dadanya dengan menopang tubuhnya menggunakan kedua lengan?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Saat bayi duduk di pangkuan Anda, apakah ia bisa menegakkan kepalanya dengan stabil? Jawab "Tidak" jika kepala bayi masih sering jatuh ke kanan, kiri, atau ke depan.', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah bayi pernah tersenyum sendiri saat melihat mainan lucu, gambar, atau binatang peliharaan ketika sedang bermain sendiri?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Apakah bayi pernah mengeluarkan suara gembira bernada tinggi atau seperti memekik (bukan menangis)?', domain: 'bicara', label: 'Bicara & Bahasa' },
                ]
            },
            '6-8': {
                title: 'KPSP Bayi Umur 6-8 Bulan',
                desc: 'Bayi mulai duduk, merangkak, memindahkan benda antar tangan, dan mulai mengeluarkan suara suku kata seperti "mamama" atau "bababa".',
                tools: 'Gulungan wool merah, 2 kubus, kismis/kacang-kacangan/potongan biskuit, mainan',
                questions: [
                    { text: 'Taruh kismis di atas meja di depan bayi. Apakah bayi bisa memungut benda kecil seperti kismis, kacang, atau potongan biskuit menggunakan tangannya (meski dengan cara menggerapai)?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Taruh 2 kubus di atas meja. Apakah bayi bisa mengambil dan memegang masing-masing 1 kubus di setiap tangannya secara bersamaan?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Perlihatkan gulungan wool merah kepada bayi, lalu jatuhkan ke lantai. Apakah bayi mencoba mencarinya, misalnya dengan melihat ke bawah meja atau ke lantai?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Apakah bayi pernah memindahkan mainan atau biskuit dari satu tangan ke tangan yang lain? Benda panjang seperti sendok atau kerincingan bertangkai tidak dihitung.', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Tanpa disangga bantal, kursi, atau dinding, apakah bayi bisa duduk sendiri selama 60 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Jika Anda mengangkat bayi ke posisi berdiri dengan memegang ketiaknya, apakah ia bisa menopang sebagian berat badannya dengan kedua kakinya? Jawab "Ya" jika ia mencoba berdiri dan kakinya terasa menahan berat badannya.', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Letakkan mainan favorit bayi di luar jangkauannya. Apakah ia berusaha meraihnya dengan mengulurkan tangan atau condong ke arah mainan tersebut?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Saat bayi bermain sendiri dan ada orang yang diam-diam berdiri di belakangnya, apakah bayi menoleh saat mendengar suara pelan atau bisikan? Suara keras tidak dihitung. Jawab "Ya" hanya jika bayi bereaksi terhadap suara perlahan.', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Apakah bayi sudah bisa mengucapkan 2 suku kata yang sama, seperti "ma-ma", "da-da", atau "pa-pa"? Jawab "Ya" jika ia bisa mengeluarkan salah satu suara tersebut.', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Apakah bayi sudah bisa memegang dan makan biskuit atau kue kering sendiri?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                ]
            },
            '9-11': {
                title: 'KPSP Bayi Umur 9-11 Bulan',
                desc: 'Bayi belajar berdiri berpegangan, berjalan dituntun, menunjuk sesuatu, dan mulai mengucapkan 1 kata bermakna.',
                tools: '2 kubus, pensil, kismis/kacang-kacangan/potongan biskuit',
                questions: [
                    { text: 'Letakkan pensil di telapak tangan bayi, lalu coba ambil kembali perlahan. Apakah bayi menggenggamnya dengan erat sehingga Anda kesulitan mengambilnya?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Taruh kismis di atas meja. Apakah bayi bisa memungutnya menggunakan jari-jarinya (meski dengan cara menggerapai)?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Berikan 2 kubus kepada bayi. Apakah ia bisa membenturkan atau mempertemukan kedua kubus tersebut tanpa bantuan?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Apakah bayi sudah bisa menarik dirinya sendiri ke posisi berdiri tanpa dibantu?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah bayi sudah bisa duduk sendiri dari posisi tidur atau tengkurap tanpa dibantu?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah bayi bisa berdiri sambil berpegangan pada kursi atau meja selama minimal 30 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Jika Anda bersembunyi di balik sesuatu lalu muncul kembali secara berulang, apakah bayi terlihat menunggu atau mencari Anda?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Apakah bayi sudah bisa membedakan Anda (ibu/pengasuh) dengan orang yang tidak ia kenal? Misalnya terlihat malu-malu atau ragu saat bertemu orang baru?', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Ucapkan 2–3 kata sederhana, lalu lihat apakah bayi mencoba menirukan suara atau kata-kata tersebut (tidak perlu kata yang sempurna)?', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Apakah bayi sudah mengerti arti kata "jangan" dan bereaksi saat Anda mengucapkannya?', domain: 'bicara', label: 'Bicara & Bahasa' },
                ]
            },
            '12-17': {
                title: 'KPSP Anak Umur 12-17 Bulan',
                desc: 'Anak sudah dapat berjalan sendiri, mengucapkan 1–6 kata bermakna, serta menggunakan benda sehari-hari seperti cangkir dan sisir dengan benar.',
                tools: '2 kubus, cangkir',
                questions: [
                    { text: 'Berikan 2 kubus kepada anak. Apakah ia bisa mempertemukan atau membenturkan kedua kubus tersebut tanpa bantuan?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Berikan 1 kubus dan 1 cangkir kepada anak. Apakah ia bisa memasukkan kubus ke dalam cangkir sendiri?', domain: 'gerak-halus', label: 'Motorik Halus' },
                    { text: 'Apakah anak sudah bisa berjalan dengan berpegangan pada benda seperti meja atau kursi?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah anak sudah bisa berdiri sendiri tanpa berpegangan selama minimal 30 detik?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Letakkan kubus di lantai. Tanpa berpegangan atau menyentuh lantai, apakah anak bisa membungkuk untuk mengambil kubus tersebut lalu berdiri kembali?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah anak sudah bisa berjalan melewati ruangan tanpa jatuh atau sempoyongan?', domain: 'gerak-kasar', label: 'Motorik Kasar' },
                    { text: 'Apakah anak sudah bisa bertepuk tangan atau melambai tanpa perlu dibantu atau dicontohkan terlebih dahulu? Jawab "Tidak" jika ia masih butuh bantuan.', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Apakah anak sudah bisa menunjukkan apa yang ia inginkan tanpa harus menangis atau merengek? Jawab "Ya" jika ia menunjuk, menarik tangan Anda, atau bersuara dengan gembira.', domain: 'sosialisasi', label: 'Sosialisasi & Kemandirian' },
                    { text: 'Apakah anak sudah bisa memanggil "papa" saat melihat ayahnya, atau "mama" saat melihat ibunya? Jawab "Ya" jika anak bisa mengatakan salah satunya.', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Selain "mama" dan "papa", apakah anak sudah bisa mengucapkan minimal 1 kata lain yang punya makna?', domain: 'bicara', label: 'Bicara & Bahasa' },
                ]
            },
            '18-23': {
                title: 'KPSP Anak Umur 18-23 Bulan',
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
                    { text: 'Tunjukkan gambar binatang atau benda (seperti anjing, kucing, atau bola) kepada anak, lalu minta ia menunjuk gambar yang Anda sebutkan. Apakah anak bisa menunjuk minimal 1 gambar dengan benar?', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Tanpa diarahkan atau dibantu, apakah anak bisa menunjuk bagian tubuhnya sendiri dengan benar (seperti rambut, mata, hidung, atau mulut)?', domain: 'bicara', label: 'Bicara & Bahasa' },
                    { text: 'Apakah anak sudah bisa mengucapkan minimal 7 kata yang bermakna (selain "mama" dan "papa")?', domain: 'bicara', label: 'Bicara & Bahasa' },
                ]
            }
        };

    const state = {};
    Object.keys(kpspData).forEach(k => { state[k] = {}; });
    let currentKey = '0-2';

    function sk(key) { return key.replace(/-/g, '_'); }

    function renderAll() {
        const container = document.getElementById('kuesionerContainer');
        container.innerHTML = '';
        Object.keys(kpspData).forEach(key => {
            const panel = document.createElement('div');
            panel.id = `panel-${sk(key)}`;
            panel.style.display = (key === currentKey ? 'block' : 'none');
            panel.innerHTML = buildPanel(key);
            container.appendChild(panel);
        });
    }

    function buildPanel(key) {
        const d = kpspData[key], s = sk(key);
        const qs = d.questions.map((q, i) => `
            <div class="question-card" id="qcard-${s}-${i}">
                <div class="q-top">
                    <div class="qnum">${i + 1}</div>
                    <div>
                        <div class="question-text">${q.text}</div>
                        <span style="font-size:10px; font-weight:bold; color:var(--teal); text-transform:uppercase;">${q.label}</span>
                    </div>
                </div>
                <div class="answer-buttons">
                    <button class="ans-btn ya" onclick="answer('${key}',${i},'ya')">✅ Ya</button>
                    <button class="ans-btn tidak" onclick="answer('${key}',${i},'tidak')">❌ Tidak</button>
                </div>
            </div>`).join('');

        return `
            <div style="background:var(--teal); color:white; padding:20px; border-radius:15px; margin-bottom:20px;">
                <h3 style="margin:0">${d.title}</h3>
                <p style="margin:5px 0 0; font-size:0.9rem; opacity:0.9">${d.desc}</p>
            </div>
            <div style="background:#fff8ee; padding:15px; border-radius:10px; margin-bottom:20px; font-size:0.9rem;">
                <strong>Alat:</strong> ${d.tools}
            </div>
            ${qs}
            <button class="form-btn" id="bsub-${s}" onclick="submitResult('${key}')" disabled style="margin-top:20px">🔍 Lihat Hasil Penilaian</button>
            <div class="result-box" id="res-${s}"></div>
        `;
    }

    function answer(key, idx, val) {
        const s = sk(key);
        state[key][idx] = val;
        const card = document.getElementById(`qcard-${s}-${idx}`);
        card.className = 'question-card answered-' + val;
        
        const answered = Object.keys(state[key]).length;
        const total = kpspData[key].questions.length;
        document.getElementById(`bsub-${s}`).disabled = answered < total;
    }

    function submitResult(key) {
        const s = sk(key);
        const yaCount = Object.values(state[key]).filter(v => v === 'ya').length;
        const total = kpspData[key].questions.length;
        let cls, emoji, title, desc;

        if (yaCount >= 9) {
            cls = 'sesuai'; emoji = '🌟'; title = 'Perkembangan Sesuai Umur';
            desc = `Skor ${yaCount}/${total}. Teruskan pola asuh dan stimulasi harian Bunda!`;
        } else if (yaCount >= 7) {
            cls = 'meragukan'; emoji = '🤔'; title = 'Hasil Meragukan';
            desc = `Skor ${yaCount}/${total}. Berikan stimulasi lebih sering dan cek kembali 2 minggu lagi.`;
        } else {
            cls = 'penyimpangan'; emoji = '⚠️'; title = 'Perlu Konsultasi';
            desc = `Skor ${yaCount}/${total}. Segera konsultasikan ke dokter anak untuk pemeriksaan lebih lanjut.`;
        }

        const box = document.getElementById(`res-${s}`);
        box.className = `result-box ${cls}`;
        box.style.display = 'block';
        box.innerHTML = `<h2>${emoji} ${title}</h2><p>${desc}</p>`;
        box.scrollIntoView({ behavior: 'smooth' });
    }

    function switchAge(key, tabEl) {
        currentKey = key;
        document.querySelectorAll('.age-tab').forEach(t => t.classList.remove('active'));
        tabEl.classList.add('active');
        renderAll();
    }

    renderAll();
</script>

<?php include '../layout/footer.php'; ?>