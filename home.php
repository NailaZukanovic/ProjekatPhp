

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
   include "style.css";
   
   include './css/pregledi.css';
           
        ?>
    </style>

</head>

<body>

<?php

include_once './komponente/header.php';
?>

    <div class="container">
       <div class="main-text">
      <span class="text1"><h2>Dobrodošli na N <span style="color:black" >Clinic</span>
           </h2></span>     
        <h4>Zakažite vaš termin kod nas!</h4>
           
           <button  onclick="location.href = 'Pregledi.php';" class="book">Zakaži</button>
       </div>
   </div>



<div class="novi">
<h2>Naše usluge</h2>

<div class="poslovi">

<div class="section">
<i class="fas fa-diagnoses"></i>
        <h3>Oftamološki dijagnostički pregledi</h3>
        <p>Oftalmološki pregledi odraslih i dece, pregledi dioptrije i pregledi za kontaktna sočiva.</p>
</div>
<div class="section">
<i class="fas fa-clinic-medical"></i>
<h3>Glaukom – Dijagnostika, lečenje, praćenje i laserske intervencijem</h3>
        <p>Glaukom je oboljenje koje najčešće protiče bez simptoma, do kasne faze bolesti , kada su nastala oštećenja trajna. Ukoliko se ne leči dovodi do potpunog gubitka vida. Može se javiti u nekoliko formi, za nastanak postoji više faktora rizika, a jedan od njih je i povišen očni pritisak.</p>
</div>
<div class="section">
<i class="fas fa-low-vision"></i>
<h3>Optička koherentna tomografija (OCT)</h3>
        <p>3D OCT-1 Maestro, savremena, neinvazivna i bezbedna metoda omogućava tomografsko snimanje vidnog živca, sloja retinalnih nervnih vlakana i predela makule.</p>
</div>
<div class="section">
<i class="fas fa-laptop-medical"></i>
<h3>Kompjuterizovano vidno polje</h3>
        <p>Haag Streit OCTOPUS 600 je vidno polje nove generacije, gde savremena tehnologija olakšava pregled pacijentu, uz veću preciznost i lakše tumačenje rezultata.</p>
</div>

</div>






</div>




<div class="work-section">
    <div class="inner-work-section">
        <h2>Kako mi radimo?</h2>
        <p class="text-work">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium 
            doloremque laudantium.Sed ut <br>perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
            <div class="myimages">
                <div class="inner-images">
                    <img src="images/dijete.jpeg" alt="">
                    <p> ut perspiciatis unde omnis iste natus error si</p>
                </div>
                <div class="inner-images">
                    <img src="uploads/oko1.jpg" alt="">
                    <p> ut perspiciatis unde omnis iste natus error si</p>
                </div>
            </div>
        </div>
    <div class="inner-work-section scnclass">
        <h2>Upoznajte se sa našim radom</h2>
        <p class="creative-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Heart treatment</span></a>
        <p class="creative-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Heart treatment</span></a>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Heart treatment</span></a>
        <a href="#" class="btn"><i class="fas fa-play-circle"></i> <span> Heart treatment</span></a>
    </div>
</div>

<div class="okolo">
<h3>Naša galerija</h3>
<div class="carousel-wrapper">
    <span id="item-1"></span>
    <span id="item-2"></span>
    <span id="item-3"></span>
    <div class="carousel-item item-1">
      <a href="#item-1" class="arrow-prev arrow"></a>
      <a href="#item-2" class="arrow-next arrow"></a>
    </div>

    <div class="carousel-item item-2">
      <a href="#item-1" class="arrow-prev arrow"></a>
      <a href="#item-3" class="arrow-next arrow"></a>
    </div>

    <div class="carousel-item item-3">
      <a href="#item-2" class="arrow-prev arrow"></a>
      <a href="#item-1" class="arrow-next arrow"></a>
    
    </div>



  </div>
</div>


<div class="doktori">
<h3>Naš tim</h3>
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
        echo "<div class='swiper1 product'>";
           
        
          
       
            
            
             echo "<div class='swiper-wrapper  product-container'>";
        
             // output data of each row
             while($row = $result->fetch_assoc()) {
                 echo "<div class='swiper-slide product-card'>";
                 echo "<div class='product-image'>";
                    
                 echo "<img src='uploads/".$row['slika']."' class='product-thumb' alt=''>";
                  /* echo"<div class='overlay'>";
                   if(isset($_SESSION["useruid"]))
                   {
                     echo"<a href='./includes/izaberiLekara.php?jmbg=".$row['JMBGKor']."&Ime=".$row['Ime']."' class='buy-btn'>Izaberi</a>";
                   }
                   else{
                     echo"<a href='login.php' class='buy-btn'>Uloguj se!</a>";
                   }
                    
                    echo"</div>";*/
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
             
         } else {
             echo "<div style='margin-top:5rem;' class='novo'><h2>Trenutno nepostoji ni jedan zahtev!</h2></div>";
 
            
         }
         $conn->close();

 ?>



</div>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper1', {
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






   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>





<?php

include_once './komponente/footer.php'
?>



</body>







</html>