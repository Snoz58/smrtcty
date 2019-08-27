# DHT22
Cateur de température et d'humidité

## Programme :

Nom du programme : DHT21.ino
```C++
#include <Adafruit_Sensor.h>
#include <DHT.h>
#include <DHT_U.h>

#define DHTPIN            A2
#define DHTTYPE           DHT22


DHT_Unified dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  dht.begin();
}

void loop() {
  // Delay between measurements.
  delay(1000);

  sensors_event_t event;  
  dht.temperature().getEvent(&event);
  if (isnan(event.temperature)) {
    Serial.println("Error reading temperature!");
  }
  else {
    Serial.print("Temperature: ");
    Serial.print(event.temperature);
    Serial.println(" *C");
  }

  // Get humidity event and print its value.
  dht.humidity().getEvent(&event);
  if (isnan(event.relative_humidity)) {
    Serial.println("Error reading humidity!");
  }
  else {
    Serial.print("Humidity: ");
    Serial.print(event.relative_humidity);
    Serial.println("%");
  }
}
```
## Ressources :

http://www.manuel-esteban.com/lire-une-sonde-dht22-avec-un-arduino/

https://projetsdiy.fr/mesure-humidite-temperature-capteur-dht11-dht22-arduino-raspberry/

http://nagashur.com/blog/2013/06/18/lire-la-valeur-dune-sonde-de-temperature-et-d%E2%80%99hygrometrie-dht11/

https://www.carnetdumaker.net/articles/utiliser-un-capteur-de-temperature-et-dhumidite-dht11-dht22-avec-une-carte-arduino-genuino/
