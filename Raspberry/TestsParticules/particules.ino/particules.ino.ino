
//Set variables for PM10 and PM2,5 readings
 unsigned long starttime;
 unsigned long sampletime_ms = 60000; // TIME BETWEEN MEASURES AND UPDATES

unsigned long triggerOnP2;
 unsigned long triggerOffP2;
 unsigned long pulseLengthP2;
 unsigned long durationP2;
 boolean valP2 = HIGH;
 boolean triggerP2 = false;
 float ratioP2 = 0;
 float countP2;
 float concLarge;

unsigned long triggerOnP1;
 unsigned long triggerOffP1;
 unsigned long pulseLengthP1;
 unsigned long durationP1;
 boolean valP1 = HIGH;
 boolean triggerP1 = false;
 float ratioP1 = 0;
 float countP1;
 float concSmall;


void setup() {
 pinMode(4, INPUT); //PM2,5
 pinMode(5, INPUT);// PM10
 Serial.begin(115200);
 delay(10);

 Serial.println("$DEBUT!!!$");
}

void measure(){
 valP1 = digitalRead(4); // Small ( pm2.5)
 valP2 = digitalRead(5); // Large ( pm10 )

//--------PM2,5-------------

if(valP1 == LOW && triggerP1 == false){
 triggerP1 = true;
 triggerOnP1 = micros();
 }

if (valP1 == HIGH && triggerP1 == true){
 triggerOffP1 = micros();
 pulseLengthP1 = triggerOffP1 - triggerOnP1;
 durationP1 = durationP1 + pulseLengthP1;
 triggerP1 = false;
 }

//-----------PM10------------

if(valP2 == LOW && triggerP2 == false){
 triggerP2 = true;
 triggerOnP2 = micros();
 }

if (valP2 == HIGH && triggerP2 == true){
 triggerOffP2 = micros();
 pulseLengthP2 = triggerOffP2 - triggerOnP2;
 durationP2 = durationP2 + pulseLengthP2;
 triggerP2 = false;
 }

//----------Calcolo-----------

if ((millis() - starttime) > sampletime_ms) {

// Integer percentage 0=>100
 ratioP1 = durationP1/(sampletime_ms*10.0); // Integer percentage 0=>100
 ratioP2 = durationP2/(sampletime_ms*10.0);
 countP1 = 1.1*pow(ratioP1,3)-3.8*pow(ratioP1,2)+520*ratioP1+0.62;
 countP2 = 1.1*pow(ratioP2,3)-3.8*pow(ratioP2,2)+520*ratioP2+0.62;
 float PM10count = countP2;
 float PM25count = countP1 - countP2;

//PM10 count to mass concentration conversion
 double r10 = 2.6*pow(10,-6);
 double pi = 3.14159;
 double vol10 = (4/3)*pi*pow(r10,3);
 double density = 1.65*pow(10,12);
 double mass10 = density*vol10;
 double K = 3531.5;
 concLarge = (PM10count)*K*mass10;

//PM2.5 count to mass concentration conversion
 double r25 = 0.44*pow(10,-6);
 double vol25 = (4/3)*pi*pow(r25,3);
 double mass25 = density*vol25;
 concSmall = (PM25count)*K*mass25;

//----Debug of Values on Serial Port----
 String envoi = "$"+String(concLarge)+","+String(concSmall)+"$";
 Serial.println(envoi);
// Serial.print(concLarge);
// Serial.print(",");
// Serial.print(concSmall);

//Reset Values
 durationP1 = 0;
 durationP2 = 0;
 starttime = millis();

}
 }

void loop() {

measure(); // Recall of the measure program
 }
