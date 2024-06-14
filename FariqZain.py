from flask import Flask, request, jsonify # type: ignore

app = Flask(__name__)

@app.route('/sensor', methods=['POST'])
def sensor_data():
    if request.method == 'POST':
        try:
            data = request.json
            temperature = data['temperature']
            humidity = data['humidity']
            print(f"Temperature: {temperature} °C, Humidity: {humidity} %")
            return jsonify({"message": "Data received", "temperature": temperature, "humidity": humidity}), 200
        except Exception as e:
            return jsonify({"error": str(e)}), 400

if __name__ == '_main_':
    app.run(host='0.0.0.0',port=5000)
