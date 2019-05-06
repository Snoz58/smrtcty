#include "Seeed_BMP280.h"
#include <Wire.h>

BMP280 bmp280;

void setup()
{
  Serial.begin(9600);
  if(!bmp280.init()) {
    Serial.println("Device not connected or broken!");
  }
}

void loop()
{

  float p = bmp280.getPressure();
  float t = bmp280.getTemperature();


  
  Serial.print("Temp: ");
  Serial.print(t);
  
  Serial.print("Pressure: ");
  Serial.println(p);
  

  delay(1000);
}
