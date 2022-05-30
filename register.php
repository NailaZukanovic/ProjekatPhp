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
<h3>Registruj se se</h3>

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
   else if($_GET["error"]=="invalidJmbg")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>JMBG mora sadržati 13 cifara!</div>";
    }
   else if($_GET["error"]=="invalidName")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Pogresan format imena!</div>";
    }
   else if($_GET["error"]=="invalidPlace")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Format mesta je grad(mesto),Drzava</div>";
    }
   else if($_GET["error"]=="invalidDate")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Imate neodgovarajuci broj godina!</div>";
    }
   else if($_GET["error"]=="invalidpasswordlength")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Password mora imati izmedju 6 i 30 karaktera!</div>";
    }
   else if($_GET["error"]=="alreadyExists")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Ovakav korisnik već postoji!</div>";
    }

    
  
 
}
?>
<form action="includes/signup.inc.php" method="post" enctype="multipart/form-data" >
<label for="ime">Ime i Prezime</label><br>
<input type="text" name="ime" placeholder="ime i prezime..." ><br>
<label for="email">Email</label><br>
<input type="text" name="email" placeholder="Email..." ><br>
<label for="jmbg">Jmbg</label><br>
<input type="text" name="jmbg" placeholder="Jmbg..." ><br>
<label for="mesto">Mesto Rodjenja</label><br>
<input type="text" name="mesto" placeholder="mesto..." ><br>
<label for="datum">Datum Rodjenja</label><br>
<input type="date" name="datum" placeholder="datum..." ><br>

<input  type="file" id="file-input" name="image" onchange="getImage(this.value);"><br>
<label class="upload"   for="file-input"><i class="fas fa-image"></i> Izaberi sliku</label><br><br>
<div style="margin-bottom:1rem;" id="display-image"></div>

<label for="pol">Pol</label><br>
<select name="pol" id="">
<option value=""></option>
<option value="M">Muški</option>
<option value="Ž">Ženski</option>
</select>

<label for="ime">Password</label><br>
<input type="password" name="pwd" placeholder="Vaš password..." ><br>
<label for="ime">Potvrdi Password</label><br>
<input type="password" name="pwdrepeat" placeholder="Vaš password..." ><br>
<label for="doktor">Pošaljite zahtev za registraciju kao doktor</label><br>
<input type="hidden" name="doktor" value="0"><br>
<input type="checkbox" name="doktor" value="Doktor"><br>
<input type="submit" name="submit" value="Registruj se" placeholder="Vaš password..." ><br>


<p>Imate nalog?<span style="margin:0 0.5rem">Prijavi se <a class="reg" href="login.php">ovde</a> </span></p>


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