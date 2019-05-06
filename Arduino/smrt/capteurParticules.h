/*
  Morse.h - Library for flashing Morse code.
  Created by David A. Mellis, November 2, 2007.
  Released into the public domain.
*/
#ifndef capteurParticules_h
#define capteurParticules_h

#include "Arduino.h"

class capteurParticules
{
  public:
    capteurParticules(int pinP1, int pinP2);
    float calcul(); // Equivalent calccount()
    void releve(); // relevé (dans le main tout les starttime
    
  private:
    int pinP1; // Pin pour les particules PM10
    int pinP2; // Pin pour les particules PM2.5
    unsigned long sampletime_ms;
};

#endif
