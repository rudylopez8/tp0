<?php
require "../../include/inc_config.php";
require "inc_generateur.php";
extract($_POST);
$prefixe = isset($prefixe) ? $prefixe : 2;
$_PREFIX_LEN = $prefixe;
$message="";
//liste des tables de la BDD
$tables=getTables();
if (isset($btSubmit)) {
    $menu="";
    foreach($tables as $cle => $table) {
        if (isset($_POST["table$cle"])) {
            genererCRUD($table);
            $message .= "<p><b>$table</b> : crud généré.</p>";
        }

        $menu .= "<a href='../$table/${table}_liste.php'>$table</a>";
    }
    //génération de inc_nav.php
    file_put_contents("inc_nav_generated.php", $menu);   
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
        <h1>Générateur de CRUD</h1>
        <blockquote>
            Après utilisation, pensez à supprimer le module "_generateur" avant la mise en production.
        </blockquote>
        <div id="message">
        <?=$message?>
        </div>
        <h3>Liste des tables</h3>
        <form method="post" onsubmit="return confirm('Etes-vous sûr de vouloir écraser vos fichiers ?')">
			<p>
				<label for="prefixe">Longueur du préfixe pour les noms de champs : </label>
				<input type="number" name="prefixe" id="prefixe" value="<?=$prefixe?>">
			</p>
        <?php
        foreach($tables as $cle=>$table) { 
            //$ck=isset($_POST["table$cle"])? " checked " : "";
			$ck=" checked ";
            ?>			
            <p>                                
                <input type="checkbox" name="table<?=$cle?>" id="table<?=$cle?>" <?=$ck?>>
                <label for="table<?=$cle?>"><?=$table?></label>
            </p>
        <?php }
        ?>
        <input type="submit" name="btSubmit" value="Genérer !">
        </form>
    </div>
    <!-- pied de page -->
    <footer>
        <?php require "../../include/inc_footer.php"; ?>
    </footer>
</body>

</html>