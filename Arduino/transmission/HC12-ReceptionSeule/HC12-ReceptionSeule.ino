//HC-12 messenger send/receive
//autor Tom Heylen tomtomheylen.com

#include <SoftwareSerial.h>

SoftwareSerial mySerial(2, 3); //RX, TX

void setup() {
  Serial.begin(1200);
  mySerial.begin(1200);
  pinMode(LED_BUILTIN, OUTPUT);
}

void loop() {
  
  
  if(mySerial.available() > 1){//Read from HC-12 and send to serial monitor
    String input = mySerial.readString();
    //String input = mySerial.read();
    if (input.substring(0,1) == "1"){
      Serial.println("LEDON");
      digitalWrite(LED_BUILTIN, HIGH);
    }
    else if (input.substring(0,1) == "0"){
      Serial.println("LEDOFF");
      digitalWrite(LED_BUILTIN, LOW);
    }
    Serial.println("chaine recue : "+input+" sub"+input.substring(0,1));    
  }


 
  delay(10);
}
