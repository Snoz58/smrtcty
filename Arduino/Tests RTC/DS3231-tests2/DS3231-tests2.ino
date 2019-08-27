// #include <LowPower.h>
#include <DS3232RTC.h>        // https://github.com/JChristensen/DS3232RTC
// #include <Streaming.h>        // http://arduiniana.org/libraries/streaming/
#include <Wire.h>
 
/*  _   _               
 * | |_(_)_ __  ___ _ _ 
 * |  _| | '  \/ -_) '_|
 *  \__|_|_|_|_\___|_|  
 *                      
 * Some simple code to test the idea of using a DS3231 module's "alarm"
 * functions to periodically wake up an Arduino which is in POWER_DOWN
 * mode so that it will do something interesting.   This is really just
 * a skeleton now, but will serve as an outline for a more advanced sensor
 * sketch.
 *
 * Written by mvandewettering@gmail.com
 */
 
const int wakeupPin = 2 ;
 
volatile int woken = 0 ;
 
void
wakeUp()
{
    woken = 1 ;
}
 
void
setup()
{
    pinMode(wakeupPin, INPUT_PULLUP) ;
    pinMode(LED_BUILTIN, OUTPUT) ;
 
    Serial.begin(115200) ;
    delay(50) ;
    Serial.println(F("WAKING UP...")) ;
 
    Serial.println(F("I2C set to 400K")) ;
    Wire.setClock(400000) ;
 
    setSyncProvider(RTC.get);   // the function to get the time from the RTC
    if(timeStatus() != timeSet)
        Serial.println("Unable to sync with the RTC");
    else
        Serial.println("RTC has set the system time");
 
    Serial.print("::: INITIAL TIME ") ;
    //printDateTime(RTC.get()+7UL*3600UL) ;
    Serial.print(RTC.get());
    Serial.println() ;
    delay(50) ;
 
    // initialize the alarms to known values, 
    // clear the alarm flags, clear the alarm interrupt flags
    // ALARM_1 will trigger at 30 seconds into each minute
    // ALARM_2 will trigger every minute, at 0 seconds.
    RTC.setAlarm(ALM1_MATCH_SECONDS, 30, 0, 0, 0);
    //RTC.setAlarm(ALM2_EVERY_MINUTE, 0, 0, 0, 0);
 
     
    // clear both alarm flags
    RTC.alarm(ALARM_1); 
    //RTC.alarm(ALARM_2);
 
    // We are going to output the alarm by going low onto the 
    // SQW output, which should be wired to wakeupPin
    RTC.squareWave(SQWAVE_NONE);
 
    // Both alarms should generate an interrupt
    RTC.alarmInterrupt(ALARM_1, true);
    //RTC.alarmInterrupt(ALARM_2, true);
}
 
void
loop()
{
    // The INT/SQW pin from the DS3231 is wired to the wakeup pin, and
    // will go low when the alarm is triggered.  We are going to trigger
    // on the falling edge of that pulse.
    attachInterrupt(digitalPinToInterrupt(wakeupPin), wakeUp, FALLING) ;
 
    // Go into powerdown mode, waiting to be woken up by INT pin...
    //LowPower.powerDown(SLEEP_FOREVER, ADC_OFF, BOD_OFF) ;
    Serial.println("sleep ?");
    //sleep_enable(); //activation du mode sleep
 
    // For now, let's just ignore transitions on this pin...
    detachInterrupt(digitalPinToInterrupt(wakeupPin)) ;
 
    // We have to clear the alarm condition to make the pin go back to
    // the high state.   I'm clearing both of them, because we are 
    // triggering every 30 seconds (in this example)
    RTC.alarm(ALARM_1) ; RTC.alarm(ALARM_2) ; 
 
    // Now, we can do whatever we want to do.  For now, we just get 
    // the current time and the temperature (which doesn't appear to 
    // work, and will be what I'm investigating next)
 
    // printDateTime(RTC.get()+7UL*3600UL) ;
    Serial.print(RTC.get());
    Serial.print(" ") ;
    Serial.println(RTC.temperature()) ;
    delay(50) ; // allow serial to drain, otherwise we'll go to sleep
        // before the buffer empties.
     
}
/* 
void 
printDateTime(time_t t)
{
    Serial << ((day(t)<10) ? "0" : "") << _DEC(day(t)) << ' ';
    Serial << monthShortStr(month(t)) << ' ' << _DEC(year(t)) << ' ';
    Serial << ((hour(t)<10) ? "0" : "") << _DEC(hour(t)) << ':';
    Serial << ((minute(t)<10) ? "0" : "") << _DEC(minute(t)) << ':';
    Serial << ((second(t)<10) ? "0" : "") << _DEC(second(t));
}
*/
