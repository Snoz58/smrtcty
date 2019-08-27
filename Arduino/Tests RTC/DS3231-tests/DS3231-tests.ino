#include <avr/sleep.h>
#include <DS3232RTC.h>

#define interruptPin 2
DS3232RTC rtc;

void setup(){
  Serial.begin(115200);
  pinMode(LED_BUILTIN, OUTPUT);
  pinMode (interruptPin, INPUT_PULLUP);
  digitalWrite(LED_BUILTIN, HIGH);

  rtc.squareWave(SQWAVE_NONE);

//  Serial.println(rtc.get());
  
  rtc.alarm( ALARM_1 ); // makes sure A1F is cleared (see datasheet p.14)
  rtc.setAlarm( ALM1_EVERY_SECOND, 0, 0, 0, 0 ); // match seconds = 1 fois par minute // match minutes = 1 fois par heure  

  // attachInterrupt(0, testprint, FALLING);
}

void loop(){

//  Serial.println("ok");
//  digitalWrite(LED_BUILTIN, HIGH);
  delay(5000);
//  Serial.println("5sec later");
  Going_To_Sleep();
}

void Going_To_Sleep(){

  //digitalWrite(LED_BUILTIN, LOW); // éteind la led

//  rtc.alarm( ALARM_1 ); // makes sure A1F is cleared (see datasheet p.14)
//  rtc.setAlarm( ALM1_EVERY_SECOND, 0, 0, 0, 0 ); // match seconds = 1 fois par minute // match minutes = 1 fois par heure  
//  Serial.println("sleep enable");
  sleep_enable(); //activation du mode sleep
  attachInterrupt(0, wakeUp, LOW); // Interrupt pour le réveil su le pin d2
//  Serial.println("sleep mode");
  set_sleep_mode(SLEEP_MODE_PWR_DOWN); // mode sleep --> power down
  digitalWrite(LED_BUILTIN, LOW); // éteind la led
  
  delay(1000); // Attends une seconde
  sleep_cpu(); // passage en mode sleep

  Serial.println("just woke up !");
  digitalWrite(LED_BUILTIN, HIGH);
}

void wakeUp(){
  
  Serial.println("Interrupt fired");
  sleep_disable();

  //rtc.alarm( ALARM_1 ); // makes sure A1F is cleared (see datasheet p.14)
  //rtc.setAlarm( ALM1_MATCH_SECONDS, 0, 0, 0, 0 ); // match seconds = 1 fois par minute // match minutes = 1 fois par heure  
  
  detachInterrupt(0);
}
