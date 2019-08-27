# GUVA-S12SD
Capteur UV

## Programme
Nom du programme : GUVA-S12SD.ino

```C++
void setup()
{
  Serial.begin(9600);
}

void loop()
{
  float sensorVoltage;
  float sensorValue;

  sensorValue = analogRead(A1);
  sensorVoltage = sensorValue/1024*3.3;
  Serial.print("sensor reading = ");
  Serial.print(sensorValue);
  Serial.println("");
  Serial.print("sensor voltage = ");
  Serial.print(sensorVoltage);
  Serial.println(" V");
  delay(3000);
}
```

## Ressources

https://www.adafruit.com/product/1918

https://forums.adafruit.com/viewtopic.php?f=19&t=95381

https://cdn-shop.adafruit.com/datasheets/1918guva.pdf

http://arduinolearning.com/code/arduino-guva-s12sd-uv-sensor.php
