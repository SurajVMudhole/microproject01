//----Include Header files here
#include <WiFi.h>
#include <WiFiClient.h>
#include <HTTPClient.h>
#include <SPI.h>
#include <MFRC522.h>
//------------------------------------------------
/* 
Pin connections :
SCK    =>  D18
MISO   =>  D19
MOSI   =>  D23
SDA    =>  D5
RST    =>  D22
LED    =>  D2
Buzzer =>  D15
*/
//---Define Constants 
#define SS_PIN 5
#define RST_PIN 22
MFRC522 rfid(SS_PIN, RST_PIN);
const char* ssid = "k20pro"; //--> Your wifi name or SSID.
const char* password = "nishads08"; //--> Your wifi password.
const int led=2;
const int buzzer=15;
//--------------------------------------------------------------
//--------------------------------------------------------------
void setup(){
  
  Serial.begin(115200);

  delay(500);
 
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password); //--> Connect to your WiFi router
  Serial.println("");
  Serial.print("Connecting");
   while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
   }
  Serial.println("");
  Serial.print("Successfully connected to : ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  Serial.println();
  //Initialize RFID----
   SPI.begin();
  rfid.PCD_Init();
   pinMode(led,OUTPUT);
   pinMode(buzzer,OUTPUT);
}
//--------------------------------------------------------------------------
//----------------------------------------------------------------------------

void loop(){
  String UID = "";
  if (rfid.PICC_IsNewCardPresent() && rfid.PICC_ReadCardSerial()){
    //READ_CARD(); 
   digitalWrite(led,HIGH);
  digitalWrite(buzzer,LOW);
  delay(1000);
  digitalWrite(buzzer,HIGH);
  digitalWrite(led,LOW);
  delay(1000);
    for (byte i = 0; i < rfid.uid.size; i++) {
      UID += (rfid.uid.uidByte[i] < 0x10 ? "0" : "");
      UID += String(rfid.uid.uidByte[i], HEX);
    }
     Serial.println("----------**************---------- ");
     Serial.println("----------**************---------- ");
     Serial.println("");
    Serial.print("Card UID: ");
    Serial.println(UID);
    rfid.PICC_HaltA(); // Halt PICC
    rfid.PCD_StopCrypto1(); // Stop encryption on PCD
    //------------------------------------SEND DATA
    HTTPClient http; //--> Declare object of class HTTPClient
    String  LinkGet, getData;
     LinkGet = "http:// 192.168.43.247/project/test.php"; //--> Make a Specify request destination
     getData = "UID=" + UID;
   Serial.println("----------------Connect to Server-----------------");
  Serial.println("Get LED Status from Server or Database");
  Serial.print("Request Link : ");
  Serial.println(LinkGet);
  http.begin(LinkGet); //--> Specify request destination
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");    //Specify content-type header
  int httpCodeGet = http.POST(getData); //--> Send the request
  Serial.print("Response Code : "); //--> If Response Code = 200 means Successful connection, if -1 means connection failed. 
  Serial.println(httpCodeGet); //--> Print HTTP return code
 Serial.println("----------------Closing Connection----------------");
  http.end(); //--> Close connection
  Serial.println();
  Serial.println("Please wait 1 seconds for the next connection.");
  Serial.println();
  delay(1000); //--> GET Data at every 5 seconds
  }
  delay(5000);
}

//void READ_CARD(void)
