#include <Wire.h>
#include <Esp32WifiManager.h>
#include <HTTPClient.h>

// Ganti dengan SSID dan password WiFi Anda
const char* ssid = "RKB XII IPS 1";
const char* password = "";

// Ganti dengan alamat server dan endpoint yang Anda gunakan
const char* serverName = "panicbautton.my.id";
const char* url = "/jumlah_pushup";

//#define alamat_raspberry 0x0
const int address = 0x08;

void setup() {
  Serial.begin(115200);

  // Sambungkan ke jaringan WiFi
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");

  // Inisialisasi I2C
  Wire.begin(address);
}

void loop() {
  // Baca data dari Raspberry Pi
  Wire.requestFrom(address, 1);
  if (Wire.available() > 0) {
    int data = Wire.read();

    // Buat objek HTTPClient dan kirim data
    HTTPClient http;
    //http.begin(serverName + url);
    String url_lengkap = String(serverName) + url;
    WiFiClient client;
    
    http.begin(client, url_lengkap);
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");
    int httpCode = http.POST("jumlah_pushup=" + String(data));

    // Periksa status respons
    if (httpCode == HTTP_CODE_OK) {
      Serial.println("Data berhasil dikirim");
    } else {
      Serial.printf("Gagal mengirim data. Kode status: %d\n", httpCode);
    }

    http.end();
  }
}
