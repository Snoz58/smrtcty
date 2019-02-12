//HC-12 messenger send/receive
//autor Tom Heylen tomtomheylen.com

#include <SoftwareSerial.h>

SoftwareSerial mySerial(2, 3); //RX, TX
int i = 0;

void setup() {
  Serial.begin(1200);
  mySerial.begin(1200);
}
int timer = 0;
void loop() {
  mySerial.print("Timer : "+String(timer)+" sec.");

  delay(1000);
  timer ++;
}
