int timer = 0;

void setup()
{
Serial.begin (9600); 
}

void loop()
{
Serial.println("Message : "+String(timer)+" Sec."); 
timer++;
delay(1000); // Attendre 1s
}
