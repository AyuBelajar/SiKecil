from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np

app = Flask(__name__)
CORS(app)

# Load dictionary dari .pkl
with open('model_balita.pkl', 'rb') as f:
    data_pkl = pickle.load(f)

model = data_pkl['model']
le_label = data_pkl['label_encoder']
le_gender = data_pkl['gender_encoder']

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()
    
    # Ambil data dari web (misal: 'Laki-laki' atau 'Perempuan')
    gender_input = data['jenis_kelamin'] 
    
    # Lakukan transform otomatis menggunakan encoder yang sudah disimpan
    # Jadi kita tidak perlu menebak L itu 0 atau 1
    gender_enc = le_gender.transform([gender_input])[0]
    
    features = np.array([[
        float(data['umur']),
        gender_enc,
        float(data['tinggi'])
    ]])
    
    # Prediksi menghasilkan angka (misal: 2)
    prediction_num = model.predict(features)[0]
    
    # Balikkan angka ke teks asli (misal: 'Gizi Baik')
    hasil_teks = le_label.inverse_transform([prediction_num])[0]
    
    return jsonify({
        'status_gizi': hasil_teks,
        'akurasi_model': "88.54%" # optional dari hasil Colab tadi
    })

if __name__ == '__main__':
    app.run(port=5000, debug=True)