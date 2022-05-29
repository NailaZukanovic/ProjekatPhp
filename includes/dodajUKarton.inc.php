

<?php
session_start();

require_once "functions.inc.php";
require_once "dbh.inc.php";
$jmbg=$_SESSION["JmbgKor"];
 $jmbgDok=$_SESSION["jmbg"];
$datump=$_SESSION["Datum_Pregleda"];
$vremep=substr($_SESSION["Vreme_Pregleda"],0,5);
$anamneza=$_POST["anamneza"];
$dijagnoza=$_POST["dijagnoza"];
$lečenje=$_POST["lečenje"];

if (isEmptyKarton($anamneza,$dijagnoza,$lečenje)!==false) {
    header("location:../KartonDodaj.php?state=emptyinput&jmbgKorisnika=".$jmbg."&datum=".$datump."&vreme=".$vremep."");
    exit();
    
}



if(KartonProvera($conn,$vremep,$datump)===1)
{
    header("location:../KartonDodaj.php?state=alreadyExists&jmbgKorisnika=".$jmbg."&datum=".$datump."&vreme=".$vremep."");
    exit();

}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO karton (JMBGKorisnika,JMBGlekara,Anamneza,Dijagnoza,Lečenje,Vreme_Pregleda,Datum_Pregleda) VALUES('$jmbg','$jmbgDok','$anamneza','$dijagnoza','$lečenje','$vremep','$datump');";

if ($conn->query($sql) === TRUE) {
  
    header("location:../KartonDodaj.php?state=success&jmbgKorisnika=".$jmbg."&datum=".$datump."&vreme=".$vremep."");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

