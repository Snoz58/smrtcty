#include "DHT.h"
#include "Seeed_BMP280.h"
#include <Wire.h>

#define DHTPIN A3

int tempsRafraichissement = 20000;

DHT dht(DHTPIN, DHT22);
BMP280 bmp280;

unsigned long triggerOnP1;
unsigned long triggerOffP1;
unsigned long pulseLengthP1;
unsigned long durationP1;
boolean valP1 = HIGH;
boolean triggerP1 = false;

unsigned long triggerOnP2;
unsigned long triggerOffP2;
unsigned long pulseLengthP2;
unsigned long durationP2;
boolean valP2 = HIGH;
boolean triggerP2 = false;

float countP1;
float countP2;

void setup() {
  Serial.begin(9600);
  dht.begin();
    if(!bmp280.init()) {
    Serial.println("Device not connected or broken!");
  }
  pinMode(1, INPUT);
  pinMode(0, INPUT);
}

void loop() {
  delay(tempsRafraichissement);

// -_-_-_-_-_-_-_-_-_-_-_- //
//          DHT22          //
// -_-_-_-_-_-_-_-_-_-_-_- //

  float Humidite = dht.readHumidity();
  float Temperature = dht.readTemperature();

  // Check if any reads failed and exit early (to try again).
  if (isnan(Humidite) || isnan(Temperature)) {
    Serial.println("Failed to read from DHT sensor!");
    return;
  }

  float Ressenti = dht.computeHeatIndex(Temperature, Humidite, false);

// -_-_-_-_-_-_-_-_-_-_-_- //
//        Baromètre        //
// -_-_-_-_-_-_-_-_-_-_-_- //

  float Pression = bmp280.getPressure();
  float Temperature2 = bmp280.getTemperature();

// -_-_-_-_-_-_-_-_-_-_-_- //
//        Particule        //
// -_-_-_-_-_-_-_-_-_-_-_- //

  valP1 = digitalRead(6); // reads PM 10
  valP2 = digitalRead(5); // reads PM 2.5

  if (valP1 == LOW && triggerP1 == false)
  {
    triggerP1 = true;
    triggerOnP1 = micros();
  }

  if (valP1 == HIGH && triggerP1 == true)
  {
    triggerOffP1 = micros();
    pulseLengthP1 = triggerOffP1 - triggerOnP1;
    durationP1 = durationP1 + pulseLengthP1;
    triggerP1 = false;
  }

  if (valP2 == LOW && triggerP2 == false)
  {
    triggerP2 = true;
    triggerOnP2 = micros();
  }

  if (valP2 == HIGH && triggerP2 == true)
  {
    triggerOffP2 = micros();
    pulseLengthP2 = triggerOffP2 - triggerOnP2;
    durationP2 = durationP2 + pulseLengthP2;
    triggerP2 = false;
  }

    countP1 = calcCount(durationP1);
    countP2 = calcCount(durationP2);
    float PM10count = countP2;
    float PM25count = countP1 - countP2;

    // Assues density, shape, and size of dust to estimate mass concentration from particle
    // count. This method was described in a 2009 paper by Uva, M., Falcone, R., McClellan,
    // A., and Ostapowicz, E.
    // http://wireless.ece.drexel.edu/research/sd_air_quality.pdf

    // begins PM10 mass concentration algorithm
    double r10 = 2.6 * pow(10, -6);
    double pi = 3.14159;
    double vol10 = (4 / 3) * pi * pow(r10, 3);
    double density = 1.65 * pow(10, 12);
    double mass10 = density * vol10;
    double K = 3531.5;
    float PM10conc = (PM10count) * K * mass10;

    // next, PM2.5 mass concentration algorithm
    double r25 = 0.44 * pow(10, -6);
    double vol25 = (4 / 3) * pi * pow(r25, 3);
    double mass25 = density * vol25;
    float PM25conc = (PM25count) * K * mass25;

    // convert numbers to string
    String sPM10count = String(PM10count);
    String sPM25count = String(PM25count);
    
    String sPM10conc = String(PM10conc);
    String sPM25conc = String(PM25conc);

    durationP1 = 0;
    durationP2 = 0;


// -_-_-_-_-_-_-_-_-_-_-_- //
// Affichage des résultats //
// -_-_-_-_-_-_-_-_-_-_-_- //

  Serial.print("Humidité : ");
  Serial.print(Humidite);
  Serial.println(" % ");
  
  Serial.print("Température : ");
  Serial.print(Temperature);
  Serial.println(" °C ");

  Serial.print("Température 2 : ");
  Serial.print(Temperature2);
  Serial.println(" °C ");  

  Serial.print("Température ressentie : ");
  Serial.print(Ressenti);
  Serial.println(" *C ");

  Serial.print("Pression : ");
  Serial.print(Pression);
  Serial.println(" Pa "); 

  Serial.print("Particules PM10 : ");
  Serial.print(sPM10conc);
  Serial.println(" ug/m3 "); 


  Serial.println("Fin du relevé -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-");

}


float calcCount (unsigned long duration){

  float ratio = 0;
  float count = 0;

  // Generates PM10 and PM2.5 count from LPO. Derived from code created by Chris Nafis
  // http://www.howmuchsnow.com/arduino/airquality/grovedust/

  ratio = duration / (tempsRafraichissement * 10.0);
  count = 1.1 * pow(ratio, 3) - 3.8 * pow(ratio, 2) + 520 * ratio + 0.62;
  return count;

}
