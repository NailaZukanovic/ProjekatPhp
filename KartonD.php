<!DOCTYPE html>
<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:home.php");
  exit();
}
?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

    <style>
   <?php
   include "style.css"
        ?>
            <?php

 
   include "./css/karton.css";
        ?>


   
    </style>
 

</head>


    
<body>


<?php
include_once './komponente/header.php';
?>

<div class="margine">

<div class="ok2">

<div class="flex2">


<?php require "includes/functions.inc.php"; 
require_once "includes/dbh.inc.php";


$slika=PronadjiSliku($conn,$_SESSION['jmbg']); ?>

    <div class="centriraj">
    <img class="slika" src="uploads/<?php echo"".PronadjiSliku($conn,$_GET['jmbg']) ?>" alt="">
    <h2 style='color:#43b9dc;font-size:2rem;margin:1rem;letter-spacing:0.07rem;'>Pacijent <?php echo"".PronadjiDoktora($conn,$_GET['jmbg']) ?></h2>
             <div  class='inf' >
         <p><span class='id2'>JMBG</span> :<?php echo "".$_GET["jmbg"]?></p>
         <p><span class='id2'>Email </span> :<?php echo "".PronadjiEmail($conn,$_GET["jmbg"])?></p>
        <p><span class='id2'>Datum Rodjenja</span>:<?php echo "".PronadjiDatum($conn,$_GET["jmbg"])?></p>
    <p><span class='id2'>Mesto Rodjenja</span>:<?php echo "".MestoRodjenja($conn,$_GET["jmbg"])?></p>



    <p style='margin:4rem 0.3rem'>Karton pacijenta vas bolje kao lekara upućuje u celokupno stanje pacijenta.Karton se sastoji od izveštaja sa pregleda koji je u tom trenutku dao izabrani lekar.</p>
</div>
   



    </div>
    
   
</div>
    <div class="flex5">


        <div class="centriraj">
<h2 style='color:#43b9dc;font-size:2.7rem; margin:2rem 0;letter-spacing:0.07rem;'>Karton Pacijenta</h2>
</div>
<?php



require_once "includes/functions.inc.php"; 



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
 
         $sql = "SELECT JMBGlekara,Anamneza,Dijagnoza,Lečenje,Vreme_Pregleda,Datum_Pregleda FROM karton Where JMBGkorisnika =".$_GET["jmbg"]." ORDER BY Datum_Pregleda DESC,Vreme_Pregleda DESC ";
         $result = $conn->query($sql);
 
         if ($result->num_rows > 0) {
        echo "<div style='width: 770px;' class='swiper product'>";
           
        
         
            
             echo "<div class='swiper-wrapper  product-container'>";
        
             // output data of each row
             while($row = $result->fetch_assoc()) {
                 echo "<div class='swiper-slide product-card'>";
                 echo "<div class='product-image'>";
               
                   echo "<p style='font-size:1.5rem;' class='anam'><span style='font-size:1.8rem;margin-right:2rem;' class='id2'>Anamneza:</span>".$row["Anamneza"]."</p>";

                   echo "<p class='anam' style='font-size:1.5rem;'><span style='font-size:1.8rem;' class='id2'>Dijagnoza</span>:".$row["Dijagnoza"]."</p>";
                   echo "<p class='anam' style='font-size:1.5rem;'><span style='font-size:1.8rem;' class='id2'>Terapija i dalje lečenje</span>:".$row["Lečenje"]."</p>";



                 echo"</div>";
                 echo"<div class='product-info'>";
                 echo"<p class='product-short-description'>Izabrani lekar:<span class='id2'> ".PronadjiDoktora($conn,$row['JMBGlekara'])."</span></p>";
                 echo"<p class='product-short-description'>Pregled održan <span class='id2'> ".$row['Datum_Pregleda']."</span> u <span class='id2'> ".substr($row['Vreme_Pregleda'],0,5)."h</span>. </p>";
                 echo"</div>";
 
                 echo" </div>";
             }
 
            echo "</div>";
            
            echo" <div class='swiper-pagination'></div>";

            echo" <!-- If we need navigation buttons -->";
            echo" <div class='swiper-button-prev'></div>";
            echo" <div class='swiper-button-next'></div>";
         
        
             echo "</div>";
             
         } else {
             echo "<div style='margin-top:5rem;' class='sredina'><h2>Karton pacijenta je trenuntno prazan</h2></div>";
 
            
         }
         $conn->close();

      ?>
    </div>
</div>
</div>



    







<?php

include_once './komponente/footer.php';
?>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  autoplay:7000,
centeredSlides:true,
  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  // And if we need scrollbar
  scrollbar: {
    el: '.swiper-scrollbar',
  },
});
</script>
<script src="script.js">
</script>


</body>
</html>