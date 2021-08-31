<?php
//préfixe par défaut
$_PREFIX_LEN = 2;

function getTables()
{
    global $link;
    $tables = [];
    $result = mysqli_query($link, "show tables");
    while ($row = mysqli_fetch_row($result))
        $tables[] = $row[0];

    return $tables;
}

function getChamps($table)
{
    global $link;
    $champs = [];
    $result = mysqli_query($link, "show columns from $table");
    while ($row = mysqli_fetch_row($result))
        $champs[] = $row[0];

    return $champs;
}

function genererCRUD($table)
{
	global $_PREFIX_LEN;
    //nom de la clé primaire
    $pk = substr($table, 0, $_PREFIX_LEN) . "_id";
    //liste des champs
    $champs = getChamps($table);
    //création du dossier table
    @mkdir("../$table");

    //fichier table_liste.php
    $chaine = file_get_contents("template/xxx_liste.txt");
    $chaine = str_replace("[table]", $table, $chaine);
    $chaine = str_replace("[pk]", $pk, $chaine);
    $chaine = str_replace("[thChamp]", thChamp($champs), $chaine);
    $chaine = str_replace("[tdValeur]", tdValeur($champs), $chaine);
    file_put_contents("../" . $table . "/" . $table . "_liste.php", $chaine);

    //fichier table_edit.php
    $chaine = file_get_contents("template/xxx_edit.txt");
    $chaine = str_replace("[table]", $table, $chaine);
    $chaine = str_replace("[pk]", $pk, $chaine);
    $chaine = str_replace("[initChamp]", initChamp($champs), $chaine);
    $chaine = str_replace("[inputChamp]", inputChamp($champs,$pk), $chaine);
    file_put_contents("../" . $table . "/" . $table . "_edit.php", $chaine);

    //fichier table_save.php
    $chaine = file_get_contents("template/xxx_save.txt");
    $chaine = str_replace("[table]", $table, $chaine);
    $chaine = str_replace("[pk]", $pk, $chaine);
    $chaine = str_replace("[listeChamp]", listeChamp($champs), $chaine);
    $chaine = str_replace("[listeValeur]", listeValeur($champs,$pk), $chaine);
    $chaine = str_replace("[listeChampValeur]", listeChampValeur($champs,$pk), $chaine);
    file_put_contents("../" . $table . "/" . $table . "_save.php", $chaine);

    //fichier table_delete.php
    $chaine = file_get_contents("template/xxx_delete.txt");
    $chaine = str_replace("[table]", $table, $chaine);
    $chaine = str_replace("[pk]", $pk, $chaine);    
    file_put_contents("../" . $table . "/" . $table . "_delete.php", $chaine);   
}

function thChamp($tab)
{
    $s = "";
    foreach ($tab as $nom)
        $s .= "<th>$nom</th>";
    return $s;
}

function tdValeur($tab)
{
    $s = "";
    foreach ($tab as $nom)
        $s .= "<td><?=\$$nom?></td>";
    return $s;
}

function initChamp($tab)
{
    $s = "";
    foreach ($tab as $nom)
        $s .= "\$$nom='';";
    return $s;
}

function inputChamp($tab, $pk)
{
    $s = "";
    foreach ($tab as $nom) {
        if ($nom != $pk) {
            $s .= "<p>";
            $s .= "<label for='$nom'>$nom : </label>";
            $s .= "<input type='text' name='$nom' id='$nom' value='<?=\$$nom?>'>";
            $s .= "</p>";
        }
    }
    return $s;
}

//liste des champs : champ1, champ2, champ3...
function listeChamp($tab) {
    return implode(",",$tab);
}

//liste des valeurs, sauf le champs PK  $champ1,$champ2...
function listeValeur($tab,$pk) {
    $t = [];
    foreach ($tab as $nom) 
        if ($nom!=$pk)
            $t[]="'\$$nom'";

    return implode(",",$t);
}

//liste sauf champ PK de : champ1=$champ1, champ2=$champ2, ...etc
function listeChampValeur($tab,$pk) {
    $t=[];
    foreach ($tab as $nom) 
        if ($nom!=$pk)
            $t[]="$nom='\$$nom'";

    return implode(",",$t);
}