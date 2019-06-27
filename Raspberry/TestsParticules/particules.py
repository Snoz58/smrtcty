import serial

fichier = open("donneesparticules.csv", "a")
ser = serial.Serial()
ser.port = '/dev/ttyACM0'
#ser.port = '/dev/ttyUSB0'
ser.baudrate = 115200
ser.open()

while True:

        ser_bytes = ser.readline()

       	print(ser_bytes)
        #fichier.write(line.strip().split('"')[0]+'\r')
        
        recupcenter = ser_bytes.decode("utf-8").split('$')
        print(recupcenter[1])
        fichier.write(recupcenter[1]+'\n')

