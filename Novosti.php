<?php
session_start();
$jmbg=$_SESSION["jmbg"];


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
        <?php
   include "css/profil.css"
        ?>
    </style>

</head>

<body>

<?php

include_once './komponente/header.php';

?>
<?php

require_once "includes/functions.inc.php";
require_once "includes/dbh.inc.php";?>



<div style='margin:5rem;' >
<?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT id,JMBGkor,Naslov,uvod,glavni_deo,citat,slika,Datum FROM novosti  ORDER BY Datum DESC LIMIT 3;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                 


                    echo "<div class='cent13'>";
                    echo "<form  method='GET'><div class='za'style='font-size:1.6rem;margin-top :1rem;' >";
                    

echo "<h2  class='novostId'>Novosti</h2>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div style='width:95%;border:1px dotted gray;' class='novost'><div class='div2'><img src='".$row["slika"]."' >
                        </div><div class='div8'>
                        
                        <div class='div80'><p style='font-size:1.7rem;' class='naslovN'>".$row["Naslov"]."</p><p class='imed'><i class='fas fa-user-alt'></i>Dr ".PronadjiDoktora($conn,$row["JMBGkor"])."</p>
                        
                        <p style='font-size:1.6rem;' class='uvod'>".substr($row["uvod"],0,370)."...</p></div>
                           <div class='div20'><p class='ob'><span class='datumi'><i style='padding-left:1rem;' class='fas fa-clock'> Objavljena:".$row["Datum"]."</i></span><span class='span2'><a href='novost.php?id=".$row["id"]."'>Prikazi detalje >>></a></span></p></div>
                        
                        </div></div>";
                    }
                   
                    echo "</div>";
                    
                    echo "</form>";
                    echo "</div>";
                } else {
                    echo "<div class='sredina'><h2>Trenutno nemate ni jednog pacijenta!</h2></div>";
                }
                





?>


            </div>
<?php

include_once './komponente/footer.php'
?>

  
</body>







</html>