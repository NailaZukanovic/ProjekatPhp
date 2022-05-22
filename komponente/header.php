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
 

    <style>

        <?php
   include "style.css"
        ?>
    </style>

</head>

<body>

<header class="header">
        <a href="#" id="logo"><span>N</span> Clinic</a>


    <div class="icons">
    <nav class="navbar">
        <a href="home.php">O nama</a>
        <a href="Pregledi.php">Pregledi</a>
        <a href="Novosti.php">Novosti</a>
        <a href="Kontakt.php">Kontakt</a>
        <?php
         if(isset($_SESSION["useruid"]))
         {

             if(($_SESSION["userVrsta"])==="admin")
             {
            

                echo"<a href='profil.php'>Admin Profil<i class='fas fa-user-alt'></i></a>";
                echo"<a href='includes/logout.inc.php'>Logout<i class='fas fa-power-off'></i></a>";
             }
             else
             {
                echo"<a href='profil.php'>Profil<i class='fas fa-user-alt'></i></a>";
                echo"<a href='includes/logout.inc.php'>Logout<i class='fas fa-power-off'></i></a>";
             }

         
         }
         else
         {
            echo"<a href='login.php'>Prijavi se</a>";
         }
        ?>
      
       
    

        </nav>

        
    </div>


</header>

</body>
</html>