import serial
ser = serial.Serial()
#ser.port = '/dev/ttyACM1'
ser.port = '/dev/ttyUSB0'
ser.baudrate = 115200
ser.open()

while True:

        ser_bytes = ser.readline()

       	print(ser_bytes)
       # recupcenter = ser_bytes.decode("utf-8").split('$')
        #print(recupcenter[1])

