from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np

app = Flask(__name__)
CORS(app)

# 1. Load file pkl
with open('model_balita.pkl', 'rb') as f:
    data_pkl = pickle.load(f)

# 2. Ambil komponen dari dictionary (Sesuai kode Colab kamu)
model = data_pkl['model']
le_label = data_pkl['label_encoder']
le_gender = data_pkl['gender_encoder']

@app.route('/predict', methods=['POST'])
def predict():
    try:
        data = request.get_json()
        
        # Pastikan nama key ini sama dengan yang dikirim dari kalkulator.php
        umur = float(data['umur'])
        tinggi = float(data['tinggi'])
        gender_input = data['jenis_kelamin'] # 'Laki-laki' atau 'Perempuan'

        # 3. Transform gender menggunakan encoder
        gender_enc = le_gender.transform([gender_input])[0]

        # 4. Susun fitur (Urutan harus sama: Umur, Gender, Tinggi)
        features = np.array([[umur, gender_enc, tinggi]])
        
        # 5. Prediksi
        pred_num = model.predict(features)[0]
        
        # 6. Balikkan angka ke teks asli
        hasil_teks = le_label.inverse_transform([pred_num])[0]

        return jsonify({
            'status': 'success',
            'status_gizi': hasil_teks
        })

    except Exception as e:
        # Jika error, kirim pesan errornya ke console browser
        return jsonify({'status': 'error', 'message': str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)