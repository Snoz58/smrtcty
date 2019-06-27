import urllib

fichier = open("listemodif2.txt", "a")
with open("liste.txt", "r") as f:
    for line in f.readlines():
        # Traiter la ligne et ainsi de suite ...
        
        urllib.urlretrieve ("www.technirevue.com/revue_technique/Revue-technique-renault-21.pdf", "PDF/test.pdf")

        #fichier.write(line.strip().split('"')[0]+'\r')
        #print(line.strip().split('"')[0])
        #print(line.strip())
fichier.close()



