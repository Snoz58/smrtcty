#include <SPI.h>
#include <RH_RF95.h>

#define RFM95_CS      4
#define RFM95_INT     3
#define RFM95_RST     2
#define LED           13

// Paramétrage de la fréquence du module LoRa
#define RF95_FREQ 868.0

// Singleton instance of the radio driver
RH_RF95 rf95(RFM95_CS, RFM95_INT);

void setup() 
{
  pinMode(RFM95_RST, OUTPUT);
  digitalWrite(RFM95_RST, HIGH);

  Serial.begin(115200);
  while (!Serial) {
    delay(1);
  }

  delay(100);

  Serial.println("Feather LoRa TX Test!");

  // manual reset
  digitalWrite(RFM95_RST, LOW);
  delay(10);
  digitalWrite(RFM95_RST, HIGH);
  delay(10);

  while (!rf95.init()) {
    Serial.println("LoRa radio init failed");
    while (1);
  }
  Serial.println("LoRa radio init OK!");

  // Defaults after init are 434.0MHz, modulation GFSK_Rb250Fd250, +13dbM
  if (!rf95.setFrequency(RF95_FREQ)) {
    Serial.println("setFrequency failed");
    while (1);
  }
  Serial.print("Set Freq to: "); Serial.println(RF95_FREQ);

  // Puissance du module (entre 5 et 23 dBm)
  rf95.setTxPower(23, false);
}

void loop()
{
  delay(10000); // attendre 10 secondes entre chaque envoi

  char radiopacket[50] = "$1;1=-3;2=34;65=23456$";

  Serial.print("Sending "); Serial.println(radiopacket);

  delay(10);
  rf95.send((uint8_t *)radiopacket, 50);

  delay(10);
  rf95.waitPacketSent();

}
