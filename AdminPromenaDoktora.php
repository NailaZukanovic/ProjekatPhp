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

<div class="one"><h3>Zahtevi za promenu izabranog lekara</h3></div>
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

$sql = "SELECT JMBGdoktora,ImeDoktora,ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta FROM promenalekara;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>Željeni lekar</th><th>JMBGpacijenta</th><th>Ime pacijenta</th><th>EmailPacijenta</th><th>Izbriši/Prhivati</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td><div class='centriraj'><img src='uploads/".PronadjiSliku($conn,$row["JMBGdoktora"])."' class='kruzni''><p>Dr ".PronadjiDoktora($conn,$row["JMBGdoktora"])."</p></div></td><td>".$row["JMBGpacijenta"]."</td><td style='text-align:center;'>".$row["ImePacijenta"]."</td><td style='text-align:center;'>".$row["EmailPacijenta"]."</td><td style='text-align:center;' style='padding:1rem;'><a href='./includes/brisiZahtevDoktora.php?jmbgd=".$row["JMBGdoktora"]."&jmbgk=".$row["JMBGpacijenta"]."' onclick='return checkDelete()' ><i style='color:red;' class='fas fa-trash'></i></a>/<a onclick='return checkAdd()' href='./includes/dodajZahtevDoktora.php?jmbgd=".$row["JMBGdoktora"]."&jmbgk=".$row["JMBGpacijenta"]."&imeD=".$row["ImeDoktora"]."&imeP=".$row["ImePacijenta"]."&EmailP=".$row["EmailPacijenta"]."&PolP=".$row["PolPacijenta"]."'><i style='color:green;' class='fas fa-check-circle'></i></a></td></tr>";
    
   
    
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
    return confirm('Da li ste sigurni da želite da izbrišete ovaj zahtev?');
}
function checkAdd( )
{
    return confirm('Da li ste sigurni da želite da prihvatite ovaj zahtev?');
}

</script>
  
</body>