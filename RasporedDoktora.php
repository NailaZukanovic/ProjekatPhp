<?php
session_start();
 if(isset($_SESSION["useruid"]))
 {
    $JMBG=$_GET["Id"];
    
 }

 else{
    header("location:login.php");
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
include './css/pregledi.css';
        ?>
    </style>

</head>


    
<body>


<?php

include_once './komponente/header.php';

?>

<div style="padding:4rem;font-size:1.4rem;" class="margine">


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

$sql = "SELECT ImeDoktora,Datum,Vreme,JMBGdoktora FROM raspored WHERE JMBGdoktora=$JMBG;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;'>Slobodni termini</h2>";
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>Datum Termina</th><th>Vreme Termina</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td style='text-align:center;'>".$row["Datum"]."</td><td style='text-align:center;'>".substr($row["Vreme"],0,5)."h</td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class='sredina'><h2>Dati doktor nema jos uredjen raspored!</h2></div>";
}
$conn->close();

 ?>


    

</div>





<?php

include_once './komponente/footer.php';
?>







<script src="script.js">
</script>


</body>
</html>