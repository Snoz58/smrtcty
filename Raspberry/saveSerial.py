import mysql.connector

# Connexion à la base
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="root",
  database="SmartVillageTEST"
)

mycursor = mydb.cursor()

sql = "INSERT INTO Units (Label, Unite, Symbol) VALUES (%s, %s, %s)"


# Dans l'ordre Label, Unite, Symbol
values = ("Vitesse", "Mètre par seconde", "m/s")
mycursor.execute(sql, values)

# Envoi de la transaction
mydb.commit()

print(mycursor.rowcount, "entrées insérées.")
