<?php
session_start();
?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
    <link
  rel="stylesheet"
  href="https://unpkg.com/swiper@8/swiper-bundle.min.css"
/>

    <style>

        <?php
   include "style.css"
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




<div class="raspored">
<div class="raspored1">

</div>
<div class="raspored2">
<h3>Dodajte termin </h3>
<h5>Izaberite doktora,vreme,i datum termina</h5>

<?php
if (isset($_GET["error"])) {
    
    if($_GET["error"]=="praznaPolja")
    {
        echo"<div class='danger'><p>Popunite sva polja!</p></div>";
    }
    if($_GET["error"]=="zauzetTermin")
    {
        echo"<div class='danger'><p>Ovaj termin vec postoji!</p></div>";
    }
    if($_GET["error"]=="invaliddate")
    {
        echo"<div class='danger'><p>Neispravan datum!</p></div>";
    }
 

 
}
?>


<form action="includes/dodajRaspored.inc.php" method="post">
<label for="ime">Doktor</label><br>


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

  $sql = "SELECT Ime,Email,KorisnickoIme,PWD,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol FROM user Where vrsta LIKE 'doktor';";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    
      echo "<select name='id' id=''>";
      echo"<option value=''></option>";
      // output data of each row
      while($row = $result->fetch_assoc()) {
       echo"<option value='".$row["JMBGKor"]."'>".$row["Ime"]."</option>" ;    
    
    }


     echo"</select>";

  
      
  } else {
      echo "<div class='sredina'><h2>Trenutno nemamo doktora u sistemu!</h2></div>";
  }
  $conn->close();

?>
<br>

<label for="datum">Datum Termina:</label><br>
<input type="date" name="datum" placeholder="datum..." >
<br>
<label for="vreme">Vreme Termina</label><br>
<select name="vreme" id="">
<option value=""></option>
<option value="8:00">8:00</option>
<option value="9:00">9:00</option>
<option value="10:00">10:00</option>
<option value="11:15">11:15</option>
<option value="12:15">12:15</option>
<option value="13:15">13:15</option>
<option value="14:15">14:15</option>
<option value="15:15">15:15</option>
<option value="16:15">16:15</option>
<option value="17:15">17:15</option>
</select>

<input type="submit" name="submit" value="Dodaj"  ><br>


</form>







</div>
<div class="raspored1">

</div>






</div>

<div style="margin:3rem">
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

        $sql = "SELECT Ime,Email,KorisnickoIme,PWD,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol,slika FROM user Where vrsta LIKE 'doktor';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           
       echo "<div class='swiper product'>";
          
    
            echo "<h2 style='text-transform:none;margin:3rem 0;' class='product-category'>Prevucite preko kartice i pogledajte raspored lekara!</h2>";
            
    
            if(!isset($_SESSION["useruid"]))
                  {
                    echo "<h5 class='opis'>Ukoliko niste prijavljeni ili nemate nalog morate se ulogovati <a href='login.php'>ovde</a>.</h5>";
                  }
          
           
           
            echo "<div  class='swiper-wrapper product-container'>";
       
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div  class='swiper-slide product-card'>";
                echo "<div class='product-image'>";
                   
                echo "<img src='uploads/".$row["slika"]."' class='product-thumb' alt=''>";
                 echo"<div class='overlay'>";
                 echo"<a href='RasporedDoktora.php?Id=".$row['JMBGKor']."' class='buy-btn'>Raspored</a>";
                   
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




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script >
      const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  autoplay:7000,
  
  centeredSlides: true,

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


<?php
include_once './komponente/footer.php'
?>

  
</body>