/*
 Interface to Shinyei Model PPD42NS Particle Sensor
 Program by Christopher Nafis 
 Written April 2012
 
 http://www.seeedstudio.com/depot/grove-dust-sensor-p-1050.html
 http://www.sca-shinyei.com/pdf/PPD42NS.pdf
 
 JST Pin 1 (Black Wire)  => Arduino GND
 JST Pin 3 (Red wire)    => Arduino 5VDC
 JST Pin 4 (Yellow wire) => Arduino Digital Pin 8
 */

int pin = 8;
unsigned long duration;
unsigned long starttime;
unsigned long sampletime_ms = 30000;
unsigned long lowpulseoccupancy = 0;
float ratio = 0;
float concentration = 0;

void setup() {
  Serial.begin(9600);
  pinMode(8,INPUT);
  starttime = millis();
}

void loop() {
  duration = pulseIn(pin, LOW);
  lowpulseoccupancy = lowpulseoccupancy+duration;

  if ((millis()-starttime) > sampletime_ms)
  {
    ratio = lowpulseoccupancy/(sampletime_ms*10.0);  // Integer percentage 0=>100
    concentration = 1.1*pow(ratio,3)-3.8*pow(ratio,2)+520*ratio+0.62; // using spec sheet curve
    
   
    double DensityParticle = 1.65*pow(10,12); // Densité moyenne d'une particule en microgramme par mètre cube
    double Conversion = 3531.5; // Conversion 0.001 cu ft (comptage du nb de particules par 0.001 cu ft) en m3 

    double RayonPM10 = 2.6*pow(10,-6); // Rayon particules PM10 en m

    double VolumePM10 = (4/3) * PI * pow(RayonPM10,3); // Volume d'une particule PM10 en m3
    double MassePM10 = DensityParticle * VolumePM10; // Masse d'une particule PM10 en microgramme

    double ConcentrationPM10 = concentration*Conversion*MassePM10; // Concentration de particules PM10 en microgramme par mètre cube

    Serial.print(ConcentrationPM10);
    Serial.print(" ug/m3 - ");  
    
    Serial.print(lowpulseoccupancy);
    Serial.print(",");
    Serial.print(ratio);
    Serial.print(",");
    Serial.println(concentration);
    lowpulseoccupancy = 0;
    starttime = millis();
  }
}
