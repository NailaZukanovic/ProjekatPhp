<?php
session_start();
$jmbgDoktora=$_GET["jmbg"];
$imeDoktora=$_GET["Ime"];

$imeP=$_SESSION["ime"];
$jmbgP=$_SESSION["jmbg"];
$EmailP=$_SESSION["Email"];
$Polp=$_SESSION["Pol"];

require_once "dbh.inc.php";
require_once "functions.inc.php";


PromeniDoktora($conn,$jmbgDoktora,$imeDoktora,$imeP,$jmbgP,$EmailP,$Polp);