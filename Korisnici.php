<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:index.php");
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
   include "css/style.css"
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

<div  class="one"><h3 style='font-size:3.3rem!important;'>Korisnici</h3></div>
<?php

require "includes/functions.inc.php"; 
require_once "includes/dbh.inc.php";
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

$sql = "SELECT Ime,Email,JMBGkor,KorisnickoIme,Datum_Rodj,Pol,vrsta FROM user ;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>JMBG</th><th>Ime</th><th>Email</th><th>KorisnickoIme</th><th>Datum Rodjenja</th><th>Vrsta</th><th>Pol</th><th>Izbriši</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["Ime"]."</td><td>".$row["Email"]."</td><td style='text-align:center;'>".$row["JMBGkor"]."</td><td style='text-align:center;'>".$row["KorisnickoIme"]."</td><td style='text-align:center;'>".$row["Datum_Rodj"]."</td><td style='text-align:center;'>".$row["vrsta"]."</td><td style='text-align:center;'>".$row["Pol"]."</td><td style='text-align:center;' style='padding:1rem;'>";
         if ($row["vrsta"]!=="admin") 
         {
        echo"<a href='./includes/brisiKorisnika.php?jmbg=".$row["JMBGkor"]."' onclick='return checkDelete()' ><i style='color:red;' class='fas fa-trash'></i></a>"; } 
        
       echo "</td></tr>";
    
   
    
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
<script>

function checkDelete( )
{
    return confirm('Da li ste sigurni da želite da izbrišete ovog korisnika?');
}


</script>
  
</body>