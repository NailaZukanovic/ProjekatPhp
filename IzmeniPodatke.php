<?php
session_start();
$jmbg=$_SESSION["jmbg"];
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
    
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
 

    <style>

        <?php
   include "css/style.css"
        ?>
    </style>

</head>

<body>

<?php

include_once './komponente/header.php';
?>



<div class="login">
<div class="login1">

</div>
<div class="login1">
<h3 style='text-align:center'>Ažuriraj profil</h3>

<?php
if (isset($_GET["error"])) {
    
    if($_GET["error"]=="emptyinput")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Popuni sva polja</div>";
    }
    else if($_GET["error"]=="invalidUid")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Neispravno korisničko ime</div>";
    }
   else if($_GET["error"]=="invalidEmail")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Neispravan email</div>";
    }
   else if($_GET["error"]=="passwordsdontmatch")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Šifre su različite</div>";
    }
   else if($_GET["error"]=="stmtfailed")
    {
        echo"<p>Something went wrong</p>";
    }
   else if($_GET["error"]=="usernameTaken")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Korisničko ime je zauzeto!</div>";
    }
   else if($_GET["error"]=="invalidpasswordlength")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Password mora biti od 7 do 25 karaktera!</div>";
    }
   else if($_GET["error"]=="invalidJmbg")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>JMBG mora sadržati 13 cifara!</div>";
    }
  
 
}
if (isset($_GET["success"])) {
    
    if($_GET["success"]=="slika")
    {
        echo"<div  style='text-align:center;' class='uspeh'>Uspešno ste ažurirali profilnu sliku!</div>";
    }
    else 
    {
        echo"<div  style='text-align:center;' class='uspeh'>Uspešno ste ažurirali podatke!</div>";
    }
 
 
}
?>
<form action="includes/izmeni.inc.php" method="post" enctype="multipart/form-data" >
<input  type="file" id="file-input" name="image" onchange="getImage(this.value);"><br>
<label class="upload"   for="file-input"><i class="fas fa-image"></i> Izaberi sliku</label><br><br>
<div style="margin-bottom:1rem;" id="display-image"></div>
<div  class="imag">
                <?php   require_once "includes/dbh.inc.php";
                            require_once "includes/functions.inc.php";

                            $pronsliku=PronadjiSliku($conn,$_SESSION["jmbg"]);


                if ($pronsliku!='')
                {
                    echo" <img src='uploads/".$pronsliku." '>";
                }
                else{

                    echo "<img src='uploads/profil.webp' >";
                }
           
            ?>
            </div>

<label for="email">Email</label><br>

<input type="text" name="email" placeholder="Email..." ><br>
<label for="ime">Korisničko ime</label><br>
<input type="text" name="uid" placeholder="Username..." ><br>
<label for="ime">Novi Password</label><br>
<input type="password" name="pwd" placeholder="Vaš password..." ><br>
<label for="ime">Potvrdi Password</label><br>
<input type="password" name="pwdrepeat" placeholder="Vaš password..." ><br>

<input type="submit" name="submit" value="Ažuriraj" placeholder="Vaš password..." ><br>





</form>





</div>
<div class="login1">

</div>






</div>





<?php

include_once './komponente/footer.php'
?>




<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script>

    function getImage(imagename)
    {
        var newimg=imagename.replace(/^.*\\/,"");
$('#display-image').html(newimg);
    }
  </script>
</body>







</html>