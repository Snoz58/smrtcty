
chaine = '12;1=-3;2=34;65=23456'
usableData = {}

# Sépare la chaîne en parties dans le tableau splittedData (séparateur ";")
splittedData = chaine.split(';')

# Supprime les entrées vides
splittedData = list(filter(None, splittedData))

for i in range(len(splittedData)):
	if i == 0: # Première info --> identifiant du node

		print('ID node = ', splittedData[i])
		usableData["ID"] = splittedData[i]

	else: # Reste des infos --> identifiants des capteurs et valeurs

		# Sépare les valeurs dans le tableau splittedSensors
		splittedSensors = splittedData[i].split('=')
		print('Capteur ',splittedSensors[0],' - Valeur : ',splittedSensors[1])
		usableData[splittedSensors[0]] = splittedSensors[1]

# Tableau trié des données récupérées
print (usableData)

