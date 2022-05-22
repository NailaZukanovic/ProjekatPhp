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

$jmbg=$_GET["idJ"];
?>



<div class="login">
<div class="login1">

</div>
<div class="login1">
<h3>Resetuj Password</h3>
<?php
if (isset($_GET["error"])) {
    
    if($_GET["error"]=="empty")
    {
        echo"<div style='margin-left:0;padding:1rem;' class='sredina'>Popuni sva polja</div>";
    }
   else if($_GET["error"]=="wronglength")
    {
        echo"<div  style='margin-left:0;padding:1rem;' class='sredina'>Password mora imati između 5 i 25 karaktera</div>";
    }
    else if($_GET["error"]=="passwordsdontmatch")
    {
        echo"<div  style='margin-left:0;padding:1rem;' class='sredina'>Unesite dva ista passworda!</div>";
    }
 
 
}
?>
<form action="includes/resetPassword.php?jmbg=<?php echo"".$jmbg ?>"  method="post">
<label for="ime">Password</label><br>
<input type="password" id="ime" name="pwd" placeholder="Vaš password..." ><br>
<label for="ime">Potvrdi Password</label><br>
<input type="password" id="pwd" name="confirmPwd" placeholder="Potvrdi password..." ><br>
<input type="submit" id="submit" name="submit" value="Resetuj" placeholder="Vaš password..." ><br>





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