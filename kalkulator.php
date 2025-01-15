<!DOCTYPE html>
<html>
<head>
    <title>Temukan Rekomendasi Pola Hidup Untuk Anda dari Hasil BMI Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        #result {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
        }

        .recommendation {
            font-size: 16px;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }

        .recommendation img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Temukan Rekomendasi Pola Hidup dari Hasil BMI Anda</h1>
        <form id="bmi-form">
            <div class="form-group">
                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender">
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="age">Umur:</label>
                <input type="text" id="age" name="age" placeholder="Masukkan umur">
            </div>
            <div class="form-group">
                <label for="height">Tinggi Badan (cm):</label>
                <input type="text" id="height" name="height" placeholder="Masukkan tinggi badan">
            </div>
            <div class="form-group">
                <label for="weight">Berat Badan (kg):</label>
                <input type="text" id="weight" name="weight" placeholder="Masukkan berat badan">
            </div>
            <button type="button" onclick="calculateBMI()">Hitung BMI</button>
        </form>
        <div id="result"></div>
        <div id="recommendation" class="recommendation"></div>
    </div>

    <script>
        function calculateBMI() {
            var gender = document.getElementById("gender").value;
            var age = parseFloat(document.getElementById("age").value);
            var height = parseFloat(document.getElementById("height").value);
            var weight = parseFloat(document.getElementById("weight").value);

            if (isNaN(age) || isNaN(height) || isNaN(weight)) {
                document.getElementById("result").innerHTML = "Silakan masukkan data yang valid.";
                document.getElementById("recommendation").innerHTML = "";
                return;
            }

            var bmi = weight / ((height / 100) * (height / 100));
            var bmiStatus;
            var recommendation;
            var imageUrl;
            var imageLink;

            if (bmi < 18.5) {
                bmiStatus = "Kekurangan Berat Badan";
                recommendation = "Untuk Anda yang memiliki BMI rendah, olahraga yang dianjurkan adalah latihan kekuatan seperti angkat beban dan latihan tubuh bagian atas untuk meningkatkan massa otot. Pastikan juga untuk makan dengan cukup kalori dan gizi.";
                imageUrl = "https://i.ibb.co.com/6B2kvhb/Whats-App-Image-2024-07-26-at-13-43-20-02a084ef.jpg";
                imageLink = "https://www.halodoc.com/artikel/lebih-berisi-ini-5-olahraga-untuk-menambah-berat-badan ";
            } else if (bmi >= 18.5 && bmi < 25) {
                bmiStatus = "Normal";
                recommendation = "Anda termasuk dalam kategori berat badan normal. Olahraga yang seimbang seperti jogging, berenang, atau bersepeda selama 150 menit per minggu sudah cukup untuk menjaga kesehatan. Anda bisa juga menambahkan latihan kekuatan dua kali seminggu.";
                imageUrl = "https://i.ibb.co.com/ZW3jtW1/KLIK-DISINI-UNTUK-INFO-LEBIH-LANJUT-20240726-135040-0000.png";
                imageLink = "https://www.halodoc.com/artikel/pola-hidup-sehat-untuk-menjaga-berat-badan-ideal ";
            } else if (bmi >= 25 && bmi < 30) {
                bmiStatus = "Overweight";
                recommendation = "Jika BMI Anda termasuk kategori overweight, olahraga kardio seperti berjalan cepat, berlari, atau bersepeda bisa membantu mengurangi berat badan. Selain itu, latihan kekuatan juga penting untuk membangun otot dan mempercepat metabolisme.";
                imageUrl = "https://i.ibb.co.com/6B2kvhb/Whats-App-Image-2024-07-26-at-13-43-20-02a084ef.jpg";
                imageLink = "https://www.halodoc.com/artikel/5-olahraga-untuk-bantu-atasi-obesitas-pada-orang-dewasa ";
            } else {
                bmiStatus = "Obesitas";
                recommendation = "Untuk Anda dengan BMI tinggi, fokus pada olahraga kardio intensitas rendah hingga sedang seperti berjalan atau bersepeda. Latihan ini membantu membakar kalori tanpa memberikan tekanan berlebih pada sendi. Pastikan untuk berkonsultasi dengan dokter atau ahli kebugaran sebelum memulai program olahraga intensif.";
                imageUrl = "https://i.ibb.co.com/6B2kvhb/Whats-App-Image-2024-07-26-at-13-43-20-02a084ef.jpg";
                imageLink = "https://www.klikdokter.com/gaya-hidup/sehat-bugar/4-olahraga-yang-cocok-untuk-kondisi-obesitas ";
            }

            document.getElementById("result").innerHTML = "Hasil BMI Anda: " + bmi.toFixed(2) + " (" + bmiStatus + ")";
            document.getElementById("recommendation").innerHTML = `<p>${recommendation}</p><a href="${imageLink}" target="_blank"><img src="${imageUrl}" alt="${bmiStatus}"></a>`;
        }
    </script>
</body>
</html>
