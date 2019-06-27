#include <SPI.h>
#include <RH_RF95.h>

#include "DHT.h"

#include "Seeed_BMP280.h"
#include <Wire.h>


#define DHTPIN 6    
#define DHTTYPE DHT22  

#define RFM95_CS      4
#define RFM95_INT     3
#define RFM95_RST     5
#define LED           13

// Paramétrage de la fréquence du module LoRa
#define RF95_FREQ 868.0

// Singleton instance of the radio driver
RH_RF95 rf95(RFM95_CS, RFM95_INT);

DHT dht(DHTPIN, DHTTYPE);

BMP280 bmp280;

int idNode = 1;
int idTemperature = 1;
int idHumidite = 4;
int idPression = 2;

void setup() 
{
  pinMode(RFM95_RST, OUTPUT);
  digitalWrite(RFM95_RST, HIGH);

  Serial.begin(115200);

  dht.begin();

  if(!bmp280.init()) {
    Serial.println("Device not connected or broken!");
  }
  
  while (!Serial) {
    delay(1);
  }

  delay(100);

  Serial.println("Feather LoRa TX Test!");

  // manual reset
  digitalWrite(RFM95_RST, LOW);
  delay(10);
  digitalWrite(RFM95_RST, HIGH);
  delay(10);

  while (!rf95.init()) {
    Serial.println("LoRa radio init failed");
    while (1);
  }
  Serial.println("LoRa radio init OK!");

  // Defaults after init are 434.0MHz, modulation GFSK_Rb250Fd250, +13dbM
  if (!rf95.setFrequency(RF95_FREQ)) {
    Serial.println("setFrequency failed");
    while (1);
  }
  Serial.print("Set Freq to: "); Serial.println(RF95_FREQ);

  // Puissance du module (entre 5 et 23 dBm)
  rf95.setTxPower(23, false);
}

void loop()
{
  delay(30000); // attendre 10 secondes entre chaque envoi

  float humidite = dht.readHumidity();
  float temperature1 = dht.readTemperature();

  float pression = bmp280.getPressure();
  float temperature2 = bmp280.getTemperature();

  float temperature = (temperature1 + temperature2)/2;

char radiopacket[50];

  String chaineEnvoi = "$";
  chaineEnvoi += idNode;
  chaineEnvoi += ";";
  
  chaineEnvoi += idTemperature;
  chaineEnvoi += "=";
  chaineEnvoi += temperature;
  chaineEnvoi += ";";

  chaineEnvoi += idHumidite;
  chaineEnvoi += "=";
  chaineEnvoi += humidite;
  chaineEnvoi += ";";

  chaineEnvoi += idPression;
  chaineEnvoi += "=";
  chaineEnvoi += pression;
  chaineEnvoi += "$";

  
  chaineEnvoi.toCharArray(radiopacket, 50);
  // char radiopacket[50] = "$"+idNode+";"+idTemperature+"="+temperature+";"+idHumidite+"="+humidite+";65=23456$";

  Serial.print("Sending "); Serial.println(radiopacket);

  delay(10);
  rf95.send((uint8_t *)radiopacket, 50);

  delay(10);
  rf95.waitPacketSent();

}
