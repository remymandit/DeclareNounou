Déclare Nounou
========================

[![Build Status](https://travis-ci.org/remymandit/DeclareNounou.png?branch=master)](https://travis-ci.org/remymandit/DeclareNounou)

[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/remymandit/DeclareNounou/badges/quality-score.png?s=b646fa0630123531fe1a6bf56d84797b7e931f35)](https://scrutinizer-ci.com/g/remymandit/DeclareNounou/)

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/212ef98e-d99e-44b9-9fb1-8bdc2c701cb8/mini.png)](https://insight.sensiolabs.com/projects/212ef98e-d99e-44b9-9fb1-8bdc2c701cb8)

Déclare Nounou est une application web développée sous symfony2.8.7.

Cette application permet de gérer les heures, le salaire et la déclaration CAF de la nourrice.

Plusieurs fonctionnalités sont/seront disponibles :

* ajouter, modifier, lire et supprimer la fiche d'un enfant [done]
* ajouter, modifier, lire et supprimer la fiche d'une nourrice [done]
* ajouter, modifier, lire et supprimer le contrat d'une nourrice [done]
* s'inscrire, se connecter, modifier son profil [done]
* inscription béta [work in progress]
* ajouter, modifier, lire et supprimer les heures réalisées d'une nourrice [work in progress]
* calcul du salaire en fonction des heures réalisées et des heures du contrat [todo]
* récapitulatif des données mensuelles pour la déclaration CAF (pajemploi) [todo]
* envoyer la fiche mensuelle au format pdf par mail à la nourrice [todo]
* créer, modifier, lire un planning prévisionnel annuel [todo]
* se connecter à pajemploi [todo]
* administration du site [todo]


Installation
----------------------------------


### Composer


Pour installer les dépendances nécessaires, téléchargez [Composer](https://getcomposer.org/)
 et exécutez la commande suivante :

    php composer.phar install


### Configuration


Personnalisez votre configuration dans le fichier app/config/parameters.yml avec votre
base de données et vos paramètres smtp pour l'envoi de mail.

Pour créer la base de données exécutez la commande  suivante :

    php app/console doctrine:database:create

Puis pour générer les tables et le schéma :

    php app/console doctrine:schema:update --force


### Assetic


L'application utilise les bibliothèques uglifycss et uglify-js, il faut donc 
télécharger [NodeJs](http://nodejs.org/).
Pour minimifier et réunir les fichiers css et js exécutez la commande :

    php app/console assetic:dump --env=prod --no-debug


Les dépendances
---------------


L'application contient les bundles suivants :

  * **friendsofsymfony/user-bundle** - Gestion des utilisateurs

  * **jms/security-extra-bundle** - Sécuriser l'accés à certaines pages grâce aux annotations
  
  * **doctrine/doctrine-fixtures-bundle** - Ajouter des fixtures (jeu de données) pour les tests
