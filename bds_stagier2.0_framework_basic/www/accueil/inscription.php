<?php
require "../../include/inc_config.php";
extract(array_map("mres",$_POST));
$message="";
if (isset($btSubmit)) {
        //écriture dans la base de données
        $sql="insert into stagier (sta_id,sta_nom,sta_prenom,sta_ville,sta_code,sta_promo) values (null,'$sta_nom','$sta_prenom','$sta_ville','$sta_code','$sta_promo')";
        $result=mysqli_query($link,$sql); 
        if ($result===false) {
            $message=mysqli_error($link);
        } else 
$message="inscription réussie";
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
    <?php require "../../include/inc_head.php"; ?>
    </head>
<body>
    <a href="#main" class="sr-only">Allez au contenu principal</a>
    <!-- entete de page -->
    <header>
    <?php require "../../include/inc_header.php"; ?>
    </header>
    <!-- liens de navigation -->
    <nav>
    <?php require "../../include/inc_nav.php"; ?>
    </nav>
    <!-- contenu principal -->
    <div id="main">
        <?=$message?>
        <h1>Inscription</h1>
        <form method="post" onsubmit="return verif()">
            <p><label for='sta_nom'>sta_nom : </label><input type='text' name='sta_nom' id='sta_nom' required ></p>
            <p><label for='sta_prenom'>sta_prenom : </label><input type='text' name='sta_prenom' id='sta_prenom' required></p>
            <p><label for='sta_ville'>sta_ville : </label><input type='text' name='sta_ville' id='sta_ville' required></p>
            <p><label for='sta_code'>sta_code : </label><input type='text' name='sta_code' id='sta_code' required></p>
            <p><label for='sta_promo'>sta_promo : </label><input type='text' name='sta_promo' id='sta_promo' required></p>
            <p><input type="submit" name="btSubmit" value="s'inscrire"></p>
        </form>
    </div>
    <!-- pied de page -->
    <footer>
    <?php require "../../include/inc_footer.php"; ?>
    </footer>
</body>
</html>