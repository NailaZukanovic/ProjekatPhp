<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Odibee+Sans&display=swap" rel="stylesheet">
 

    <style>

        <?php
   include "style.css"
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
<h3>Prijavi se</h3>
<?php
if (isset($_GET["error"])) {
    
    if($_GET["error"]=="emptyinput")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Popuni sva polja</div>";
    }
   else if($_GET["error"]=="wronglogin")
    {
        echo"<div  style='margin-left:0;padding:1rem;' class='sredina'>Neispravno korisncko ime/email ili lozinka</div>";
    }
    else if($_GET["error"]=="verifyS")
    {
        echo"<div class='uspeh'>Uspesno ste verifikovali nalog.Ulogujte se za konacan pristup!</div>";
    }
  else if($_GET["error"]=="none")
  {

        echo"<div class='uspeh'><p>Uspešno ste registrovani na sajt!Molimo vas prijavite se još jednom radi bolje sigurnosti!</p></div>";    
  }
  else if($_GET["error"]=="resetSuccess")
  {

        echo"<div class='uspeh'><p>Uspešno ste promenili lozinku !Molimo vas prijavite se još jednom radi bolje sigurnosti!</p></div>";    
  }

 
}
?>
<form action="includes/login.inc.php" method="post">
<label for="ime">Email/Username</label><br>
<input type="text" id="ime" name="uid" placeholder="Email/Username..." ><br>
<label for="ime">Password</label><br>
<input type="password" id="pwd" name="pwd" placeholder="Vaš password..." ><br>
<input type="submit" id="submit" name="submit" value="Prijavi se" placeholder="Vaš password..." ><br>

<p>Nemate nalog?<span style="margin:0 0.5rem">Registrujte se <a class='reg' href="register.php">ovde</a> </span><?php
if (isset($_GET["error"])) {
    
   
        echo"<a class='forgot' href='ForgotEmail.php'>Zaboravili ste šifru?</a>";
 
 

 
}
?></p>



</form>



</div>
<div class="login1">

</div>






</div>




<?php

include_once './komponente/footer.php'
?>

  
</body>







</html>