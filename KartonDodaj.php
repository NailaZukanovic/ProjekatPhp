<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:index.php");
  exit();
}
$jmbg=$_GET["jmbgKorisnika"];
$jmbgDoktora=$_SESSION["jmbg"];
$_SESSION["JmbgKor"]=$jmbg;
?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
 

    <style>

        <?php
   include "css/style.css"
        ?>
            <?php

 
   include "./css/karton.css";
        ?>
               <?php
   include "./css/raspored.css";
   include "./css/pregledi.css";
        ?>
    </style>

</head>

<body>


<?php

include_once './komponente/header.php';
?>
<div  class="margina">


<div class="conn">

<div  style='text-align:center;' class="conn1">

<?php
if (isset($_GET["state"])) {
    
    if($_GET["state"]=="emptyinput")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'><p>Popunite sva polja!</p></div>";
    }
    if($_GET["state"]=="alreadyExists")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'><p>Već ste uneli podatke za ovaj termin!</p></div>";
    }
    if($_GET["state"]=="invaliddate")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'><p>Da bi ste uneli podatke morate prvo da obavite pregled!</p></div>";
    }
    if($_GET["state"]=="success")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='uspeh'><p>Uspešno ste uneli podatke u karton!</p></div>";
    }
   
 

 
}
?>
<form action="./includes/dodajUKarton.inc.php" method="post" class='forma'>
   
 <label for="anamneza">Anamneza Pacijenta</label><br>
 <textarea id="anamneza" name="anamneza" rows="14" cols="60">
</textarea><br>

 <label for="anamneza">Dijagnoza</label><br>
 <textarea id="dijagnoza" name="dijagnoza" rows="14" cols="60">
 </textarea><br>
 <label for="anamneza">Dalje lečenje</label><br>
 <textarea id="lečenje" name="lečenje" rows="14" cols="60">
 </textarea>
 <br>
 <input style='width:20%;' type="submit" id="submit" name="submit" value="Unesi" placeholder="Vaš password..." ><br>

</form>


</div>
<div class="conn2">

<div class="korisnik">

<?php require "includes/functions.inc.php"; 
require_once "includes/dbh.inc.php";
$ime=PronadjiDoktora($conn,$jmbg);

$slika=PronadjiSliku($conn,$jmbg);
$datum=$_GET["datum"];
$vreme=$_GET["vreme"];

$_SESSION["Vreme_Pregleda"]=$vreme;
$_SESSION["Datum_Pregleda"]=$datum;
?> 

<div class="podaci">
<div class="wd1"> <div class="sd1"><img class="slika" src="uploads/<?php echo"".$slika ?>" alt=""></div><div class="sd2"><a onclick='return checkDelete()'  href='<?php echo "includes/ukloniPregled2.php?jmbgKorisnika=".$jmbg."&datum=".$datum."&vreme=".substr($vreme,0,5)."" ?>'><i style='color:red;' class='fas fa-times'></i></a></div></div>   
    <h2>Pacijent <?php echo"".$ime ?></h2>
    <?php
   echo" <a class='btn1'  href='KartonD.php?jmbg=".$jmbg."'>Karton <i class='fas fa-clipboard-list'></i></a>";
    ?>
    <div class="od">
    <p><span class='naslovi'>Datum Pregleda</span>:<?php echo"".$datum ?></p>
    <p><span class='naslovi'>Vreme Pregleda: </span><?php echo"".substr($vreme,0,5) ?>h</p>
    </div>
   
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

$sql = "SELECT id,ImeDoktora,Datum,Vreme,JMBGdoktora FROM raspored WHERE JMBGdoktora=$jmbgDoktora ORDER BY Datum ASC,Vreme  ASC ;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;'>Zakažite sledeći termin</h2>";
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>JMBG</th><th>Ime Doktora</th><th>Datum Termina</th><th>Vreme Termina</th><th>Zakaži</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["JMBGdoktora"]."</td><td>".$row["ImeDoktora"]."</td><td>".$row["Datum"]."</td><td>".substr($row["Vreme"],0,5)."h</td><td style='text-align:center;'><a href='./includes/dodajPregledDoktor.inc.php?jmbg=".$jmbg."&datum=".$row['Datum']."&vreme=".substr($row['Vreme'],0,5)."&idr=".$row['id']."' onclick='return checkDelete()'><i style='color:green;' class='fas fa-check-circle'></i></a></td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class='sredina'><h2 style='color:red;'>Trenutno nemate slobodnih termina u rasporedu!</h2></div>";
}
$conn->close();

 ?>


   
    
</div>

</div>

</div>


</div>

                



</div>











<?php
include_once './komponente/footer.php'
?>

<script src="script.js">
</script>

    <script>

        function checkDelete()
        {
            return confirm('Da li ste sigurni da zelite da izbrišete ovaj termin sa liste vaših zakazanih termina?');
        }
    </script>
 
</body>

</html>