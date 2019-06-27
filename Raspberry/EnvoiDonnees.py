

#http://air-lormes.nivernaismorvan.net/insertData.php?value=12&node=1&unit=1&sensor=1


import urllib.request
import serial

ser = serial.Serial()
#ser.port = '/dev/ttyACM1'
ser.port = '/dev/ttyUSB0'
ser.baudrate = 115200
ser.open()

#Tableau de correspondance idCapteur --> idUnite
correspondanceUnite = ["x", 1, 2, 8, 9]

#Clé pour sécuriser le formulaire d'insertion des données sur le serveur
key = "wrvqgy97wQlKXPugKiLPSzhnWRcJezpztqtSfKux"


while True:

	ser_bytes = ser.readline()

	#print(ser_bytes)
	#Forme de la chaine : $idNode,idCapteur1=valeurCapteur1,idCapteur2=valeurCapteur2,idCapteur3=valeurCapteur3$
	#Exemple : $1,1=21,2=12,3=67$ (node 1, capteur 1 = 21, capteur 2 = 12, capteur 3 = 67
	
	#Récupértion de la partie données uniquement (supression des caractères de début et de fin de la chaine)
	recupcenter = ser_bytes.decode("utf-8").split('$')
	chaine = recupcenter[1]

	usableData = {}

	# Sépare la chaîne en parties dans le tableau splittedData (séparateur ";")
	splittedData = chaine.split(';')

	# Supprime les entrées vides
	splittedData = list(filter(None, splittedData))

	for i in range(len(splittedData)):
		if i == 0: # Première info --> identifiant du node

			#print('ID node = ', splittedData[i])
			usableData["ID"] = splittedData[i]

		else: # Reste des infos --> identifiants des capteurs et valeurs
	
			# Sépare les valeurs dans le tableau splittedSensors
			splittedSensors = splittedData[i].split('=')
			#print('Capteur ',splittedSensors[0],' - Valeur : ',splittedSensors[1])
			usableData[splittedSensors[0]] = splittedSensors[1]
			#print('----------------------------------------')
			url = 'http://air-lormes.nivernaismorvan.net/insertData.php?value='+splittedSensors[1]+'&node='+splittedData[0]+'&unit='+str(correspondanceUnite[int(splittedSensors[0])])+'&sensor='+splittedSensors[0]+'&key=wrvqgy97wQlKXPugKiLPSzhnWRcJezpztqtSfKux'
#			url = 'valeur : '+splittedSensors[1]+' node : '+splittedData[0]+' sensor : '+splittedSensors[0]+' unite : '+str(correspondanceUnite[int(splittedSensors[0])])
			print(url)
			#print('----------------------------------------')
			
			urllib.request.urlopen(url)

	# Tableau trié des données récupérées
	#print (usableData)

