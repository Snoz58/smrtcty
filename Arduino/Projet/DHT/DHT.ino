#include "DHT.h"
#include "Seeed_BMP280.h"
#include <Wire.h>

#define DHTPIN A1
#define DHTTYPE DHT22 


DHT dht(DHTPIN, DHTTYPE);
BMP280 bmp280;


void setup() {
  Serial.begin(9600);
  Serial.println("DHTxx test!");

  dht.begin();
  
  Serial.begin(9600);
  if(!bmp280.init()) {
    Serial.println("Device not connected or broken!");
  }
}

void loop() {

  delay(2000);

  float p = bmp280.getPressure();
  float t2 = bmp280.getTemperature();
  

  float h = dht.readHumidity();
  float t = dht.readTemperature();
  float hic = dht.computeHeatIndex(t, h, false);

Serial.print("Grove : ");
Serial.print(t2);
Serial.print(" | DHT : ");
Serial.print(t);
Serial.print(" | OneWire : ");
Serial.println("");

//  Serial.print("Température : ");
//  Serial.println(t2);
  
//  Serial.print("Pression : ");
//  Serial.println(p);


//  Serial.print("Humidité : ");
//  Serial.println(h);

//  Serial.print("Temperature : ");
//  Serial.println(t);

//  Serial.print("Ressenti : ");
//  Serial.println(hic);

}
