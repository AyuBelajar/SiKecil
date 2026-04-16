<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiKecil - Tumbuh Kembang</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Quicksand:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --teal: #4a9ba8;
            --teal-dark: #3a7d88;
            --teal-light: #e8f4f6;
            --sand: #f0e9d2;
            --sand-dark: #e0d5b5;
            --text: #3a3a3a;
            --text-light: #666;
            --accent: #f4a04a;
            --green: #5cb85c;
            --red: #d9534f;
            --yellow: #f0ad4e;
            --radius: 16px;
            --shadow: 0 4px 20px rgba(74, 155, 168, 0.15);
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

        /* TK HERO */
        .tk-hero {
            background: var(--sand);
            padding: 28px 40px;
            border-bottom: 3px solid var(--sand-dark);
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
            color: var(--text-light);
            max-width: 820px;
            line-height: 1.75;
            text-align: center;
            margin: 0 auto;
        }

        /* AGE TABS */
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
            max-width: 160px;
            padding: 15px 10px;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            font-weight: 800;
            color: var(--text-light);
            cursor: pointer;
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

        /* KUESIONER */
        .kuesioner-container {
            max-width: 860px;
            margin: 0 auto;
            padding: 28px 20px 60px;
        }

        .kuesioner-panel {
            display: none;
        }

        .kuesioner-panel.active {
            display: block;
            animation: fadeSlide 0.32s ease;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .kuesioner-header {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-dark) 100%);
            border-radius: var(--radius);
            padding: 20px 24px;
            margin-bottom: 16px;
            color: white;
            display: flex;
            align-items: center;
            gap: 16px;
        }

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

        .tools-box .ti {
            font-size: 18px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .tools-box strong {
            color: var(--teal-dark);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 2px;
        }

        .tip-box {
            background: #fff8ee;
            border-left: 4px solid var(--accent);
            border-radius: 0 10px 10px 0;
            padding: 11px 15px;
            margin-bottom: 16px;
            font-size: 13px;
            color: #7a5a20;
            line-height: 1.6;
        }

        .tip-box strong {
            color: #b07020;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: var(--text-light);
            margin-bottom: 5px;
            font-weight: 600;
        }

        .progress-bar-wrap {
            background: #e0ecee;
            border-radius: 50px;
            height: 9px;
            margin-bottom: 20px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--teal), var(--accent));
            border-radius: 50px;
            transition: width 0.4s ease;
            width: 0%;
        }

        .question-card {
            background: white;
            border-radius: 14px;
            padding: 18px 20px;
            margin-bottom: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            border: 2px solid transparent;
            transition: border-color 0.2s, background 0.2s;
        }

        .question-card.answered-ya {
            border-color: var(--green);
            background: #f3fdf3;
        }

        .question-card.answered-tidak {
            border-color: #ddd;
            background: #fafafa;
        }

        .q-top {
            display: flex;
            gap: 11px;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .qnum {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 25px;
            height: 25px;
            background: var(--teal-light);
            color: var(--teal-dark);
            border-radius: 50%;
            font-size: 11px;
            font-weight: 800;
            flex-shrink: 0;
            margin-top: 2px;
            font-family: 'Nunito', sans-serif;
        }

        .q-content {
            flex: 1;
        }

        .question-text {
            font-size: 14px;
            line-height: 1.7;
            color: var(--text);
        }

        .domain-tag {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 30px;
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .domain-tag.gerak-kasar {
            background: #fff0e0;
            color: #b05010;
        }

        .domain-tag.gerak-halus {
            background: #e0eeff;
            color: #1050a0;
        }

        .domain-tag.bicara {
            background: #e8f8e8;
            color: #206020;
        }

        .domain-tag.sosialisasi {
            background: #f5e0ff;
            color: #6020a0;
        }

        .answer-buttons {
            display: flex;
            gap: 10px;
        }

        .ans-btn {
            flex: 1;
            padding: 9px;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            background: white;
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .ans-btn.ya {
            color: var(--green);
        }

        .ans-btn.tidak {
            color: #e66969;
        }

        .ans-btn.ya:hover,
        .ans-btn.ya.selected {
            background: var(--green);
            color: white;
            border-color: var(--green);
        }

        .ans-btn.tidak:hover,
        .ans-btn.tidak.selected {
            background: #f56c6c;
            color: #ffffff;
            border-color: #f56c6c;
        }

        .btn-submit {
            background: var(--teal);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            font-family: 'Nunito', sans-serif;
            font-weight: 800;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.2s;
            margin: 12px auto 0;
            display: block;
            box-shadow: 0 4px 14px rgba(74, 155, 168, 0.35);
        }

        .btn-submit:hover {
            background: var(--teal-dark);
            transform: translateY(-2px);
        }

        .btn-submit:disabled {
            background: #bfcfd3;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .result-box {
            display: none;
            border-radius: var(--radius);
            padding: 28px 24px;
            margin-top: 22px;
            text-align: center;
            animation: fadeSlide 0.4s ease;
        }

        .result-box.sesuai {
            background: linear-gradient(135deg, #edfced, #ccf0cc);
            border: 2px solid #4caf50;
        }

        .result-box.meragukan {
            background: linear-gradient(135deg, #fffaec, #fff0ba);
            border: 2px solid var(--yellow);
        }

        .result-box.penyimpangan {
            background: linear-gradient(135deg, #fff5f5, #ffd8d0);
            border: 2px solid var(--red);
        }

        .result-emoji {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .result-title {
            font-family: 'Nunito', sans-serif;
            font-size: 21px;
            font-weight: 900;
            margin-bottom: 6px;
        }

        .result-score {
            font-size: 13px;
            color: var(--text-light);
            margin-bottom: 14px;
        }

        .result-desc {
            font-size: 14px;
            line-height: 1.75;
            color: var(--text);
            margin-bottom: 18px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .result-actions {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .btn-reset {
            background: white;
            border: 2px solid var(--teal);
            color: var(--teal);
            padding: 9px 22px;
            border-radius: 30px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-reset:hover {
            background: var(--teal);
            color: white;
        }

        @media (max-width: 600px) {
            .tk-hero {
                padding: 20px 16px;
            }

            .kuesioner-container {
                padding: 14px 10px 50px;
            }

            .kuesioner-header {
                flex-direction: column;
                text-align: center;
            }

            .age-tab {
                font-size: 12px;
                padding: 12px 6px;
            }
        }
    </style>
</head>

<body>

    <div class="tk-hero">
        <h2>Hai Bunda!</h2>
        <p>
            <strong>Milestone</strong> adalah tahapan perkembangan yang biasanya dicapai anak sesuai usianya,
            seperti tengkurap, duduk, berjalan, atau mulai berbicara.
            Gunakan <strong>KPSP (Kuesioner Pra Skrining Perkembangan)</strong> — alat skrining resmi dari
            <strong>Kementerian Kesehatan RI (2021)</strong>
            yang berisi pertanyaan sederhana untuk melihat perkembangan anak sesuai tahap usianya pada 4 aspek:
            Motorik Kasar, Motorik Halus, bicara &amp; bahasa, serta sosialisasi &amp; kemandirian.
        </p>
    </div>

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

    <div class="kuesioner-container" id="kuesionerContainer"></div>

    <script>
        const kpspData = {
            '0-2': {
                title: 'KPSP Bayi Umur 0-2 Bulan',
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
                panel.className = 'kuesioner-panel' + (key === currentKey ? ' active' : '');
                panel.innerHTML = buildPanel(key);
                container.appendChild(panel);
            });
        }

        function buildPanel(key) {
            const d = kpspData[key], s = sk(key), total = d.questions.length;
            const qs = d.questions.map((q, i) => `
    <div class="question-card" id="qcard-${s}-${i}">
      <div class="q-top">
        <div class="qnum">${i + 1}</div>
        <div class="q-content">
          <div class="question-text">${q.text}</div>
          <span class="domain-tag ${q.domain}">${q.label}</span>
        </div>
      </div>
      <div class="answer-buttons">
        <button class="ans-btn ya"    onclick="answer('${key}',${i},'ya')">✅ Ya</button>
        <button class="ans-btn tidak" onclick="answer('${key}',${i},'tidak')">❌ Tidak</button>
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
            let cls, emoji, title, desc;
            if (yaCount >= 9) {
                cls = 'sesuai'; emoji = '🌟'; title = 'Perkembangan Sesuai Umur';
                desc = `Skor ${yaCount}/${total}. Perkembangan si kecil <strong>sesuai dengan usianya</strong>. Bunda sudah merawat dan menstimulasi dengan sangat baik! Teruskan pola asuh sesuai tahapan, berikan stimulasi setiap saat, dan jadwalkan pemeriksaan KPSP berikutnya.`;
            } else if (yaCount >= 7) {
                cls = 'meragukan'; emoji = '🤔'; title = 'Hasil Meragukan';
                desc = `Skor ${yaCount}/${total}. Perkembangan si kecil <strong>perlu perhatian lebih</strong>. Berikan stimulasi lebih sering pada aspek yang belum berkembang. Evaluasi kembali setelah 2 minggu — bila skor tetap 7 atau 8, konsultasikan ke dokter atau tenaga kesehatan.`;
            } else {
                cls = 'penyimpangan'; emoji = '⚠️'; title = 'Perlu Pemeriksaan Lanjutan';
                desc = `Skor ${yaCount}/${total}. Terdeteksi kemungkinan <strong>penyimpangan perkembangan</strong>. Segera konsultasikan ke dokter anak atau tenaga kesehatan untuk pemeriksaan menyeluruh (anamnesis, pemeriksaan fisik, neurologis) dan intervensi dini.`;
            }
            const box = document.getElementById(`res-${s}`);
            box.className = `result-box ${cls}`;
            box.style.display = 'block';
            box.innerHTML = `
    <div class="result-emoji">${emoji}</div>
    <div class="result-title">${title}</div>
    <div class="result-score">Skor Ya: <strong>${yaCount}</strong> dari <strong>${total}</strong> pertanyaan</div>
    <div class="result-desc">${desc}</div>
    <div class="result-actions"><button class="btn-reset" onclick="resetQuiz('${key}')">🔄 Ulangi Kuesioner</button></div>`;
            box.scrollIntoView({ behavior: 'smooth', block: 'center' });
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
</body>

</html>