<script>
    const form = document.getElementById('kalkulatorForm');
    const btnPrediksi = document.getElementById('btnPrediksi');
    const btnText = document.getElementById('btnText');
    const resultArea = document.getElementById('resultArea');
    const statusGizi = document.getElementById('statusGizi');
    const saranGizi = document.getElementById('saranGizi');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const data = {
            nama: document.getElementById('nama').value,
            jenis_kelamin: document.getElementById('jenis_kelamin').value,
            umur: document.getElementById('umur').value,
            tinggi: document.getElementById('tinggi').value
        };

        btnPrediksi.disabled = true;
        btnText.innerText = "Sedang Menganalisis...";
        resultArea.style.display = 'none';

        try {
            const response = await fetch('http://127.0.0.1:5000/predict', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Gagal terhubung ke server AI');
            }

            const result = await response.json();

            // Tampilkan hasil
            statusGizi.innerText = result.status_gizi;

            let status = result.status_gizi.toLowerCase();
            let saran = "";

            // Warna status
            if (
                status.includes("stunting") ||
                status.includes("sangat stunting")
            ) {
                statusGizi.style.color = "#dc3545"; // merah
                resultArea.style.border = "2px dashed #dc3545";
            }
            else if (status.includes("normal")) {
                statusGizi.style.color = "#28a745"; // hijau
                resultArea.style.border = "2px dashed #28a745";
            }
            else if (status.includes("tinggi")) {
                statusGizi.style.color = "#007bff"; // biru
                resultArea.style.border = "2px dashed #007bff";
            }
            else {
                statusGizi.style.color = "var(--teal)";
                resultArea.style.border = "2px dashed var(--teal)";
            }

            // Saran berdasarkan hasil
            if (status.includes("normal")) {
                saran = "Hebat! Pertahankan pola makan bergizi seimbang dan rutin memantau pertumbuhan di Posyandu.";
            }
            else if (status.includes("sangat stunting")) {
                saran = "Perhatian: Segera konsultasikan dengan dokter atau ahli gizi untuk mendapatkan penanganan lebih lanjut.";
            }
            else if (status.includes("stunting")) {
                saran = "Perhatikan asupan gizi terutama protein hewani, serta lakukan pemantauan pertumbuhan secara berkala.";
            }
            else if (status.includes("tinggi")) {
                saran = "Pertumbuhan anak berada di atas rata-rata tinggi badan usianya. Tetap pastikan kebutuhan gizi terpenuhi secara seimbang.";
            }
            else {
                saran = "Lakukan konsultasi dengan tenaga kesehatan untuk evaluasi lebih lanjut.";
            }

            saranGizi.innerHTML = `<strong>Saran:</strong> ${saran}`;

            resultArea.style.display = 'block';
            resultArea.scrollIntoView({
                behavior: 'smooth'
            });

        } catch (error) {
            alert(
                'Error: ' +
                error.message +
                '\nPastikan server Python (app.py) sudah dijalankan!'
            );
        } finally {
            btnPrediksi.disabled = false;
            btnText.innerText = "Mulai Prediksi AI";
        }
    });
</script>