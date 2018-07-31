void setup()
{
  pinMode(13, INPUT);          // sets the digital pin 13 as output
  Serial.begin(9600);
}

void loop()
{
  Serial.print(digitalRead(13));

//  digitalWrite(13, HIGH);       // sets the digital pin 13 on
//  delay(1000);                  // waits for a second
//  digitalWrite(13, LOW);        // sets the digital pin 13 off
  delay(1000);                  // waits for a second
}
