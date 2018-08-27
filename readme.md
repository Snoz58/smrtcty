Smart Village
=============


Définition
----------

Ce projet a pour objectif la réalisation d'un système de « Smart City » à l’échelle d’un village.

Il est Open source, et basé sur le plus d'éléments open source possible, côté matériel comme logiciel.

Cette solution se présente sous la forme d'un « kit », réplicable, simple à mettre en place et à utiliser, et polyvalent.

Node / Noeuds
-------------

Cette partie du système est totalement indépendante. Il s'agit de points de relevé d'informations auto alimentés (panneau photovoltaïque) basés autour d'une carte Arduino qui transmet les données collectées par l'intermédiaire d'une liaison sans fil.

Ces nœuds permettent le captage d’information dans l’environnement (pour la version en cours de développement des capteurs concernant la qualité de l’air (Température, Pression, Humidité, Particules...) mais aussi des capteurs plus orientés qualité de l’eau (Température, Ph, niveau…).

Passerelle
----------
La passerelle centralise les informations qu’elle reçoit de la part des différents nœuds.
Elle se présente sous la forme d'un Raspberry Pi associé à un module sans fil, installé dans un bâtiment afin de bénéficier d’un accès internet et d’une alimentation électrique. Elle va récupérer les données des capteurs, et les renvoyer vers une base de donnée distante.

Plateforme de centralisation
----------------------------

Cette dernière partie du système n’est pas matérielle mais logicielle, il s’agit d’un système de tableau de bord qui va permettre de visualiser les données recueillies par le dispositif sous forme de tableau et de graphique.

Transmission Sans Fil
---------------------
Les solutions de transmission de donnée retenues pour ce projet sont toutes basées sur des technologies radio :
 * Radio « standard » 433MHz (appareils domotique, etc).
 * xBee / ZigBee.
 * LoRa, dérivé également de la technologie radio, orienté basse consommation longue portée.

Solution de transmission sans fil sera choisie en fonction des résultat obtenus lors des tests de portée et de la situation dans laquelle le système sera mis en place.
