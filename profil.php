<?php
session_start();
$jmbg=$_SESSION["jmbg"];

if(!$_SESSION['useruid'])
{
  header("location:home.php");
  exit();
}

$datum=date('Y-m-d');
require_once './includes/functions.inc.php';
require_once './includes/dbh.inc.php';

izbrisiDatume($conn,$datum);



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
   include "./css/profil.css";
   include "./css/pregledi.css";
        ?>
    </style>

</head>

<body>


<?php

include_once './komponente/header.php';
?>
<div  class="margina">

<?php

require_once "includes/functions.inc.php";
require_once "includes/dbh.inc.php";?>

<div class="kontainer">



            <div class="profil">
                <?php
                 if($_SESSION['userVrsta']==='pacijent')
                 {
                    echo"<h2>Pacijent</h2>";
                 }
                else if($_SESSION['userVrsta']==='doktor')
                 {
                    echo"<h2>Profil doktora</h2>";
                 }
                 else
                 {
                    echo"<h2>Admin</h2>";
                 }
                            require_once "includes/dbh.inc.php";
                            require_once "includes/functions.inc.php";

                            $pronsliku=PronadjiSliku($conn,$_SESSION["jmbg"]);



                             $serverName="localhost";
        $dbUsername="root";
        $dbPassword="";
        $dbName="PhpProjekat";


$conn=mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);



if(!$conn)
{

    die("Connection failed: ".mysqli_connect_error());
}

                 $sql = "SELECT ImePacijenta,JMBGdoktora,EmailPacijenta,PolPacijenta FROM izabranilekar WHERE JMBGpacijenta=$jmbg;";


                 $result = $conn->query($sql);

if ($result->num_rows > 0) {
  $dali=true;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $p=$row['JMBGdoktora'];
       
    }
   
    
} else {
    $dali=false;
 
}


$conn->close();
                ?>
            <div class="slika">
                <?php

                if ($pronsliku!='')
                {
                    echo" <img src='uploads/".$pronsliku." '>";
                }
                else{

                    echo "<img src='uploads/profil.webp' >";
                }
           
            ?>
            </div>
            <?php

             echo"<h4>".$_SESSION["ime"]."</h4>";
             
if($_SESSION["userVrsta"]==='pacijent')//Profil page pacijent meni
{
    echo "<nav id='sidebar'>";
      
    echo "<ul class='list-items'>";
    echo " <li class='list'><a id='prvi'  href='#' class='serv-btn'><i class='fas fa-address-book'></i>Postavke profila<span class='fas fa-caret-down first'></span>";
    echo " </a>";
    
    echo "         <ul class='serv-show'>";
    echo "         <div  id='myDropdown' class='informacije'>";
    echo "     <li><p><span class='id1'>Korisničko ime</span> :".$_SESSION["useruid"]."</p></li>";
    echo "     <li><p><span class='id1'>Email </span> :".$_SESSION["Email"]."</p></li>";
    echo "     <li><p><span class='id1'>Datum Rodjenja </span> :".$_SESSION["DatumR"]."</p></li>";
    echo "     <li><p><span class='id1'>Mesto Rodjenja</span> :".$_SESSION["MestoR"]."</p></li>";
    echo"<div class='centriraj'><a href='IzmeniPodatke.php' class='az'><i  class='fas fa-edit'></i>Izmeni podatke</a></div>";
    echo "   </div>   ";
    echo "   </ul>   ";
           
           
        
    echo "</li>";
    echo " <li><a id='prvi' class='z-btn' href='#'><i class='fas fa-list'></i>Vaši pregledi<span class='fas fa-caret-down second'></span </span></a>";
        
    echo "  <ul class='z-show'>";
    echo "  <div  class='zahtevi'>";
    echo " <li><p><a class='zahtev2' href='SviPregledi.php'>Lista Pregleda</a></p></li>";
    echo " <li><p class='upit'>Prvi pregledi koji slede:</p></li>";
    
    
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

$sql = "SELECT JMBGdok,JMBGkor,DatumPregleda,VremePregleda,ImeKorisnika FROM pregledi WHERE JMBGkor=$jmbg ORDER BY DatumPregleda ASC,VremePregleda ASC LIMIT 3; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<form method='GET'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='novo'><a href='#'>Datum :".$row['DatumPregleda']." : ".substr($row['VremePregleda'],0,5)."h</a></div>";
    }

    echo"</form>";
} else {
    echo "<div class='novo'><p>Trenutno nemate zakazanih pregleda!</p></div>";
}
$conn->close();
    echo "   </div>   ";
    echo "   </ul>   ";

    echo "</li>";
           
           
 if($dali===false)
 {
    echo " <li><a id='prvi'  href='profil.php'><i class='fas fa-user-md'></i>Izabrani Lekar</a></li>";

 }
 else
 {
    echo " <li><a id='prvi'  href='IzabraniLekar.php'><i class='fas fa-user-md'></i>Izabrani Lekar</a></li>";
 }
    
    
  

    echo " <li><a  id='prvi'href='Karton.php'><i class='fas fa-clipboard-list'></i>Vaš karton</a></li>";

    echo " </ul>";
    echo "</nav>";
       
}
     
else if($_SESSION["userVrsta"]==='doktor')//Profil page doktor meni
{
    echo "<nav id='sidebar'>";
      
    echo "<ul class='list-items'>";
    echo " <li class='list'><a href='#'id='prvi' class='serv-btn'><i class='fas fa-address-book'></i>Postavke profila<span class='fas fa-caret-down first'></span>";
    echo " </a>";
    
    echo "         <ul class='serv-show'>";
    echo "         <div  id='myDropdown' class='informacije'>";
    echo "     <li><p><span class='id1'>Korisničko ime</span> :".$_SESSION["useruid"]."</p></li>";
    echo "     <li><p><span class='id1'>Email </span> :".$_SESSION["Email"]."</p></li>";
    echo "     <li><p><span class='id1'>Datum Rodjenja </span> :".$_SESSION["DatumR"]."</p></li>";
    echo "     <li><p><span class='id1'>Mesto Rodjenja</span> :".$_SESSION["MestoR"]."</p></li>";
    echo"<div style='text-align:center;'><a href='IzmeniPodatke.php' class='az'><i  class='fas fa-edit'></i>Izmeni podatke</a></div>";
    echo "   </div>";
    echo "   </ul>";
           
           
        
    echo "</li>";
    echo " <li><a id='prvi'  class='z-btn' href='#'><i class='fas fa-user-md'></i>Zakazani Pregledi<span class='fas fa-caret-down second'></span></a>";
    echo "         <ul class='z-show'>";
    echo "         <div  class='zahtevi'>";
    echo " <li><p><a class='zahtev2'  href='SviPreglediZaLekare.php'>Lista Pregleda</a></p></li>";
    echo " <li><p class='upit'>Predstojeći pregledi</p></li>";
        
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

$sql = "SELECT JMBGdok,JMBGkor,DatumPregleda,VremePregleda,ImeKorisnika FROM pregledi WHERE JMBGdok=$jmbg ORDER BY DatumPregleda ASC,VremePregleda ASC LIMIT 3; ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "<form method='GET'>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<div class='novo'><a href='KartonDodaj.php?jmbgKorisnika=".$row['JMBGkor']."&datum=".$row['DatumPregleda']."&vreme=".$row['VremePregleda']."'>Vreme održavanja :".$row['DatumPregleda']." : ".substr($row['VremePregleda'],0,5)."h</a></div>";
    }

    echo"</form>";
} else {
    echo "<div class='novo'><p>Trenutno nemate zakazanih pregleda!</p></div>";
}
$conn->close();
    
    echo "   </div>   ";
    echo "   </ul>   ";
 
    echo "</li>";
  
    echo " <li><a id='prvi' href='RasporedDoktora.php?Id=".$_SESSION["jmbg"]."'><i class='fas fa-calendar-alt'></i>Raspored</a></li>";

    echo " <li><a id='prvi' href='VasiPacijenti.php'><i class='fas fa-list'></i>Vaši pacijenti</a></li>";
    
   
    echo " </ul>";
    echo "</nav>";
       
}//Profil page admin meni

else {

    echo "<nav id='sidebar'>";
      
    echo "<ul class='list-items'>";
    echo " <li class='list'><a href='#'  id='prvi' class='serv-btn'><i class='fas fa-address-book'></i>Postavke profila<span class='fas fa-caret-down first'></span>";
    echo " </a>";
    
    echo "         <ul class='serv-show'>";
    echo "         <div  id='myDropdown' class='informacije'>";
    echo "     <li><p><span class='id1'>Korisničko ime</span> :".$_SESSION["useruid"]."</p></li>";
    echo "     <li><p><span class='id1'>Email </span> :".$_SESSION["Email"]."</p></li>";
    echo "     <li><p><span class='id1'>Datum Rodjenja </span> :".$_SESSION["DatumR"]."</p></li>";
    echo "     <li><p><span class='id1'>Mesto Rodjenja</span> :".$_SESSION["MestoR"]."</p></li>";
    echo"<div class='centriraj'><a class='az'  href='IzmeniPodatke.php' ><i  class='fas fa-edit'></i>Izmeni podatke</a></div>";
    echo "   </div>   ";
    echo "   </ul>   ";
           
           
        
    echo "</li>";
    echo " <li class='list'><a href='#' id='prvi' class='z-btn'><i class='fas fa-plus'></i>Zahtevi<span class='fas fa-caret-down second'></span>";
    echo " </a>";
    
    echo "         <ul class='z-show'>";
    echo "         <div  class='zahtevi'>";
    echo " <li><p><a class='zahtev2'  href='adminZahtevi.php'>Zahtevi za prihvatanje lekara u sistem</a></p></li>";
    echo " <li><p><a class='zahtev2' href='AdminPromenaDoktora.php'>Zahtevi za promenu izabranog lekara</a></p></li>";
    
    echo "   </div>   ";
    echo "   </ul>   ";
           
           
        
    echo "</li>";
   
    echo " <li><a href='raspored.php'  id='prvi'><i class='fas fa-calendar-alt'></i>Rasporedi</a></li>";

    echo " <li><a href='Korisnici.php'  id='prvi'><i class='fas fa-list'></i>Korisnici</a></li>";

    echo " <li><a href='AdminNovosti.php'  id='prvi'><i class='fas fa-newspaper'></i>Novosti</a></li>";
    
   
    echo " </ul>";
    echo "</nav>";

}
     

           ?>
                   </div>




            <div style='overflow:hidden;' class="podaci">

            <?php 
                 
                 if($_SESSION['userVrsta']==='pacijent')
                 {
       
if($_SESSION["userVrsta"]==='pacijent')

{
    if($dali===false)
    {
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
          
    
            echo "<h2 style='text-transform:none;' class='product-category'>Trenutno nemate izabranog lekara</h2>";
            echo "<h5 class='opis'>Izaberite vašeg lekara i zatim zakažite  termin!</h5>";
    
            if(!isset($_SESSION["useruid"]))
                  {
                    echo "<h5 class='opis'>Ukoliko niste prijavljeni ili nemate nalog morate se ulogovati <a href='login.php'>ovde</a>.</h5>";
                  }
          
           
           
            echo "<div class='swiper-wrapper product-container'>";
       
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<div   class='swiper-slide product-card'>";
                echo "<div class='product-image'>";
                   
                echo "<img src='uploads/".$row["slika"]."' class='product-thumb' alt=''>";
                 echo"<div class='overlay'>";
                  if(isset($_SESSION["useruid"]))
                  {
                    echo"<a href='./includes/izaberiLekara.php?jmbg=".$row['JMBGKor']."&Ime=".$row['Ime']."' class='buy-btn'>Izaberi</a>";
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


    }
    else
    {
      
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

      $sql="SELECT Ime,Email,KorisnickoIme,PWD,vrsta,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol,slika FROM user WhERE JMBGKor=$p;";
     
   
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    while($row = $result->fetch_assoc()) {

        echo "<div class='flex'>";
        echo "<div class='one1'>";
        echo "<p class='lekar1'><span class='imena'>Ime vašeg izabranog lekara:</span>".$row['Ime']."";
        echo "<p class='lekar1'><span class='imena'>Kontakt email lekara:</span>".$row['Email']."";
        echo "<p class='lekar1'><span class='imena'>Datum Rođenja:</span>".$row['Datum_Rodj']."";
        echo "<p class='lekar1'><span class='imena'>Pol:</span>".$row['Pol']."";
      
        echo"</div>";
        echo "<div class='one2'>";
        echo "<img src='uploads/".$row['slika']."'>";
        echo"<div style='text-align:center; margin:1.5rem 0'><a class='izmeni' href='IzabraniLekar.php'><i class='fas fa-sync'></i>Izmeni lekara</a></div>";
        echo"</div>";
        
        echo "</div>";
    }
  
    
} else {
    echo "<div class='sredina'><h2>Trenutno nepostoji ni jedan zahtev!</h2></div>";
}




             
$conn->close();


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
$sql = "SELECT id,JMBGdoktora,ImeDoktora,Datum,Vreme FROM raspored WHERE JMBGdoktora=$p;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2 style='text-align:center;color:black;font-size:3rem;color:#43b9dc;'>Slobodni termini izabranog lekara</h2>";
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>Ime Doktora</th><th>Datum Termina</th><th>Vreme Termina</th><th>Zakaži</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["ImeDoktora"]."</td><td>".$row["Datum"]."</td><td>".substr($row["Vreme"],0,5)."h</td><td style='text-align:center;'><a href='./includes/dodajPregled.inc.php?jmbg=".$p."&datum=".$row['Datum']."&vreme=".$row['Vreme']."&idr=".$row['id']."' onclick='return checkDelete()'><i style='color:green;' class='fas fa-check-circle'></i></a></td></tr>";
    }
    echo "</table>";
    echo "</div>";
    
} else {
    echo "<div class='sredina'><h2>Vas lekar trenutno nema termina u rasporedu!</h2></div>";
}

      
    }

}




               }//kraj kontenta za pacijenta


        else if($_SESSION["userVrsta"]==='doktor')
        {


           
            echo"<div class='dokflex'>
                <div class='dokflex5'>
                
                <h2 class='naslov'>Najskorije vaše novosti</h2>
                ";

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT id,JMBGkor,Naslov,uvod,glavni_deo,citat,slika,Datum FROM novosti WHERE JMBGkor=$jmbg  ORDER BY Datum DESC LIMIT 3;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                 
                    echo "<form  method='GET'><div class='za' >";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div  class='novost'><div class='div2'><img src='uploads/".$row["slika"]."' ></div><div class='div8'>
                        <div class='div80'><p  class='naslovN'>".$row["Naslov"]."</p><p class='imed'><i class='fas fa-user-alt'></i>Dr ".PronadjiDoktora($conn,$row["JMBGkor"])."</p>
                        
                        <p  class='uvod'>".substr($row["uvod"],0,270)."...</p></div>
                           <div class='div20'><p class='ob'><span class='datumi'><i style='padding-left:1rem;' class='fas fa-clock'> Objavljena:".$row["Datum"]."</i></span><span class='span2'><a class='detalji' href='novost.php?id=".$row["id"]."'>Prikazi detalje >>></a></span></p></div>
                        </div></div>";
                    }
                   
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div class='sredina'><h2>Trenutno niste dodali ni jednu novost!</h2></div>";
                }
                
          echo "<div style='margin-top:1.4rem;' class='right'><a class='ddn' href='DodajNovost.php'><i class='fas fa-plus'></i>Dodajte novost</a></div>";


              echo"  </div>
                <div class='dokflex2'>";

                echo "<div class='Vasipacijenti'>";
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta FROM izabranilekar WHERE JMBGDoktora=$jmbg ORDER BY Id DESC LIMIT 3;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<h2 style='text-align:center;color:black;font-size:2rem;color:#43b9dc;margin:1rem 0;'>Vaši najskorije dodati pacijenti</h2>";
                    echo "<form  method='GET'><div style='font-size:1.6rem;margin-top :1rem;' >";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div class='pacijent'><div style='display:flex;width:50%;'><p>".$row["ImePacijenta"]."</p></div> <div style='display:flex;width:50%;justify-content:right;'  class='ikonica2'><a class='ik21' href='KartonD.php?jmbg=".$row["JMBGpacijenta"]."'><i class='fas fa-clipboard-list'></i></a></div></div>";
                    }
                echo" <div style='text-align:center;padding:0.5rem 0;'><a class='btn11' href='VasiPacijenti.php'>Pogledaj sve<i class='fas fa-users'></i></a></div>";
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div class='sredina'><h2>Trenutno nemate ni jednog pacijenta!</h2></div>";
                }
                echo"</div>";


                echo "<div class='Vasipacijenti'>";
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT ImeDoktora,Datum,Vreme,JMBGdoktora FROM raspored WHERE JMBGdoktora=$jmbg ORDER BY Datum ASC,Vreme ASC LIMIT 3 ;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<h2 style='text-align:center;color:black;font-size:2rem;color:#43b9dc;margin:1rem 0;'>Vaši najskoriji slobodni termini</h2>";
                    echo "<form method='GET'><div style='font-size:1.6rem;margin-top :1rem;' ";
                    
                  
                   echo "<p ><span style='margin-left:7%;'>Datum</span> <span style='margin-left:26%;'>Vreme</span></p>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div class='rasporedi'><div style='display:flex;width:50%;'><p>".$row["Datum"]."</p> </div><p>".substr($row["Vreme"],0,5)."h</p></div>";
                    }
                    echo" <div style='text-align:center;padding:0.5rem 0;'><a  class='btn12' href='RasporedDoktora.php?Id=".$jmbg."'>Pogledaj sve<i class='fas fa-calendar-alt'></i></a></div>";
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div class='sredina'><h2>Trenutno slobodnih termina!</h2></div>";
                }
                
                  echo "</div>";
                $conn->close();

echo "</div>";
echo "</div>";
            }
        else
        {


           
            echo"<div class='dokflex'>
                <div class='dokflex5'>
                
                <h2 class='naslov'>Najskorije novosti</h2>
                ";

                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                $sql = "SELECT id,JMBGkor,Naslov,uvod,glavni_deo,citat,slika,Datum FROM novosti ORDER BY Datum DESC LIMIT 3;";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                 
                    echo "<form  method='GET'><div class='za' >";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div  class='novost'><div class='div2'><img src='uploads/".$row["slika"]."' ></div><div class='div8'>
                        <div class='div80'><p  class='naslovN'><span class='wd1'>".$row["Naslov"]." </span><span class='wd2' ><a onclick='return checkDelete2()' href='includes/ukloniNovost.php?id=".$row["id"]."'><i style='color:red;' class='fas fa-times'></i></a></span></p><p class='imed'><i class='fas fa-user-alt'></i>Dr ".PronadjiDoktora($conn,$row["JMBGkor"])."</p>
                        
                        <p  class='uvod'>".substr($row["uvod"],0,270)."...</p></div>
                           <div class='div20'><p class='ob'><span class='datumi'><i style='padding-left:1rem;' class='fas fa-clock'> Objavljena:".$row["Datum"]."</i></span><span class='span2'><a class='detalji' href='novost.php?id=".$row["id"]."'>Prikazi detalje >>></a></span></p></div>
                        </div></div>";
                    }
                   
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div class='sredina'><h2>Trenutno niste dodali ni jednu novost!</h2></div>";
                }
                
          echo "<div style='margin-top:1.4rem;' class='right'><a class='ddn' href='DodajNovost.php'><i class='fas fa-plus'></i>Dodajte novost</a></div>";


              echo"  </div>
                <div class='dokflex2'>";

                echo "<div class='Vasipacijenti'>";
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
                
                
$sql = "SELECT idPromenaL,JMBGdoktora,ImeDoktora,ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta FROM promenalekara ORDER BY idPromenaL DESC LIMIT 3;";
                $result = $conn->query($sql);
                echo "<h2 style='text-align:center;color:black;font-size:2rem;color:#43b9dc;margin:1rem 0;'>Najskoriji zahtevi za promenu izabranog lekara</h2>";
                if ($result->num_rows > 0) {
                  
                    echo "<form  method='GET'><div style='font-size:1.6rem;margin-top :1rem;' >";
                    // output data of each row
                    echo "<p ><span style='margin-left:7%;'>Pacijent</span> <span style='margin-left:36%;'>Lekar</span></p>";
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div class='pacijent'><div style='display:flex;width:50%;'><p>".$row["ImePacijenta"]." </p></div> <div style='display:flex;width:50%;justify-content:right;'  >".$row["ImeDoktora"]."</div></div>";
                    }
                echo" <div style='text-align:center;padding:0.5rem 0;'><a class='btn11' href='AdminPromenaDoktora.php'>Odgovori na sve<i class='fas fa-reply-all'></i></a></div>";
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div style='font-size:1.5rem;' class='sredina'><h2>Trenutno nemate ni jednan zahtev!</h2></div>";
                }
                echo"</div>";


                echo "<div class='Vasipacijenti'>";
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "PhpProjekat";
                
                // Create connection
                
                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} $sql = "SELECT IdZahteva,Ime,Email,KorisnickoIme,PWD,JMBG,Mesto_Rodj,Datum_Rodj,Pol  FROM zahtev  ORDER BY IdZahteva DESC LIMIT 3;";
             
                $result = $conn->query($sql);
                echo "<h2 style='text-align:center;color:black;font-size:2rem;color:#43b9dc;margin:1rem 0;'>Najskoriji zahtevi za prihvatanje na sistem doktora</h2>"; 
                if ($result->num_rows > 0) {
               
                    echo "<form method='GET'><div style='font-size:1.6rem;margin-top :1rem;' ";
                    
                  
                   echo "<p ><span style='margin-left:7%;'>Ime Doktora</span> <span style='margin-left:26%;'>JMBG</span></p>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                       
                        echo "<div class='rasporedi'><div style='display:flex;width:50%;'><p>Dr ".$row["Ime"]."</p> </div><p>".$row["JMBG"]."</p></div>";
                    }
                    echo" <div style='text-align:center;padding:0.5rem 0;'><a  class='btn12' href='adminZahtevi.php'>Odgovori na sve<i class='fas fa-reply-all'></i></a></div>";
                    echo "</div>";
                    
                    echo "</form>";
                    
                } else {
                    echo "<div style='font-size:1.5rem;' class='sredina'><h2>Trenutno nema zahteva od doktora!</h2></div>";
                }
                
                  echo "</div>";
                $conn->close();

echo "</div>";
echo "</div>";
            }
               
            ?>

            </div>
</div>

</div>











<?php
include_once './komponente/footer.php'
?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.swiper', {
  // Optional parameters
  direction: 'horizontal',
  autoplay:7000,

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
<script>
      $('.serv-btn').click(function(){

        $('nav ul .serv-show').toggleClass("show");
        $('nav ul .first').toggleClass("rotate");
        
      })
      $('.z-btn').click(function(){

        $('nav ul .z-show').toggleClass("show");
        $('nav ul .second').toggleClass("rotate");
        
      })
      $('nav ul li').click(function()
      {
$(this).addClass("active").siblings().removeClass("active");
      });
    </script>
    <script>

        function checkDelete()
        {
            return confirm('Da li ste sigurni da zelite da izaberete ovaj termin?');
        }
        function checkDelete2()
        {
            return confirm('Da li ste sigurni da zelite da izbrišete ovu novost?');
        }
    </script>




</body>

</html>