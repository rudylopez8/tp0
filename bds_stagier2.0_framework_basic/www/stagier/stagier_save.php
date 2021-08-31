<?php
require "../../include/inc_config.php";
//Application de mysqli_real_escape_string aux données du formulaire
extract(array_map("mres",$_POST));
if (isset($btSubmit)) {
    if ($sta_id==0)
        $sql="insert into stagier (sta_id,sta_nom,sta_prenom,sta_ville,sta_code,sta_promo) values (null,'$sta_nom','$sta_prenom','$sta_ville','$sta_code','$sta_promo')";
    else 
        $sql="update stagier set sta_nom='$sta_nom',sta_prenom='$sta_prenom',sta_ville='$sta_ville',sta_code='$sta_code',sta_promo='$sta_promo' where sta_id=$sta_id";
    $result=mysqli_query($link,$sql);
    if ($result===false) {
        echo mysqli_error($link);
        exit();
    }
}
header("location:stagier_liste.php");
?>