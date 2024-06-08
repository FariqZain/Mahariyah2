import time
from flask import Flask, jsonify, request
app = Flask(__name__)
sensors = []

@app.route('/')
def homepage():
    return 'Hello World from Flask!'

@app.route('/sensor/', methods=['GET', 'POST'])
def endpoint_sensor():
    if request.method == 'GET':
        return jsonify(sensors)
    elif request.method == 'POST':
        data = request.get_json()
        sensors.append(data)
        return jsonify({"message": "Success Insert", "data": data})
    else:
        return jsonify({})


data_sensor = {"humidity": [], "temperature": [], "timestamp": []}


@app.route('/sensor/data', methods=['GET', 'POST'])
def add_data_iot():
    if request.method == 'GET':
        return jsonify(data_sensor)
    elif request.method == 'POST':
        # {
        #     "temperature" : 24,
        #     "humidity" : 40,
        # }
        data = request.get_json()
        temperature = data["temperature"]
        humidity = data["humidity"]
        timestamp = time.time()
        data_sensor['humidity'].append(humidity)
        data_sensor['temperature'].append(temperature)
        data_sensor['timestamp'].append(timestamp)
        return jsonify({
            "data": data,
            "timestamp": timestamp,
            "message": "success"
        })
    else:
        return jsonify({})


if __name__ == '__main__':
    app.run(debug=True)
    