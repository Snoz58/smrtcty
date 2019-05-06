/*
  Morse.cpp - Library for flashing Morse code.
  Created by David A. Mellis, November 2, 2007.
  Released into the public domain.
*/

#include "Arduino.h"
#include "capteurParticules.h"

capteurParticules::capteurParticules(int pin)
{
  pinMode(pin, OUTPUT);
  _pin = pin;
}

void Morse::dot()
{
  digitalWrite(_pin, HIGH);
  delay(250);
  digitalWrite(_pin, LOW);
  delay(250);  
}

void releve() {
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

    txtMsg = "PM10count " + sPM10count + " PM10 " + sPM10conc + " PM25count " + sPM25count + " PM25 " + sPM25conc;
    Serial.println(txtMsg);

    durationP1 = 0;
    durationP2 = 0;
    starttime = millis();  
}

float calcul(unsigned long duration){

  float ratio = 0;
  float count = 0;

  // Generates PM10 and PM2.5 count from LPO. Derived from code created by Chris Nafis
  // http://www.howmuchsnow.com/arduino/airquality/grovedust/

  ratio = duration / (sampletime_ms * 10.0);
  count = 1.1 * pow(ratio, 3) - 3.8 * pow(ratio, 2) + 520 * ratio + 0.62;
  return count;

}
