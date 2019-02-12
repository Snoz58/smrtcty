import serial
ser = serial.Serial()
ser.port = '/dev/ttyACM1'
ser.baudrate = 115200
ser.open()

while True:

        ser_bytes = ser.readline()

        print(ser_bytes)

