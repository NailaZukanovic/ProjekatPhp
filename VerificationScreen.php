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
<?php
session_start();

?>

<div style="height:50rem;" class="login">
<div class="login1">
<?php


$jmbg=$_GET["jmbg"];


?>

</div>
<div class="login1">

<h3 style="margin:2rem 0">Na vaš mail je poslat verifikacioni kod <i style="font-size:2.5rem;margin:0 1rem; color:red;" class="fas fa-share"></i><i style="font-size:3rem; color:red;" class="fas fa-envelope"></i></h3>  
<form action="includes/verifyemail.php?jmbg=<?php echo"".$jmbg ?>"  method="post">

<h5>Unesite verifikacioni radi daljeg pristupa sajtu!</h5>

<?php
if (isset($_GET["error"])) {
    
    if($_GET["error"]=="wrong")
    {
        echo"<div style='padding:1.2rem;margin-left:0; '  class='sredina'>Neispravan kod!</div>";
    }
   else if($_GET["error"]=="emptyInput")
    {
        echo"<div style='padding:1.2rem;margin-left:0; '  class='sredina'>Popunite sva polja!</div>";
    }

 
}
?>
<label for="ime">Verifikacioni kod</label><br>
<input type="text" id="ime" name="vkod" placeholder="Unesite verifikacioni kod.." ><br>

<input type="submit" id="submit" name="submit" value="Verifikuj" placeholder="Vaš password..." ><br>


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