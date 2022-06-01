<?php
session_start();
$jmbg=$_SESSION["jmbg"];

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
                $sql = "SELECT id,JMBGkor,Naslov,uvod,glavni_deo,citat,slika,Datum FROM novosti  ORDER BY Datum DESC ";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                 


                    echo "<div class='cent13'>";
                    echo "<form  method='GET'><div class='za'style='font-size:1.6rem;margin-top :1rem;' >";
                    

echo "<h2  class='novostId'>Novosti</h2>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div style='width:95%;border:1px dotted gray;' class='novost'><div class='div2'><img src='uploads/".$row["slika"]."' >
                        </div><div class='div8'>
                        
                        <div class='div80'><p  class='naslovN'><span class='wd1'>".$row["Naslov"]." </span><span class='wd2' ><a onclick='return checkDelete2()' href='includes/ukloniNovost.php?id=".$row["id"]."'><i style='color:red;' class='fas fa-times'></i></a></span></p>;";
                        if(vrstaKorisnika($conn,$row["JMBGkor"])==="admin")
                        {
                          echo "<p class='imed'><i class='fas fa-user-alt'></i>Admin Team N Clinic</p>";
                        }
                        else
                        {
                          echo "<p class='imed'><i class='fas fa-user-alt'></i>Dr ".PronadjiDoktora($conn,$row["JMBGkor"])."</p>";
                        }
                        echo"
                        
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
                


     
                echo "<div style='margin-top:1.4rem;' class='right'><a class='ddn' href='DodajNovost.php'><i class='fas fa-plus'></i>Dodajte novost</a></div>";


?>


            </div>
<?php

include_once './komponente/footer.php'
?>

  
</body>







</html>