<?php
require "../../include/inc_config.php";
$sql="select * from stagier";
$result = mysqli_query($link,$sql);
if ($result===false) {
    echo mysqli_error($link);
    exit();
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
        <table>
            <caption><a href="stagier_edit.php?id=0">Créer enregistrement</a></caption>
            <thead>
                <tr>
                    <th>sta_id</th><th>sta_nom</th><th>sta_prenom</th><th>sta_ville</th><th>sta_code</th><th>sta_promo</th>
                    <th>Edition</th>
                    <th>Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    //Application de htmlspecialchar à chaque élement de $row
                    extract(array_map("hsc",$row));    
                    ?>
                <tr>
                    <td><?=$sta_id?></td><td><?=$sta_nom?></td><td><?=$sta_prenom?></td><td><?=$sta_ville?></td><td><?=$sta_code?></td><td><?=$sta_promo?></td>
                    <td><a href="stagier_edit.php?id=<?=$sta_id?>">Edition</a></td>
                    <td><a href="stagier_delete.php?id=<?=$sta_id?>">Suppression</a></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- pied de page -->
    <footer>
    <?php require "../../include/inc_footer.php"; ?>
    </footer>
</body>
</html>