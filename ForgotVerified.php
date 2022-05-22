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


$jmbg=$_GET["IdJ"];

require_once "includes/dbh.inc.php";
require_once "includes/functions.inc.php";
$ime=PronadjiDoktora($conn,$jmbg);
?>

</div>
<div class="login1">
<h3 style="margin:2rem 0;color:black;">Zdravo <?php echo "".$ime?></h3>
<h3 style="margin:2rem 0;font-size:2rem;">Na vaš mail je uspešno poslat link do stranice za reset passworda<i style="font-size:2.5rem;margin:0 1rem; color:red;" class="fas fa-share"></i><i style="font-size:3rem; color:red;" class="fas fa-envelope"></i></h3>  
<h3>Proverite vaš mail <a style="color:#34d3b4;" href="https://www.gmail.com/">ovde.</a></h3>


</div>
<div class="login1">

</div>






</div>




<?php

include_once './komponente/footer.php'
?>

  
</body>







</html>