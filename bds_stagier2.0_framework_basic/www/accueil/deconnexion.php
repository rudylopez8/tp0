<?php
require "../../include/inc_config.php";
$_SESSION=[];
session_destroy();
header("location:index.php");