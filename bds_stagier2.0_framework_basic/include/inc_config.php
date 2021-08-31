<?php
session_start();
const APP_NAME="gestion_stagiers !";
const APP_SLOGAN="Gérer tous vos stagiers";
$_SESSION["debug"]=false;

//connexion à la base de données
$link = mysqli_connect("localhost","root","","bdstagier");

require "inc_fonction.php";
