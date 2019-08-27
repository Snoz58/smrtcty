#include <Wire.h>
#include <DS3231.h>              
#include <avr/sleep.h>                                 
                                 
int wakePin = 2;                 // pin used for waking up  
int led=13;

DS3231 clock;
RTCDateTime dt;

void setup()
{
  Serial.begin(9600);
  
  // Initialize DS3231
  Serial.println("Initialize DS3231");
  delay(100);
  clock.begin();
  pinMode(wakePin, INPUT_PULLUP);  
  pinMode(led, OUTPUT);  
  
  // Disarm alarms and clear alarms for this example, because alarms is battery backed.
  // Under normal conditions, the settings should be reset after power and restart microcontroller.
  clock.armAlarm1(false);
  clock.clearAlarm1();
  
  // Set Alarm1 - Every 20s in each minute
  // setAlarm1(Date or Day, Hour, Minute, Second, Mode, Armed = true)
  clock.setAlarm1(0, 0, 0, 20, DS3231_MATCH_S);
  attachInterrupt(0, wakeUpNow, LOW);
  
  // Check alarm settings
  checkAlarms();
}

void checkAlarms()
{
  RTCAlarmTime a1;  
  RTCAlarmTime a2;

  if (clock.isArmed1())
  {
    a1 = clock.getAlarm1();

    Serial.print("Alarm1 is triggered ");
    switch (clock.getAlarmType1())
    {
      
      case DS3231_MATCH_S:
        Serial.print("when seconds match: ");
        Serial.println(clock.dateFormat("__ __:__:s", a1));
        delay(100);
        break;
        default: 
        Serial.println("UNKNOWN RULE");
        break;
    }
  } 
} 

void wakeUpNow() {  
  // execute code here after wake-up before returning to the loop() function  
  // timers and code using timers (serial.print and more...) will not work here.  
  // we don't really need to execute any special functions here, since we  
  // just want the thing to wake up  
Serial.println("Woke up");
delay(100);
}  

void sleepNow() {  
    set_sleep_mode(SLEEP_MODE_PWR_DOWN);    // sleep mode is set here  
    sleep_enable();                         // enables the sleep bit in the mcucr register  
    attachInterrupt(0,wakeUpNow, FALLING);  // use interrupt 0 (pin 2) and run function  
    sleep_mode();                           // here the device is actually put to sleep!!  
    // THE PROGRAM CONTINUES FROM HERE AFTER WAKING UP  
   

    sleep_disable();         // first thing after waking from sleep: disable sleep...  
    detachInterrupt(0);      // disables interrupt 0 on pin 2 so the wakeUpNow code will not be executed during normal running time.  
}  

void loop()
{
  dt = clock.getDateTime();

  Serial.println(clock.dateFormat("d-m-Y H:i:s - l", dt));
  delay(100);
  // Call isAlarm1(false) if you want clear alarm1 flag manualy by clearAlarm1();
  if (clock.isAlarm1())
  {
    Serial.println("ALARM 1 TRIGGERED!");
    digitalWrite(led, HIGH);  
    delay(1000);  
    digitalWrite(led, LOW); 
    Serial.println("Entering sleep"); 
    delay(100); // sleep function called here
    sleepNow(); 
  }
  
 delay(900);
}
