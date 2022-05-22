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



<div style='margin:5rem 0;' >
<?php

$idN=$_GET["id"];


                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT id,JMBGkor,Naslov,uvod,glavni_deo,citat,slika,Datum FROM novosti WHERE id=$idN;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                 


                    echo "<div class='cent13'>";
                    echo "<form  method='GET'><div class='za'   >";
                    


                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<h2 style='color:black' class='maliN'>".$row["Naslov"]."</h2>";

                        echo "<div class='sadrzaj'><p>".$row["uvod"]."</p>
                        
                        <div style='text-align:center;'><img src='".$row["slika"]."' class='novs' width='80%'  /></div>";
                        
                        if($row["citat"]!=='')
                        {
                            echo "<div class='citat'><p>`".$row["citat"]."`</p></div>";
                        }
                       
                       echo " <p> ".$row["glavni_deo"]." </p>
                        <p style='color:gray;' class='ob'><span class='datumi'><i style='padding-left:1rem;' class='fas fa-clock'> Objavljena:".$row["Datum"]."</i></span><span class='span2'>Dodao novost:Dr ".PronadjiDoktora($conn,$row["JMBGkor"])."</span></p>    
                        </div>";
                        
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