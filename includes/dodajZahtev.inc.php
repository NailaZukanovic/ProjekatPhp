<?php
session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


$jmbg=$_GET['jmbg'];
$KorisnickoIme=$_GET['useruid'];
$Email=$_GET['email'];
$Ime=$_GET['ime'];
$Datum=$_GET['datum'];
$Mesto=$_GET['mesto'];
$Pol=$_GET['pol'];

$vrsta='doktor';
$slika='images/ourteam3.png';

$PWD=PronadjiPassword($conn,$jmbg);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO user (Ime,Email,KorisnickoIme,PWD,vrsta,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol,slika) VALUES('$Ime','$Email','$KorisnickoIme','$PWD','$vrsta','$jmbg','$Mesto','$Datum','$Pol','$slika');";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



$sql = "DELETE FROM zahtev WHERE JMBG = $jmbg;";


if ($conn->query($sql) === TRUE) {
  

    
} else {
    echo "Error deleting record: " . $conn->error;
 
}


$conn->close();

$to=$Email;

$subject="Odobren vam je zahtev za doktora!";

$message='<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<style>
@media only screen and (max-width:620px){
    .h1{
        font-size:20px;
        padding:5px;
    }
}
</style>
</head>
<body>
<div>
<div style="max-width:620px;margin:0 auto;font-family:sans-serif;color:#272727"> 
 <h1 style="background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:#272727;">
 Odobren vam je zahtev!
 </h1>
 <p style="color:#272727;">Link ispod vas vodi do login forme:</p>
 <div style="width:100%;text-align:center;"><a href="http://localhost/ProjekatPhp/login.php" style="font-family:sans-serif;margin:0 auto;text-align:center;padding:10px;background:#34d3b4;border-radius:4px;font-size:20px 10px;color:#fff;cursor:pointer;text-decoration:none;display:inline-block;">
 Uloguj se!
 </a>
 </div>
 <div style="text-align:center;color:#34d3b4;font-weight:600;">
 <h2>Vaš Nclinic tim!</h2>
 </div>
</div>
</body>
</html>';


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From:NClinic<nedzad200010@gmail.com>' . "\r\n";
$headers .= 'Cc: nedzad200010@gmail.com' . "\r\n";

 mail($to, $subject, $message, $headers);*/
 echo '<script>alert("Uspešno ste dodali doktora!")</script>';
 echo '<script>window.location.href="../adminZahtevi.php";</script>';