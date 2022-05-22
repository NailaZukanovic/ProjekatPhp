
<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:home.php");
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


<h2 style='margin-top:7rem;' class='h20'></h2>
<?php


require_once 'includes/functions.inc.php';

require_once 'includes/dbh.inc.php';
$jmbg=$_SESSION['jmbg'];


$sql = "SELECT JMBGkor,DatumPregleda,VremePregleda,JMBGdok FROM pregledi WHERE JMBGkor=$jmbg";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;margin-top:5rem;'>Zakazani termini</h2>";
    echo "<form   method='GET'><div style='font-size:1.9rem;' class='sred'><table id='customers'><tr><th>Doktor</th><th>Datum Termina</th><th>Vreme Termina</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='text-align:center;' ><img class='krug' width='200px' height='200px' src='uploads/".pronadjiSliku($conn,$row["JMBGdok"])."'><p>Dr ".PronadjiDoktora($conn,$row["JMBGdok"])."</p>
        </td><td style='text-align:center;'>".$row["DatumPregleda"]."</td><td style='text-align:center;'>".substr($row["VremePregleda"],0,5)."h</td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class='sredina'><h2>Trenutno nemate ni jedan zakazan termin.Izaberite doktora ukoliko nemate da bi ste zakazali!</h2></div>";
}


$conn->close();
 
 ?>


<?php

include_once './komponente/footer.php';

?>




</body>



</html>