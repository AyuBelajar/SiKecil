<?php
$pageTitle = 'Kalkulator Gizi Balita';
$basePath  = '../';
include '../layout/header.php';
?>

<div class="page-wrapper">
    <div class="page-title-bar">
        <h1>📊 Kalkulator Status Gizi</h1>
        <p>Gunakan teknologi AI untuk memprediksi status gizi buah hati Anda berdasarkan umur dan tinggi badan.</p>
    </div>

    <div class="form-card">
        <div class="page-icon" style="text-align: center; font-size: 3rem;">👶</div>
        <h1 style="text-align: center;">Input Data Balita</h1>
        <p class="sub" style="text-align: center;">Pastikan data yang dimasukkan akurat sesuai hasil pengukuran terbaru.</p>

        <form id="kalkulatorForm">
            <div style="margin-bottom: 15px;">
                <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-mid);">Nama Balita</label>
                <input type="text" id="nama" class="form-input" placeholder="Contoh: Adek SiKecil" required>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-mid);">Jenis Kelamin</label>
                <select id="jenis_kelamin" class="form-input" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div style="margin-bottom: 15px;">
                <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-mid);">Umur (Bulan)</label>
                <input type="number" id="umur" class="form-input" placeholder="Contoh: 12" min="0" max="60" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-size: 0.85rem; font-weight: 600; color: var(--text-mid);">Tinggi Badan (cm)</label>
                <input type="number" step="0.1" id="tinggi" class="form-input" placeholder="Contoh: 75.5" required>
            </div>

            <button type="submit" class="form-btn" id="btnPrediksi">
                <span id="btnText">Mulai Prediksi AI</span>
            </button>
        </form>

        <!-- AREA HASIL PREDIKSI (Awalnya Tersembunyi) -->
        <div id="resultArea" style="display: none; margin-top: 25px; padding: 20px; border-radius: 15px; text-align: center; border: 2px dashed var(--teal);">
            <p style="font-size: 0.9rem; color: var(--text-mid); margin-bottom: 5px;">Hasil Prediksi Status Gizi:</p>
            <h2 id="statusGizi" style="color: var(--teal); font-family: 'Nunito', sans-serif; font-weight: 900; font-size: 1.8rem;">--</h2>
            <div id="saranGizi" style="font-size: 0.85rem; color: var(--text-dark); margin-top: 10px; line-height: 1.5;"></div>
            
            <button onclick="resetForm()" style="margin-top: 15px; background: none; border: none; color: var(--text-mid); text-decoration: underline; cursor: pointer; font-size: 0.8rem;">Hitung Ulang</button>
        </div>
    </div>

    <div style="margin-top: 28px; text-align: center;">
        <a href="../index.php" style="color:var(--teal); font-size:.9rem; font-weight:600; text-decoration:none;">← Kembali ke Beranda</a>
    </div>
</div>

<script>
    const form = document.getElementById('kalkulatorForm');
    const btnPrediksi = document.getElementById('btnPrediksi');
    const btnText = document.getElementById('btnText');
    const resultArea = document.getElementById('resultArea');
    const statusGizi = document.getElementById('statusGizi');
    const saranGizi = document.getElementById('saranGizi');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // 1. Ambil Data
        const data = {
            nama: document.getElementById('nama').value,
            jenis_kelamin: document.getElementById('jenis_kelamin').value,
            umur: document.getElementById('umur').value,
            tinggi: document.getElementById('tinggi').value
        };

        // 2. Efek Loading
        btnPrediksi.disabled = true;
        btnText.innerText = "Sedang Menganalisis...";
        resultArea.style.display = 'none';

        try {
            // 3. Panggil API Flask (Pastikan app.py sudah jalan!)
            const response = await fetch('http://127.0.0.1:5000/predict', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) throw new Error('Gagal terhubung ke server AI');

            const result = await response.json();

            // 4. Tampilkan Hasil
            statusGizi.innerText = result.status_gizi;
            
            // Berikan saran sederhana berdasarkan hasil
            let saran = "";
            if(result.status_gizi.toLowerCase().includes("normal")) {
                saran = "Hebat! Pertahankan pola makan bergizi dan rutin ke Posyandu.";
            } else if(result.status_gizi.toLowerCase().includes("stunted") || result.status_gizi.toLowerCase().includes("pendek")) {
                saran = "Perhatian: Segera konsultasikan ke tenaga kesehatan untuk penanganan stunting dini.";
            } else {
                saran = "Pastikan asupan protein hewani dan kalori tercukupi setiap hari.";
            }
            
            saranGizi.innerHTML = `<strong>Saran:</strong> ${saran}`;
            resultArea.style.display = 'block';
            resultArea.scrollIntoView({ behavior: 'smooth' });

        } catch (error) {
            alert('Error: ' + error.message + '\nPastikan server Python (app.py) sudah dijalankan di terminal VS Code!');
        } finally {
            btnPrediksi.disabled = false;
            btnText.innerText = "Mulai Prediksi AI";
        }
    });

    function resetForm() {
        form.reset();
        resultArea.style.display = 'none';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>

<?php include '../layout/footer.php'; ?>