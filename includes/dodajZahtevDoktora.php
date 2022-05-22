<?php
session_start();

require_once 'dbh.inc.php';
require_once 'functions.inc.php';


$jmbgDoktora=$_GET['jmbgd'];
$jmbgP=$_GET['jmbgk'];
$imeDoktora=$_GET['imeD'];
$imeP=$_GET['imeP'];
$EmailP=$_GET['EmailP'];
$Polp=$_GET['PolP'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="UPDATE izabranilekar SET JMBGdoktora='$jmbgDoktora',ImeDoktora='$imeDoktora' WHERE JMBGpacijenta=$jmbgP";



if ($conn->query($sql) === TRUE) {
  echo "Uspesno";
    
    
} else {
    echo "Error updating record: " . $conn->error;
 
}










$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE FROM promenalekara WHERE JMBGdoktora =".$jmbgDoktora." AND JMBGpacijenta=".$jmbgP." ";


if ($conn->query($sql) === TRUE) {
  
   
$conn->close();



$to=$EmailP;

$subject="Odobren vam je zahtev za promenu doktora!";

$message="<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta http-equiv='X-UA-Compatible' content='IE=edge'>
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
<div style='max-width:620px;margin:0 auto;font-family:sans-serif;color:#272727'> 
 <h1 style='background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:#272727;'>
 Odobren vam je zahtev promenu izabranog lekara!
 </h1>
 <h2 style='background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:green;'>
 Vaš izabrani lekar je ".$imeDoktora."
 </h2>
 <p style='color:#272727;'>Link ispod vas vodi do login forme:</p>
 <div style='width:100%;text-align:center;'><a href='http://localhost/ProjekatPhp/login.php' style='font-family:sans-serif;margin:0 auto;text-align:center;padding:10px;background:#34d3b4;border-radius:4px;font-size:20px 10px;color:#fff;cursor:pointer;text-decoration:none;display:inline-block;'>
 Uloguj se!
 </a>
 </div>
 <div style='text-align:center;color:#34d3b4;font-weight:600;'>
 <h2>Vaš Nclinic tim!</h2>
 </div>
</div>
</body>
</html>";


$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From:NClinic<nedzad200010@gmail.com>' . "\r\n";
$headers .= 'Cc: nedzad200010@gmail.com' . "\r\n";

 mail($to, $subject, $message, $headers);
 echo '<script>alert("Uspešno ste promenili izabranog lekara!")</script>';
 echo '<script>window.location.href="../AdminPromenaDoktora.php";</script>'; 
    
} else {
    echo "Error deleting record: " . $conn->error;
 
}

