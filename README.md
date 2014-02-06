Déclare Nounou
========================

Déclare Nounou est une application web développée sous symfony2.4.0.

Cette application permet de gérer les heures, le salaire et la déclaration CAF de la nourrice.

Plusieurs fonctionnalités sont/seront disponibles :

* ajouter, modifier, lire et supprimer la fiche d'un enfant [done]
* ajouter, modifier, lire et supprimer la fiche d'une nourrice [done]
* ajouter, modifier, lire et supprimer le contrat d'une nourrice [done]
* s'inscrire, se connecter, modifier son profil [done]
* envoyer un mail à l'administrateur pour son accord à l'inscription [todo]
* ajouter, modifier, lire et supprimer les heures réalisées d'une nourrice [todo]
* calcul du salaire en fonction des heures réalisées et des heures du contrat [todo]
* récapitulatif des données mensuelles pour la déclaration CAF (pajemploi) [todo]
* envoyer la fiche de paie au format pdf par mail à la nourrice [todo]
* créer, modifier, lire un planning prévisionnel annuel [todo]
* se connecter à pajemploi [todo]


Installation
----------------------------------


### Composer


Pour installer les dépendances nécessaires, téléchargez Composer et exécutez la commande suivante :

    php composer.phar install

Afin d'obtenir les différents icônes utilisés dans l'application, veuillez télécharger 
[Elusive-Icons Webfont](http://shoestrap.org/downloads/elusive-icons-webfont/) et copier le
dossier complet dans "web/css".


### Configuration


Personnalisez votre configuration dans le fichier app/config/parameters.yml avec votre
base de données et vos paramètres smtp pour l'envoie de mail.


### Assetic


Pour minimifier et réunir les fichiers css et js exécutez la commande :

    php app/console assetic:dump --env=prod --no-debug


Les dépendances
---------------


L'application contient les bundles suivants :

  * **friendsofsymfony/user-bundle** - Gestion des utilisateurs

  * **winzou/console-bundle** - Accés à la console sur le serveur

  * **jms/security-extra-bundle** - Sécuriser l'accés à certaines pages grâce aux annotations