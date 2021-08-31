<?php
require "../../include/inc_config.php";
$id = (isset($_GET["id"])) ? $_GET["id"] : 0;
//protection contre injection sql
$id=mres($id);
$sql="delete from stagier where sta_id=$id";
$result=mysqli_query($link,$sql);
if ($result===false) {
    echo mysqli_error($link);
    exit();
}
header("location:stagier_liste.php");
?>