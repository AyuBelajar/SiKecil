from flask import Flask, request, jsonify
from flask_cors import CORS
import pickle
import numpy as np

app = Flask(__name__)
CORS(app, resources={r"/predict": {"origins": "*"}})

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
        print(">> Data masuk:", data)

        umur         = float(data['umur'])
        tinggi       = float(data['tinggi'])
        gender_input = data['jenis_kelamin'].lower()

        print(">> Gender classes:", le_gender.classes_)
        print(">> Gender input:", gender_input)

        gender_enc = le_gender.transform([gender_input])[0]
        features   = np.array([[umur, gender_enc, tinggi]])

        print(">> Features:", features)

        pred_num   = model.predict(features)[0]
        hasil_teks = le_label.inverse_transform([pred_num])[0]

        print(">> Hasil:", hasil_teks)

        return jsonify({'status': 'success', 'status_gizi': hasil_teks})

    except Exception as e:
        import traceback
        print(">> ERROR:", traceback.format_exc())  # ← INI KUNCINYA
        return jsonify({'status': 'error', 'message': str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000, debug=True)