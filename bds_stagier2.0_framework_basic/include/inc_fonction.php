<?php
/*
affiche un tableau PHP à 2 dimension dans un tableau HTML
- $tab : tableau php à 2 dimension
*/
function arrayToHTML(array $tab)
{
    //Si $tab n'est pas vide alors on récupère le nom des champs à partir de la 1ere ligne
    if (count($tab) > 0)
        $entete = array_keys($tab[0]);
    else
        $entete = [];

    echo "<table border='1'>";
    echo "<caption> Nombre d'enregistrement : " . count($tab) . "</caption>";
    //entete du tableau HTML
    echo "<thead>";
    echo "<tr>";
    foreach ($entete as $valeur)
        echo "<th>$valeur</th>";
    echo "</tr>";
    echo "</thead>";
    //corps du tableau HTML
    echo "<tbody>";
    foreach ($tab as $cle => $ligne) {
        echo "<tr>";
        foreach ($ligne as $valeur) {
            //la fonction htmlspecialchars permet de se protéger contre l'injection de code HTML/javascript
            echo "<td>" . nl2br(htmlspecialchars($valeur, ENT_QUOTES)) . "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

//lit un fichier CSV et le retourne sous la forme d'un array
function lireData(string $nomFichier): array
{
    $tab = file($nomFichier);
    foreach ($tab as $ligne) {
        $data[] = explode(";", trim($ligne));
    }
    return $data;
}

//protection contre injection HTML et javascript
function hsc($x)
{
    return htmlspecialchars($x, ENT_QUOTES);
}

//protection contre injection sql
function mres($x)
{
    global $link;
    return mysqli_real_escape_string($link, $x);
}

function createDatabase($file)
{
    global $link;
    $sql = file_get_contents($file);
    if (mysqli_multi_query($link, $sql)) {
        $data = [];
        $compteur = 0;
        do {
            /* Stockage du premier résultat */
            $data[$compteur] = [];
            if ($result = mysqli_store_result($link)) {
                $data[$compteur] = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            if (mysqli_more_results($link))
                $compteur++;
        } while (@mysqli_next_result($link));
    }
}

//Liste déroulante des villes
function OPTION_ville(int $selected_id)
{
    global $link;
    $res = mysqli_query($link, "select * from ville order by vi_nom");
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach ($data as $ligne) {
        extract(array_map("hsc", $ligne));
        $sel = ($selected_id == $vi_id) ? " selected " : "";
        echo "<option value='$vi_id' $sel>$vi_nom</option>";
    }
}

//Liste déroulante des avions
function OPTION_avion(int $selected_id)
{
    global $link;
    $res = mysqli_query($link, "select * from avion order by av_const,av_modele");
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach ($data as $ligne) {
        extract(array_map("hsc", $ligne));
        $sel = ($selected_id == $av_id) ? " selected " : "";
        echo "<option value='$av_id' $sel>$av_const - $av_modele</option>";
    }
}

//Liste déroulante des pilotes
function OPTION_pilote(int $selected_id)
{
    global $link;
    $res = mysqli_query($link, "select * from pilote order by pi_nom");
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach ($data as $ligne) {
        extract(array_map("hsc", $ligne));
        $sel = ($selected_id == $pi_id) ? " selected " : "";
        echo "<option value='$pi_id' $sel>$pi_nom</option>";
    }
}

//Liste déroulante des supports
function OPTION_support(int $selected_id)
{
    global $link;
    $res = mysqli_query($link, "select * from support order by su_id");
    $data = mysqli_fetch_all($res, MYSQLI_ASSOC);
    foreach ($data as $ligne) {
        extract(array_map("hsc", $ligne));
        $sel = ($selected_id == $su_id) ? " selected " : "";
        echo "<option value='$su_id' $sel>$su_label</option>";
    }
}
