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

<div class="conn1">


<form action="./includes/dodajUKarton.inc.php" method="post" class='forma'>
   
 <label for="anamneza">Naslov</label><br>
 <textarea id="anamneza" name="anamneza" rows="3" cols="90">
</textarea><br>


 <label for="anamneza">Uvod</label><br>
 <textarea id="dijagnoza" name="dijagnoza" rows="10" cols="90">
 </textarea><br>
 <label for="anamneza">Glavni Deo</label><br>
 <textarea id="lečenje" name="lečenje" rows="24" cols="90">
 </textarea><br>
 <label for="anamneza">Citat</label><br>
 <textarea id="anamneza" name="anamneza" rows="3" cols="90">
</textarea><br>
 <input  type="file" id="file-input" name="image" onchange="getImage(this.value);"><br>
<label class="upload"    for="file-input"><i class="fas fa-image"></i> Izaberi sliku</label><br><br>
<div style="margin-bottom:1rem;" id="display-image"></div>
 <br>
 <input style='width:20%;' type="submit" id="submit" name="submit" value="Unesi" placeholder="Vaš password..." ><br>
 <?php
if (isset($_GET["state"])) {
    
    if($_GET["state"]=="emptyinput")
    {
        echo"<div style='width:15rem; text-align:center;' class='danger'><p>Popunite sva polja!</p></div>";
    }
    if($_GET["state"]=="success")
    {
        echo"<div class='danger'><p>Uspešno ste uneli podatke u karton!</p></div>";
    }
   
 

 
}
?>
</form>


</div>




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