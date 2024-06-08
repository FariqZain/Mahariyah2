#include <WiFi.h>
#include <PubSubClient.h>
#include "DHT.h"
#define DHT22PIN 4


DHT dht(DHT22PIN, DHT22);

// Update these with values suitable for your network.

const char* ssid = "Wokwi-GUEST";
const char* password = "";
const char* mqtt_server = "test.mosquitto.org";
const int port = 1883;

WiFiClient espClient;
PubSubClient client(espClient);
unsigned long lastMsg = 0;
float temp = 0;
float hum = 0;

const char* topic_temperature = "/sensor/data/temperature";
const char* topic_humidity = "/sensor/data/humidity";
const char* topic_command = "/sic/command/mqtt";

void setup_wifi() { //perintah koneksi wifi
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);

  WiFi.mode(WIFI_STA); //setting wifi chip sebagai station/client
  WiFi.begin(ssid, password); //koneksi ke jaringan wifi

  while (WiFi.status() != WL_CONNECTED) { //perintah tunggu esp32 sampi terkoneksi ke wifi
    delay(1000);
    Serial.print(".");
  }

  randomSeed(micros());

  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

void callback(char* topic, byte* payload, unsigned int length) { //perintah untuk menampilkan data ketika esp32 di setting sebagai subscriber
  Serial.print("Message arrived [");
  Serial.print(topic);
  Serial.print("] ");
  for (int i = 0; i < length; i++) { //mengecek jumlah data yang ada di topik mqtt
    Serial.print((char)payload[i]);
  }
  Serial.println();

  // Switch on the LED if an 1 was received as first character
  if ((char)payload[0] == '1') {
    digitalWrite(2, LOW);   // Turn the LED on (Note that LOW is the voltage level
    // but actually the LED is on; this is because
    // it is active low on the ESP-01)
  } else {
    digitalWrite(2, HIGH);  // Turn the LED off by making the voltage HIGH
  }
}

void reconnect() { //perintah koneksi esp32 ke mqtt broker baik itu sebagai publusher atau subscriber
  // Loop until we're reconnected
  while (!client.connected()) {
    Serial.print("Attempting MQTT connection...");
    // perintah membuat client id agar mqtt broker mengenali board yang kita gunakan
    String clientId = "ESP32Client-";
    clientId += String(random(0xffff), HEX);
    // Attempt to connect
    if (client.connect(clientId.c_str())) {
      Serial.println("Connected");
      // Once connected, publish an announcement...
      client.publish("/sic/mqtt", "Hello!"); //perintah publish data ke alamat topik yang di setting
      // ... and resubscribe
      client.subscribe(topic_command); //perintah subscribe data ke mqtt broker
    } else {
      Serial.print("failed, rc=");
      Serial.print(client.state());
      Serial.println(" coba lagi setelah 5 detik ");
      // Wait 5 seconds before retrying
      delay(5000);
    }
  }
}

void setup() {
  pinMode(4, OUTPUT);     // inisialisasi pin 2 / ledbuiltin sebagai output
  Serial.begin(115200);
  setup_wifi(); //memanggil void setup_wifi untuk dieksekusi
  client.setServer(mqtt_server, port); //perintah connecting / koneksi awal ke broker
  client.setCallback(callback); //perintah menghubungkan ke mqtt broker untuk subscribe data
  dht.begin();//inisialiasi komunikasi dengan sensor dht22
}

void loop() {
  if (!client.connected()) {
    reconnect();
  }
  client.loop();

  unsigned long now = millis();
  if (now - lastMsg > 2000) { //perintah publish data
    lastMsg = now;
    float humi = dht.readHumidity();
    float temp = dht.readTemperature();

    String temp_string = String(temp, 2); //membuat variabel temp untuk di publish ke broker mqtt
    client.publish(topic_temperature, temp_string.c_str()); //publish data dari varibel temp ke broker mqtt
    
    String hum_string = String(humi, 1); //membuat variabel hum untuk di publish ke broker mqtt
    client.publish(topic_humidity, hum_string.c_str()); //publish data dari varibel hum ke broker mqtt

    Serial.print("Suhu: ");
    Serial.println(temp);
    Serial.print("Kelembapan: ");
    Serial.println(humi);
  }
}