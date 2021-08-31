<?php
require "../../include/inc_config.php";
$id = (isset($_GET["id"])) ? $_GET["id"] : 0;
if ($id==0) {
    $sta_id='';$sta_nom='';$sta_prenom='';$sta_ville='';$sta_code='';$sta_promo='';
} else {
    $id=mres($id);
    $sql="select * from stagier where sta_id=$id";
    $result = mysqli_query($link,$sql);
    if ($result===false) {
        echo mysqli_error($link);
        exit();
    }
    $row=mysqli_fetch_assoc($result);
    extract(array_map("hsc",$row));
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
        <form method="post" action="stagier_save.php">
            <input type="hidden" name="sta_id" value="<?=$sta_id?>">
            <p>
                <label>sta_id : </label><b><?=$sta_id?></b>
            </p>
            <p><label for='sta_nom'>sta_nom : </label><input type='text' name='sta_nom' id='sta_nom' value='<?=$sta_nom?>'></p><p><label for='sta_prenom'>sta_prenom : </label><input type='text' name='sta_prenom' id='sta_prenom' value='<?=$sta_prenom?>'></p><p><label for='sta_ville'>sta_ville : </label><input type='text' name='sta_ville' id='sta_ville' value='<?=$sta_ville?>'></p><p><label for='sta_code'>sta_code : </label><input type='text' name='sta_code' id='sta_code' value='<?=$sta_code?>'></p><p><label for='sta_promo'>sta_promo : </label><input type='text' name='sta_promo' id='sta_promo' value='<?=$sta_promo?>'></p>
            <p>
                <input type="submit" name="btSubmit" value="Envoyer">
            </p>
        </form>
    </div>
    <!-- pied de page -->
    <footer>
    <?php require "../../include/inc_footer.php"; ?>
    </footer>
</body>
</html>