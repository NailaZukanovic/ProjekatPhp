
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
include 'css/style.css';
        ?>


    </style>

</head>

<body>
    
<?php

include_once './komponente/header.php';
?>


<?php


require_once 'includes/functions.inc.php';

require_once 'includes/dbh.inc.php';
$jmbg=$_SESSION['jmbg'];

$sql = "SELECT ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta FROM izabranilekar WHERE JMBGDoktora=$jmbg;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;'>Vaši pacijenti</h2>";
    echo "<form method='GET'><div style='font-size:1.6rem;margin-top :5rem;' class='sred'><table class='nova' id='customers'><tr><th d>Pacijent</th><th>Email Pacijenta</th><th>JMBG</th><th>Pol Pacijenta</th><th>Karton</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='text-align:center;'><img class='krug' width='200px' height='200px' src='uploads/".PronadjiSliku($conn,$row['JMBGpacijenta'])."'><p>".$row["ImePacijenta"]."</p></td><td>".$row["EmailPacijenta"]."</td><td>".$row["JMBGpacijenta"]."</td><td>".$row["PolPacijenta"]."</td><td><div  class='ikonica2'><a class='ik21' href='KartonD.php?jmbg=".$row["JMBGpacijenta"]."'><i class='fas fa-clipboard-list'></i></a></div></td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div style='margin-top:7rem;margin-right:2rem;' class='sredina'><h2>Trenutno nemate ni jednog pacijenta!</h2></div>";
}

 ?>


<?php

include_once './komponente/footer.php';

?>




</body>



</html>