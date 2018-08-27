//HC-12 messenger send/receive
//autor Tom Heylen tomtomheylen.com

#include <SoftwareSerial.h>

SoftwareSerial mySerial(2, 3); //RX, TX
int i = 0;

void setup() {
  Serial.begin(1200);
  mySerial.begin(1200);
}

void loop() {
  if (i){
    mySerial.println(i); 
    i = 0;  
  }
  else { 
    mySerial.println(i); 
    i = 1;
  }
  delay(1000);
}
