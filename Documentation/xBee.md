# XBee

![module xBee](Images/XBee_1.png)

## Paramétrage :

Les modules xBee sont différents des autres modules utilisées jusqu'à présent, ils possèdent en effet une mémoire et un firmware spécifique, avec des adresses.

Pour la configuration de ces modules, il est nécessaire d'utiliser le logiciel XCTU, fourni par DIGI (producteur des modules xBee)

Le logiciel est disponible [ici](https://www.digi.com/support/productdetail?pid=3352) dans la section ***Diagnostics,Utilities and MIBs***

* XCTU version 6.4.0 (dernière version en date)
* Legacy XCTU, version 5.2.8.6 (génération précédente)

## Problèmes rencontrés :

La plupart des tutoriels utilisent un [USB explorer ](https://www.sparkfun.com/products/11812) pour connecter le xBee à l'ordinateur. Ne possédans pas cet appareil, j'ai donc utilisé une carte arduino ([UNO](https://www.sparkfun.com/products/11021) et [MEGA](https://www.sparkfun.com/products/11061)) associé à un [shield xbee](https://www.gotronic.fr/art-module-xbee-shield-12427.htm).

J'ai donc commencé mes tests avec XCTU V6.4.0 et le module xBee connecté au shield sur l'Arduino MEGA.

La découverte des modules connecté au pc est possible avec le second bouton en haut à gauche de l'écran :

![bouton discover xctu](Images/XBee_2.png)

Une popup s'ouvre alors en listant les ports COM disponibles, on selectionne celui correspondant à l'Arduino avant de cliquer sur *Next* :

![popup discover xctu](Images/XBee_3.png)

S'ouvrent alors les paramètres de recherche des modules, et on peut cliquer sur *Finish* pour lancer la recherche :

![port parameters xctu](Images/XBee_4.png)

Le module devrait alors apparaître sur le côté gauche de l'écran :

![module xctu](Images/XBee_5.png)

*** Premier problème : ***

À ce moment, la carte Arduino et le module associé sont donc reconnus par le logiciel, mais les paramètres internes ne le sont pas encore, on sélectionne donc l'option *Read* :

![Read xctu](Images/XBee_6.png)

Une pop up s'affiche alors en demandant de reset notre module radio :

![action required xctu](Images/XBee_7.png)

Cependant, ni le bouton reset ni le bouton présent sur le shield ne permettent de débloquer cet écran.

Après avoir suivi [ce tuto](https://learn.sparkfun.com/tutorials/exploring-xbees-and-xctu/troubleshooting#reset) pour reset un module xBee en connectant le pin 5 (reset) au pin 10 (GND). La LED présente sur le shield s'éteint puis se rallume, indiquant le reset du module, mais la popup reste cependant, jusqu'à se transformer en message d'erreur au bout d'un certain temps.

Apres recherche, il s'avère que les versions précédentes du logiciel ne nécessitent pas cette action, j'ai donc tenté de l'utiliser avec l'aide de [ce tuto](https://robotic-controls.com/book/export/html/14) d'utiliser la version "legacy" de xctu.

La carte Arduino sans son microcontrolleur a donc été couplé au shield dont les jumpers sont passés en mode *USB* :

![Uno sans uc](Images/XBee_8.png)

Sur le logiciel, la carte Arduino est bien reconnue par le logiciel:

![old xctu](Images/XBee_9.png)

Après avoir cliqué sur le bouton *Test / Query*  le logiciel reconnaît bien la carte et le module xBee.

Je débranche donc le montage pour le réutiliser avec le logiciel récent.

*** Deuxième problème ***

Sur le "nouveau" xctu, à la fin de la recherche de module xBee, après avoir correctement sélectionné le bon port, aucun module xBee n'est trouvé, ou bien une erreur apparaît indiquant un timeout sans que le logiciel n'ait pu récupérer les informations de la carte :

![module xBee](Images/XBee_10.png)

![module xBee](Images/XBee_11.png)

De retour sur la version Legacy de xctu, le logiciel nous demande maintenant de reset le module xBee. Comme relevé dans le premier problème, même en connectant le pin RST à la masse, le logiciel ne se débloque pas comme il devrait :

![module xBee](Images/XBee_12.png)

![module xBee](Images/XBee_13.png)

Au final, avec la carte Arduino MEGA, ou avec la carte Arduino UNO, avec ou sans microcontrôleur, avec les jumpers en mode USB ou xBee, et sur les deux logiciels, le résultat est le même : aucune connexion n'est possible entre le logiciel et le module xBee.
J'ai également essayé avec un troisième module xBee, qui ne m'avait pas encore servi, et le résultat est resté le même.  

Prochains tests à la réception de l'adaptateur xBee vers USB.

## Test envoi / réception

/
