<?php
session_start();
if(!$_SESSION['useruid'])
{
  header("location:home.php");
  exit();
}
$jmbg=$_GET["jmbgKorisnika"];
$jmbgDoktora=$_SESSION["jmbg"];
$_SESSION["JmbgKor"]=$jmbg;
?>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
 

    <style>

        <?php
   include "style.css"
        ?>
            <?php

 
   include "./css/karton.css";
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
<div  class="margina">


<div class="conn">


<div class="conn1"></div>
<div class="conn1">

<?php
if (isset($_GET["state"])) {
    
    if($_GET["state"]=="emptyinput")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Sva polja su obavezna osim citata!</p></div>";
    }
   else if($_GET["state"]=="emptyslika")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Morate dodati i sliku!</p></div>";
    }
   else if($_GET["state"]=="invalidnaslov")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Naslov mora biti dužine 15 do 140 karaktera!</p></div>";
    }
   
   else if($_GET["state"]=="invaliduvod")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Uvod mora biti dužine 200 do 550 karaktera!</p></div>";
    }
   
   else if($_GET["state"]=="invalidglavni")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Glavni deo mora biti dužine 300 do 1500 karaktera!</p></div>";
    }
   
   else if($_GET["state"]=="invalidcitat")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;' class='sredina'><p>Citat može biti dužine do 300 karaktera!</p></div>";
    }
   else if($_GET["state"]=="success")
    {
        echo"<div  style='margin-left:3%;padding:1rem;width:95%;text-align:center;' class='uspeh'><p>Uspešno ste dodali novost!</p></div>";
    }
   
   
 

 
}
?>

<form action="./includes/dodajNovost.inc.php" method="post"  enctype="multipart/form-data" class='forma'>
   
 <label for="naslov">Naslov</label><br>
 <textarea id="naslov" name="naslov" rows="3" cols="90">
</textarea><br>


 <label for="uvod">Uvod</label><br>
 <textarea id="uvod" name="uvod" rows="10" cols="90">
 </textarea><br>
 <label for="glavni_deo">Glavni Deo</label><br>
 <textarea id="glavni_deo" name="glavni_deo" rows="24" cols="90">
 </textarea><br>
 <label for="citat">Citat</label><br>
 <textarea id="anamneza" name="citat" rows="3" cols="90">
</textarea><br>
 <input  type="file" id="file-input" name="image" onchange="getImage(this.value);"><br>
<label  style='width:95%;' class="upload"    for="file-input"><i class="fas fa-image"></i> Izaberi sliku</label><br><br>
<div style="margin-bottom:1rem;margin-left:3%;" id="display-image"></div>
 <br>
 <input style='width:95%;margin-left:3%; ' type="submit" id="submit" name="submit" value="Unesi" placeholder="Vaš password..." ><br>
 
</form>




</div>

<div class="conn1"></div>


<?php require "includes/functions.inc.php"; 
require_once "includes/dbh.inc.php";

?> 






</div>

                



</div>











<?php
include_once './komponente/footer.php'
?>

<script src="script.js">
</script>

    <script>

function getImage(imagename)
    {
        var newimg=imagename.replace(/^.*\\/,"");
$('#display-image').html(newimg);
    }
    </script>
 
</body>

</html>