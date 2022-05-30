
<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:index.php");
  exit();
}
?>
<!DOCTYPE html>


<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">

 
    <style>

        <?php
include 'style.css';
        ?>

<?php
   include "./css/profil.css";
   include "./css/pregledi.css";
        ?>
    </style>

</head>

<body>
    
<?php

include_once './komponente/header.php';
?>


<h2 class='h20'>Zakazani termini</h2>
<?php


require_once 'includes/functions.inc.php';

require_once 'includes/dbh.inc.php';
$jmbg=$_SESSION['jmbg'];





$sql = "SELECT idPregleda,JMBGkor,DatumPregleda,VremePregleda,JMBGdok,ImeKorisnika FROM pregledi WHERE JMBGdok=$jmbg";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;margin-top:5rem;'>Zakazani termini</h2>";
    
if (isset($_GET["error"])) {
    

    if($_GET["error"]=="invaliddate")
    {
        echo"<div style='display:flex;justify-content:center;'><div style='margin-left:0;padding:1rem;width:80%;' class='sredina'><p>Ne možete ukloniti pregled koji nije obavljen!</p></div></div>";
    }
  
 

 
}
    echo "<form   method='GET'><div style='font-size:1.9rem;' class='sred'><table id='customers'><tr><th>Pacijent</th><th>Datum Termina</th><th>Vreme Termina</th><th>Uredi Karton</th><th>Ukloni termin</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $slika=PronadjiSliku($conn,$row["JMBGkor"]);
        echo "<tr><td style='text-align:center;' ><img class='krug' width='200px' height='200px' src='uploads/".$slika."'><p>".$row["ImeKorisnika"]."</p>
        </td><td style='text-align:center;'>".$row["DatumPregleda"]."</td><td style='text-align:center;'>".substr($row["VremePregleda"],0,5)."h</td><td ><div class='ikonica2'><a  class='ik21' href='KartonDodaj.php?jmbgKorisnika=".$row['JMBGkor']."&datum=".$row["DatumPregleda"]."&vreme=".$row["VremePregleda"]."'><i  class='fas fa-edit'></i></a></div></td><td style='text-align:center;'><div style='background-color:inherit;' class='ikonica21'><a class='ik21' onclick='return checkDelete()'  style='display:flex;justify-content:center;align-items:center;' href='includes/ukloniPregled.php?idP=".$row["idPregleda"]."&datum=".$row["DatumPregleda"]."&vreme=".substr($row["VremePregleda"],0,5)."'><i style='color:red;font-size:3.4rem;' class='fas fa-times'></a></i></div></td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div style='margin-top:5rem;' class='sredina'><h2>Trenutno nepostoji ni jedan zahtev!</h2></div>";
}

$conn->close();
 
 ?>

<?php

include_once './komponente/footer.php';

?>




<script>

function checkDelete()
{
    return confirm('Da li ste sigurni da zelite da izbrišete ovaj termin sa liste vaših zakazanih termina?');
}
</script>
</body>



</html>