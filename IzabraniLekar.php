<!DOCTYPE html>
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
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

    <style>
   <?php
   include "css/style.css"
        ?>
            <?php

include "./css/karton.css";
   include "./css/pregledi.css";
  
        ?>


   
    </style>
 

</head>


    
<body>


<?php
include_once './komponente/header.php';
?>

<div style='margin-bottom:2rem;margin-top:6rem;' class="margine">

<div  class="ok2 ">

<div style='background-color:#34d3b4;' class="flex2">


<?php require "includes/functions.inc.php"; 
require_once "includes/dbh.inc.php";

$jmbgLekara=IzabraniDoktori($conn,$_SESSION['jmbg']);
$slika=PronadjiSliku($conn,$jmbgLekara); 
$imeLekara=PronadjiDoktora($conn,$jmbgLekara);
$emailLekara=PronadjiEmail($conn,$jmbgLekara);
$datumRLekara=PronadjiDatum($conn,$jmbgLekara);
$mestoRLekara=MestoRodjenja($conn,$jmbgLekara);
?>


    <div class="centriraj">
    <h2 style='color:white;font-size:2rem;margin:1rem;letter-spacing:0.07rem;'>Vaš trenutni izabrani lekar</h2>
    <img class="slika" src="uploads/<?php echo"".$slika ?>" alt="">
    <h2 style='color:white;font-size:2rem;margin:1rem;letter-spacing:0.07rem;'><?php echo"".$imeLekara ?></h2>
             <div  class='inf' >
         <p><span style='color:white' class='id2'>JMBG</span> :<?php echo "".$jmbgLekara?></p>
         <p><span style='color:white' class='id2'>Email </span> :<?php echo "".$emailLekara?></p>
        <p><span style='color:white' class='id2'>Datum Rodjenja</span>:<?php echo "".$datumRLekara?></p>
    <p><span style='color:white'  class='id2'>Mesto Rodjenja</span>:<?php echo "".$mestoRLekara?></p>



    <p style='margin:4rem 0.3rem'>Prevucite preko kartice i pošaljite zahtev našem admin timu za promenu lekara.</p>
</div>
   



    </div>
    
   
</div>
    <div class="flex5">


        <div class="centriraj">
<h2 style='color:#43b9dc;font-size:2.7rem; margin:2rem 0;letter-spacing:0.07rem;'>Svi dostupni lekari</h2>
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

$sql = "SELECT Ime,Email,KorisnickoIme,PWD,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol,slika FROM user Where vrsta LIKE 'doktor' and JMBGKor!=".$jmbgLekara.";";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
   
echo "<div style='height:610px;' class='swiper product'>";
  

    echo "<h2 style='text-transform:none;' class='product-category'>Pošaljite zahtev za promenu lekara</h2>";

   
    echo "<div class='swiper-wrapper product-container'>";

    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='swiper-slide product-card'>";
        echo "<div class='product-image'>";
           
        echo "<img src='uploads/".$row["slika"]."' class='product-thumb' alt=''>";
         echo"<div class='overlay'>";
          if(isset($_SESSION["useruid"]))
          {
            echo"<a onclick='return checkDelete()' href='./includes/promLekara.php?jmbg=".$row['JMBGKor']."&Ime=".$row['Ime']."' class='buy-btn'>Izaberi</a>";
          }
          else{
            echo"<a href='login.php' class='buy-btn'>Uloguj se!</a>";
          }
           
           echo"</div>";
        echo"</div>";
        echo"<div class='product-info'>";
        echo"<h2 class='product-brand'>Dr ".$row['Ime']."</h2>";
        echo"<p class='product-short-description'>Email: ".$row['Email']."</p>";
        echo"<p class='opis2'>Datum Rođenja:".$row["Datum_Rodj"]."</p>";
        echo"</div>";

        echo" </div>";
    }

   echo "</div>";
   
   echo" <div class='swiper-pagination'></div>";

   echo" <!-- If we need navigation buttons -->";
   echo" <div class='swiper-button-prev'></div>";
   echo" <div class='swiper-button-next'></div>";


    echo "</div>";
    echo "</div>";
    
} else {
    echo "<div style='margin-top:5rem;' class='novo'><h2>Trenutno nepostoji ni jedan zahtev!</h2></div>";

   
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
<script>

function checkDelete()
{
    return confirm('Da li ste sigurni da zelite da promenite izabranog lekara?');
}
</script>

</body>
</html>