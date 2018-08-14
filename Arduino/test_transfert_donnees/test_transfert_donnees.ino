#define IDnode 1

#define PINtempAir 6
#define IDtempAir 2

void setup() {

    Serial.begin(9600);
    pinMode(LED_BUILTIN, OUTPUT);

}
  String message = "";

void loop() {

  initMessage(&message);
  
  Serial.println("message1 : ");
  addSensorValue(&message, 3, 22.5); 
  Serial.println(message);

  Serial.println("message 2 : ");
  addSensorValue(&message, 3, 22.5); 
  Serial.println(message);
 
}

void initMessage(String *message){
  *message = "["+String(IDnode)+"]";
}

void addSensorValue(String *message, int sensor, float value){
  String addedMessage = ";"+String(sensor)+"="+value;
  *message += addedMessage; 
  
}
