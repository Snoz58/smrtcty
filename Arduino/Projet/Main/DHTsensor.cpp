#include "DHTsensor.h"


float getTemp(char pindht, char typedht){
  DHT dht(pindht, typedht);
  float temp = dht.readTemperature();
  if (isnan(temp))
    return 9999;
  else
    return temp;
}


float getHeatIndex(DHT dht, float temp, float hum){
  float hic = dht.computeHeatIndex(temp, hum, false);
  return hic;
}


float getHum(DHT dht){
  float hum = dht.readHumidity();
  if (isnan(hum))
    return 9999;
  else
    return hum;
}
