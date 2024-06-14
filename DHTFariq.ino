#include <WiFi.h>
#include <HTTPClient.h>
#include "DHT.h" //memasukan library dht11

// mendefinisikan sensor yang dipakai (DHT11, DHT21, dan DHT22)
#define DHTTYPE DHT11 // tipe yang dipilih DHT 11

// Nama wifi yang akan dikHidupeksikan
const char* ssid = "fariqzain";
// masukan password wifinya
const char* password = "12345678";

WiFiServer server(80);


const int DHTPin = 2;
// inisialisasi library DHTpin
DHT dht(DHTPin, DHTTYPE);

void setup() {
  Serial.begin(115200);
  dht.begin();

  Serial.println();
  // Mengkoneksikan ke wifi
  Serial.print("Menghubungkan ke jaringan... "); Serial.println(ssid);

  // Mulai koneksikan dengan via wifi
  WiFi.begin(ssid, password);

  // syarat kondisi pengkoneksian
  while (WiFi.status() != WL_CONNECTED) {
    delay(300); Serial.print(".");
  } Serial.println("");
  Serial.println("Jaringan WiFi terkoneksi");

  // memulai server
  server.begin(); Serial.println("Koneksi Server dimulai");

  Serial.print("alamat IP yang untuk pengaksesan: ");
  // penulisan alamat ip
  Serial.print("http://");
  // IP address
  Serial.print(WiFi.localIP()); Serial.println("/");
}

void loop() {
  // mengecek jika client sudah terkoneksi
  WiFiClient client = server.available();
  // jika tidak client yang terkoneksi
  if (!client) { 
    sendSensorData(); // Kirim data sensor ke server eksternal setiap loop
    return; 
  }

  Serial.println("Koneksi baru");
  // Jika sudah ada client baru maka
  while (!client.available()) {
    delay(5);
  }

  if (client) {
    boolean blank_line = true;
    while (client.connected()) {
      if (client.available()) {
        char c = client.read();

        if (c == '\n' && blank_line) {
          // Pembacaan sensor juga bisa sampai 2 detik 'lama' (sensornya sangat lambat)
          float h = dht.readHumidity();
          // Baca suhu sebagai Celsius (default)
          float t = dht.readTemperature();
          // Baca suhu sebagai Fahrenheit (apakah Fahrenheit = benar)
          float f = dht.readTemperature(true);
          // Periksa apakah ada yang membaca gagal dan keluar lebih awal (coba lagi)
          if (isnan(h) || isnan(t) || isnan(f)) {
            Serial.println("Failed to read from DHT sensor!");
          } else {
            Serial.print("Kelembaban : ");
            Serial.print(h);
            Serial.println("%");

            Serial.print("Suhu : ");
            Serial.print(t);
            Serial.print(" *C ");
           
          }

          // Menuliskan dalam format HTML
          client.println("HTTP/1.1 200 OK"); client.println("Content-Type: text/html");
          client.println("Connection: close"); client.println();

          // Halaman web Anda yang sebenarnya menampilkan suhu dan kelembaban
          client.println("<!DOCTYPE HTML>");
          client.println("<html>");
          client.println("<head></head><body><h1>MAHARIYAH 2 MUHAMMAD FARIQ ZAIN - Suhu dan Kelembaban Sensor DHT11</h1><h3>Suhu: ");
          client.println(t);//celsiusTemp
          client.println("</h3><h3>Kelembaban: ");
          client.println(h);
          client.println("%</h3><h3>");
          client.println("</body></html>");
          break;
        }
        if (c == '\n') {
          // Saat mulai membaca baris baru
          blank_line = true;
        } else if (c != '\r') {
          // Ketika menemukan karakter pada baris saat ini
          blank_line = false;
        }
      }
    }
    // Menutup koneksi klien
    delay(5);
  }
}

void sendSensorData() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;

    // Your Domain name with URL path or IP address with path
    http.begin("http://192.168.25.127:5000/sensor"); // Ganti dengan IP dan port server Anda

    // Specify content-type header
    http.addHeader("Content-Type", "application/json");

    // Reading temperature and humidity
    float h = dht.readHumidity();
    float t = dht.readTemperature();

    if (isnan(h) || isnan(t)) {
      Serial.println("Failed to read from DHT sensor!");
      return;
    }

    // Create JSON object
    String httpRequestData = "{\"temperature\":\"" + String(t) + "\",\"humidity\":\"" + String(h) + "\"}";

    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);

    // If you need an HTTP response code
    if (httpResponseCode > 0) {
      String response = http.getString(); // Get the response to the request
      Serial.println(httpResponseCode);   // Print return code
      Serial.println(response);           // Print request answer
    } else {
      Serial.print("Error on sending POST: ");
      Serial.println(httpResponseCode);
    }

    // Free resources
    http.end();
  } else {
    Serial.println("WiFi Disconnected");
  }
  delay(10000); }
