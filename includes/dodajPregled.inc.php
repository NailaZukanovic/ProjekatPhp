<?php
session_start();


require_once "dbh.inc.php";
require_once "functions.inc.php";

$jmbgDok=$_GET['jmbg'];
$datum=$_GET['datum'];
$vreme=$_GET['vreme'];

$jmbgkor=$_SESSION['jmbg'];
$idr=$_GET['idr'];
$imeKorisnika=PronadjiDoktora($conn,$jmbgkor);





$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$sql="INSERT INTO pregledi (JMBGkor,JMBGdok,DatumPregleda,VremePregleda,ImeKorisnika) VALUES('$jmbgkor','$jmbgDok','$datum','$vreme','$imeKorisnika');";

if ($conn->query($sql) === TRUE) {
    echo "Uspesno";


} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);



if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM raspored WHERE id=$idr ;";


if ($conn->query($sql) === TRUE) {
  
    echo '<script>alert("Uspešno ste dodali doktora!")</script>';
    echo '<script>window.location.href="../profil.php";</script>';
    
} else {
    echo "Error deleting record: " . $conn->error;
   
}


$conn->close();


?>
