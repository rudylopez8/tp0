<?php
require "../../include/inc_config.php";
/**
 * $table : nom de la table
 * $data : table de données multi-enregistrement
 * $nb : nombre d'enregistrement
 */
function insertInto($table, $data, $nb)
{
    global $link;
    $sql = "insert into $table values " . implode(",", $data);
    $result = mysqli_query($link, $sql);
    if (!$result) {
        echo $sql;
        echo mysqli_error($link);
    }
    echo "<p>Création des données de $table : $nb</p>";
}

extract($_POST);
if (isset($btSubmit)) {
    require "../../vendor/autoload.php";
    $faker = Faker\Factory::create('fr_FR');

    //création de la bdd
    createDatabase("../../document/mediatheque.sql");

    //création des categories
    $nbc = 10;
    $data = [];
    for ($i = 1; $i <= $nbc; $i++) {
        $cat_label=mres($faker->jobTitle);
        $data[] = "(null,'$cat_label')";
    }
    insertInto("categorie", $data, $nbc);

    //création des auteurs
    $nba = 50;
    $data = [];
    for ($i = 1; $i <= $nba; $i++) {
        $aut_nom=mres($faker->lastName . $i);
        $data[] = "(null,'$aut_nom')";
    }
    insertInto("auteur", $data, $nba);

    //création des medias
    $nbm = 100;
    $data = [];
    for ($i = 1; $i <= $nbm; $i++) {
        $cat = mt_rand(1, $nbc);
        $med_nom=mres($faker->catchPhrase);
        $data[] = "(null,'$med_nom',$cat)";
    }
    insertInto("media", $data, $nbm);

    //création des users
    $nbu = 5;
    $data = [];
    for ($i = 1; $i <= $nbu; $i++) {
        $pwd = password_hash("user $i", PASSWORD_DEFAULT);
        $data[] = "(null,'user $i', '$pwd')";
    }
    insertInto("utilisateur", $data, $nbu);


    //création des associations media <=> auteur
    $data = [];
    //tableau des id auteurs
    $temp = range(1, $nba);
    //pour chaque media
    $cpt = 0;
    for ($i = 1; $i <= $nbm; $i++) {
        //définir combien d'auteur
        $x = mt_rand(1, 5);
        $cpt += $x;
        //mélanger les auteurs
        shuffle($temp);
        for ($j = 0; $j < $x; $j++)
            $data[] = "(null,$temp[$j], $i)";
    }
    insertInto("creer", $data, $cpt);
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
    <nav id="navigation">
        <?php require "../../include/inc_nav.php"; ?>
    </nav>
    <!-- contenu principal -->
    <div id="main">
        <h1>création du jeu de données</h1>
        <form method="post">
            <p>Générer les données <input type="submit" name="btSubmit" value="OK"></p>
        </form>
    </div>
    <!-- pied de page -->
    <footer>
        <?php require "../../include/inc_footer.php"; ?>
    </footer>
</body>

</html>