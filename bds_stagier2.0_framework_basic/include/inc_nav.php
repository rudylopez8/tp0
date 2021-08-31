<?php if (isset($_SESSION["ok"])) {?>
    <a href='../accueil/index.php'>Accueil</a>
    <a href='../media/media_liste.php'>media</a>
    <a href='../auteur/auteur_liste.php'>auteur</a>
    <a href='../categorie/categorie_liste.php'>categorie</a>
    <a href='../accueil/deconnexion.php'>Déconnexion</a>
<?php } else { ?>
    <a href='../accueil/index.php'>Accueil</a>
    <a href='../accueil/inscription.php'>Inscription</a>
    <a href='../stagier/stagier_liste.php'>liste_stagier</a>


<?php } ?>