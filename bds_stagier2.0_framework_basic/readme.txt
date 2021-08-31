** Framework Mysqli basic 2020/2021 **
* - pour installer faker : composer install
|-- document : cahier des charge, documentation, script sql...etc
|-- include : fichiers php inclus
   |-- inc_config : fichier de configuration inclus dans toutes les pages qui démarre une session, crée un connexion à la BDD et inclus "inc_fonction.php"
   |-- inc_fonction.php : fonctions utiles
   |-- inc_footer.php : pied de page
   |-- inc_head.php : entête de page (bandeau supérieur)
   |-- inc_header.php : entête HTML (charge les fichiers css et js)
   |-- inc_nav.php : barre de navigation principale
|-- www : racine du site web
   |-- _css : fichiers css
   |-- _dataset : génération d'un jeu de données
   |-- _generateur : générateur du CRUD des tables de la BDD
   |-- _img : fichiers images
   |-- _js : fichiers javascript
   |-- accueil : module par défaut, page d'acceuil
   |-- <module> : pages du site organisées par modules. Pour les pages du CRUD on a :
      |-- nom_de_la_table_edit.php : formulaire d'édition/création
      |-- nom_de_la_table_delete.php : requête DELETE : supprime un enregistrement
      |-- nom_de_la_table_liste.php : requête SELECT : affiche la liste des enregistrements
      |-- nom_de_la_table_save.php : requêtes INSERT et UPDATE
   |-- index.php : redirection vers /accueil/index.php
|-- composer.json : gestion des librairies utilisées. Pour installer les librairies : "composer install"
|-- composer.lock : gestion des librairies
|-- readme.txt : ce document



