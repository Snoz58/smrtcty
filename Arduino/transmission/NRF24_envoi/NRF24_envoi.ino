/*
* Arduino Wireless Communication Tutorial
*     Example 1 - Transmitter Code
*                
* by Dejan Nedelkovski, www.HowToMechatronics.com
* 
* Library: TMRh20/RF24, https://github.com/tmrh20/RF24/
*/
#include <SPI.h>
#include <nRF24L01.h>
#include <RF24.h>
//RF24 radio(7, 8); // CE, CSN
RF24 radio(9, 10);
const byte address[6] = "00001";
void setup() {
  // Initialisation du module radio
  radio.begin();
  radio.openWritingPipe(address);
  radio.setPALevel(RF24_PA_MIN);
  radio.stopListening();

  Serial.begin(9600);

}

int timer = 0;
char text[50];

void loop() {
  String str = "Timer : "+String(timer)+" sec.";
  str.toCharArray(text, 20);
  radio.write(&text, sizeof(text));
  delay(500);
  timer ++;
}
