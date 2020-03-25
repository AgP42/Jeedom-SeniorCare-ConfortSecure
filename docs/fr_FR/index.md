Présentation
============

Ce plugin fait parti d'un ensemble de plugins pour Jeedom permettant l'aide au maintien à domicile des personnes âgées : SeniorCare.

La demande initiale vient de ce sujet sur le forum : [Développer un logiciel d’Analyse comportementale](https://community.jeedom.com/t/developper-un-logiciel-danalyse-comportementale/19111).

Ce plugin permet :
* la surveillance du confort du logement (température, humidité, CO2, …)
* de générer des alertes de sécurité

Lien vers le code source : [https://github.com/AgP42/seniorcare/](https://github.com/AgP42/seniorcare-confort-security/)

Si vous souhaitez participer au projet, n’hésitez pas à le faire savoir ici [Développer un logiciel d’Analyse comportementale](https://community.jeedom.com/t/developper-un-logiciel-danalyse-comportementale/19111/2)

Avertissement
==========

Ce plugin a été conçu pour apporter une aide aux personnes souhaitant rester chez elles et à leurs aidants.
Nous ne pouvons toutefois pas garantir son bon fonctionnement ni qu'un dysfonctionnement de l’équipement domotique n'arrive au mauvais moment.
Merci de l'utiliser en tant que tel et de ne pas prendre de risque pour la santé de ceux que nous cherchons à aider !

Changelog
==========

Beta 0.0.1 - 24 mars 2020
---

Ce plugin permet :

* Gestion des capteurs de confort
* Gestion des capteurs Sécurité
* Création documentation

Configuration du plugin
========================

Ajouter les différentes personnes à suivre, puis pour chacune configurer les différents onglets.

Onglet Général
---
* Indiquer le nom de la personne
* "Objet parent" : il s'agit de l'objet Jeedom auquel rattacher la personne. Il doit être différent de "Aucun"
* Activer le plugin pour cette personne
* Visible sert a visualiser les infos sur le dashboard

![](https://raw.githubusercontent.com/AgP42/seniorcareconfortsecurity/master/docs/assets/images/Widget.png)
(Passer la souris sur la valeur vous donnera sa date de collecte et cliquer dessus affichera son historique)

Onglet **Confort**
---
Cet onglet permet de regrouper les informations de confort du logement.
Il peut s'agir de la température, ou du taux d'humidité pour certaines pièces et du niveau de CO2.
A partir de 1000 ppm (CO2), il est recommandé d'aérer le logement.
Vous pouvez aussi suivre la température extérieure.

* Définir les différents capteurs de confort du logement à suivre. Il peut s'agit de capteurs de température, d'humidité, de CO2 ou de tout autre type.
  * Vous devez donner un nom unique à chacun de vos capteurs. Attention, le changement de nom d'un capteur revient à le supprimer et a en recréer un nouveau, vous perdez donc l'historique associé.
  * Sélectionner la commande Jeedom du capteur associé. Attention, chaque capteur ne doit être utilisé qu'une seule fois. En cas de nécessité d'utiliser 2 fois la même source, merci de le dupliquer par un virtuel.
  * Définir son type.
  * Définir les seuils haut et bas.
* Définir les actions exécutées pour chaque capteur lors du dépassement de seuil et la gestion voulue pour les répétitions (tant que le capteur est hors seuils)
* Définir (ou non) les actions qui seront exécutées pour chaque capteur lors du retour dans les seuils aprés un dépassement (exécutées à chaque "retour", pour chaque capteur)
* Définir (ou non) les actions à exécuter lorsque tous les capteurs ont leurs valeurs dans les seuils définis

Détails de fonctionnement :
* Toutes les 15 min, Jeedom évaluera pour chacun des capteurs si sa valeur est dans les seuils définis ou non
* Les actions "Actions avertissement (pour chaque capteur hors seuils, je dois ?)" seront alors exécutées pour chaque capteur hors seuils sauf si l'avertissement a déjà été donné pour ce capteur et que l’utilisateur a choisi de ne pas le répéter
* Lorsqu'un capteur précédemment hors seuil revient dans ses bornes, les actions "Actions arrêt l'avertissement - pour chaque capteur de retour dans les seuils, je dois ?" seront alors exécutées pour ce capteur
* Si tous les capteurs sont évalués "dans les seuils", les actions "Actions arrêt l'avertissement - lorsque tous les capteurs sont dans les seuils, je dois ?" seront alors exécutées


Si l'une de vos action est de type "message", vous pouvez utiliser les tags suivants :
  * #senior_name# : nom configuré dans l'onglet "Général"
  * #sensor_name# : nom du capteur ayant déclenché l'avertissement
  * #sensor_type# : type de ce capteur - attention, le type sera donné en anglais
  * #sensor_value# : valeur courante
  * #low_threshold# : seuil bas défini
  * #high_threshold# : seuil haut défini
  * #unit# : unité correspondant à la valeur

![](https://raw.githubusercontent.com/AgP42/seniorcareconfortsecurity/master/docs/assets/images/Confort.png)

Onglet **Sécurité**
---
Cet onglet permet de regrouper les capteurs d'urgennce du logement de la personne dépendante (fumée, fuite de gaz, inondation, …) et aussi les actions d'alerte immédiate vers l’extérieur au cas où la personne ne peut intervenir.

* Définir un ou plusieurs capteurs de sécurité. L'alerte sera déclenchée à chaque changement d'état du capteur, peu importe le sens du changement d'état
* Définir les actions immédiatement réalisées à l'activation de n'importe lequel de ces capteurs
* Définir un ou plusieurs capteurs de type "bouton" ou "interrupteur" servant à annuler l'alerte
* Définir les actions réalisées à l'activation des capteurs d'annulation

Si l'une de vos action est de type "message", vous pouvez utiliser les tags suivants :
  * #senior_name# : nom configuré dans l'onglet "Général"
  * #sensor_name# : nom du capteur ayant déclenché l'alerte (uniquement pour l'alerte et non pour l'annulation d'alerte)
  * #sensor_type# : type de ce capteur - attention, le type sera donné en anglais

![](https://raw.githubusercontent.com/AgP42/seniorcareconfortsecurity/master/docs/assets/images/Securite.png)


Onglet **Avancé - Commandes Jeedom**
---

Vous pouvez visualiser dans cet onglet les différentes commandes crées par ce plugin et les configurer

![](https://raw.githubusercontent.com/AgP42/seniorcareconfortsecurity/master/docs/assets/images/OngletCommandes.png)


Comportement au démarrage et après redémarrage Jeedom
======

Fonction **Confort**
---
RAS

Fonction **Sécurité**
---
RAS

Remarques générales
===
* Pour les capteurs "capteur de sécurité" et "bouton d'annulation d'alerte de sécurité", c'est le changement de valeur du capteur qui est détecté et déclenche les actions, la valeur en elle-même n'est pas prise en compte !
* Pour les capteurs conforts, leur valeur est évaluée toutes les 15 min et non à chaque changement
* L'ensemble des capteurs définis dans le plugin doit posséder un nom unique. Le changement de nom d'un capteur revient à le supprimer et à en créer un nouveau. De fait, la totalité de l'historique associé à ce capteur sera donc perdue.