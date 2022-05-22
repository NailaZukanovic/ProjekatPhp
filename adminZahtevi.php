<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:home.php");
  exit();
}
?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
 

    <style>

        <?php
   include "style.css"
        ?>
    </style>

</head>

<body>


<?php

include_once './komponente/header.php';
?>
<?php

if(isset($_SESSION["useruid"]))
{


  


}
else
{
    header("location:login.php");
    exit();
}
?>

<div class="one"><h3>Zahtevi za Doktore</h3></div>
<?php
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

$sql = "SELECT Ime,Email,KorisnickoIme,PWD,JMBG,Mesto_Rodj,Datum_Rodj,Pol FROM zahtev;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>JMBG</th><th>Ime</th><th>Email</th><th>Korisnicko Ime</th><th>Mesto_Rodj</th><th>Datum_Rodj</th><th>Pol</th><th>Izbriši/Prhivati</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["JMBG"]."</td><td>".$row["Ime"]."</td><td>".$row["Email"]."</td><td>".$row["KorisnickoIme"]."</td><td>".$row["Mesto_Rodj"]."</td><td>".$row["Datum_Rodj"]."</td><td>".$row["Pol"]."</td><td style='padding:1rem;'><a href='./includes/brisiZahtev.php?jmbg=".$row['JMBG']."'><i style='color:red;' class='fas fa-trash'></i></a>/<a href='./includes/dodajZahtev.inc.php?jmbg=".$row['JMBG']."&ime=".$row['Ime']."&email=".$row['Email']."&useruid=".$row['KorisnickoIme']."&mesto=".$row['Mesto_Rodj']."&datum=".$row['Datum_Rodj']."&pol=".$row['Pol']."'><i style='color:green;' class='fas fa-check-circle'></i></a></td></tr>";
    
   
    
} 
echo "</table>";
echo "</div>";
}
else {
    echo "<div class='sredina'><h2>Trenutno nepostoji ni jedan zahtev!</h2></div>";
}
$conn->close();
 ?>
 <?php
if (isset($_GET["success"])) {
    
    if($_GET["success"]=="true")
    {
        echo"<div class='success'><h2>Uspešno ste dodali doktora!</h2></div>";
    }
  

 
}
?>
<?php
include_once './komponente/footer.php'
?>

  
</body>