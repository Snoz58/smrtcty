#include "math.h"

int pin = 6;
unsigned long duration;
unsigned long starttime;
unsigned long sampletime_ms = 30000;//sampe 30s ;
unsigned long lowpulseoccupancy = 0;
float ratio = 0;
float concentration = 0;
float concentrationm3 = 0;
float pm25 = 0;
float pm10 = 0;





void setup() {
 Serial.begin(9600);
 pinMode(8,INPUT);
 starttime = millis();//get the current time;
}

void loop() {
 duration = pulseIn(pin, LOW);
 lowpulseoccupancy = lowpulseoccupancy+duration;
 if ((millis()-starttime) > sampletime_ms)//if the sampel time == 30s
 {
 ratio = lowpulseoccupancy/(sampletime_ms*10.0); // Integer percentage 0=>100
 concentration = 1.1*pow(ratio,3)-3.8*pow(ratio,2)+520*ratio+0.62; // using spec sheet curve
 
 concentrationm3 = (1.1*pow(ratio,3)-3.8*pow(ratio,2)+520*ratio+0.62)/0.000283168;
 pm10 = concentrationm3 * 0.00014356324;



    double r10 = 2.6 * pow(10, -6);
    double pi = 3.14159;
    double vol10 = (4 / 3) * pi * pow(r10, 3);
    double density = 1.65 * pow(10, 12);
    double mass10 = density * vol10;
    double K = 3531.5;
    float PM10conc = (pm10) * K * mass10;


double DensityParticle = 1.65*pow(10,12); // Densité moyenne d'une particule en microgramme par mètre cube
double Conversion = 3531.5; // Conversion 0.001 cu ft (comptage du nb de particules par 0.001 cu ft) en m3 

double RayonPM10 = 2.6*pow(10,-6); // Rayon particules PM10 en m

double VolumePM10 = (4/3) * PI * pow(RayonPM10,3); // Volume d'une particule PM10 en m3
double MassePM10 = DensityParticle * VolumePM10; // Masse d'une particule PM10 en microgramme

double ConcentrationPM10 = concentration*Conversion*MassePM10; // Concentration de particules PM10 en microgramme par mètre cube

 
 Serial.print("concentration = ");
 Serial.print(concentration);
 Serial.print(" pcs/0.01cf - ");
 Serial.print(PM10conc);
 Serial.print(" pcs/m3 - ");
 Serial.print(pm10);
 Serial.print(" ug/m3"); 
 Serial.print(ConcentrationPM10);
 Serial.println(" ug/m3"); 
 Serial.println("\n");
 lowpulseoccupancy = 0;
 starttime = millis();
 }
}
