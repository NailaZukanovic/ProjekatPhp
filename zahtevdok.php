<?php
session_start();
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
   include "style.css"
        ?>
    </style>

</head>

<body>

<?php

include_once './komponente/header.php';
?>

   <div style="padding:6rem;">
       <h3>Zahtev za registraciju kao doktor je uspešno poslat!</h3>
       <h5>Na vašem emailu će stići potvrda o prihvatanju zahteva,u roku od 24h od naše službe!</h5>
   </div>
<?php 
?>


<?php

include_once './komponente/footer.php'
?>

  
</body>







</html>