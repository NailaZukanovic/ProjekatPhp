<?php
session_start();
$jmbgDoktora=$_GET["jmbg"];
$imeDoktora=$_GET["Ime"];

$imeP=$_SESSION["ime"];
$jmbgP=$_SESSION["jmbg"];
$EmailP=$_SESSION["Email"];
$Polp=$_SESSION["Pol"];

echo " ".$jmbgDoktora;
echo " ".$imeDoktora;
echo " ".$imeP;
echo " ".$EmailP;
echo " ".$Polp;

echo " ".$jmbgP;
require_once "dbh.inc.php";
require_once "functions.inc.php";



izabranilekar($conn,$jmbgDoktora,$imeDoktora,$imeP,$jmbgP,$EmailP,$Polp);





