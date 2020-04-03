# Présentation

Ce plugin Jeedom/NextDom fait parti d'un ensemble de plugins permettant l'aide au maintien à domicile des personnes âgées : SeniorCare.

La demande initiale vient de ce sujet sur le forum : [Développer un logiciel d’Analyse comportementale](https://community.jeedom.com/t/developper-un-logiciel-danalyse-comportementale/19111).

Ce plugin permet :
* la surveillance du confort du logement : température, humidité, CO2, …
* de générer des alertes de sécurité (détecteur de fumées, gaz, ...)

Les actions d'alerte peuvent être n'importe quelle action Jeedom : gestion lampe, avertisseur sonore, notification sur smartphone, sms, email, message vocal, ...

Lien vers le code source : [https://github.com/AgP42/seniorcare/](https://github.com/AgP42/seniorcarecomfortsecurity/)

Si vous souhaitez participer au projet, n’hésitez pas à le faire savoir ici [Développer un logiciel d’Analyse comportementale](https://community.jeedom.com/t/developper-un-logiciel-danalyse-comportementale/19111)

# Documentation du plugin

[Documentation](https://agp42.github.io/seniorcarecomfortsecurity/fr_FR/)

[Change log](https://agp42.github.io/seniorcarecomfortsecurity/fr_FR/changelog)


# Installation du plugin via Github

1. Télécharger le zip contenant les sources sur github
2. Dézipper-le dans le dossier plugin de votre Jeedom, pour celà plusieurs possibilités :
   - En FTP ou SSH, le dossier plugin se trouve dans /var/www/html/plugins (sur un RPI en tout cas...)
   - En utilisant le plugin "JeeXplorer" téléchargeable sur le market Jeedom, puis naviguer dans "plugin", créer le dossier et copier/coller les sources (dézippées)
3. Dans Jeedom, aller dans "plugin"/"gestion des plugins", trouver le plugin et activez le
