<?php
session_start();
?>

<!DOCTYPE html>


<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fontawesome-free-5.15.3-web/css/all.min.css">

 
    <style>

        <?php
include 'css/style.css';
        ?>
td{
    padding-left:2rem;
}

    </style>

</head>

<body>
    
<?php

include_once './komponente/header.php';
?>



<h2 class="h2text">Naš cenovnik</h2>
<div style='font-size:1.6rem;margin-top :1rem;' class='sred'>

<table  id='customers'><tr><th >NAZIV USLUGE</th><th >CENA (rsd)</th></tr>

<tr  <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="pregled")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Kompletan oftalmološki pregled</td> <td>4800</td>
</tr>
<tr >
<td style=" padding-left:4rem;">
Pregled prednjeg segmenta oka</td> <td>2400</td>
</tr>
<tr>
<td style=" padding-left:4rem;" >
Pregled zadnjeg segmenta oka</td> <td>2400</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Određivanje dioptrije</td> <td>1400</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Pregled za kontaktna sočiva</td> <td>1400</td>
</tr>
<tr <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="vidnopolje")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Vidno polje (po oku)</td> <td>1600</td>
</tr>

<tr <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="oct")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
OCT (po oku)</td> <td>3000</td>
</tr>
<tr  <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="ultrazvuk")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Ultrazvuk </td> <td>4500</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Merenje očnog pritiska</td> <td>900</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Merenje centralne debljine rožnjače (pahimetrija)</td> <td>1500</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Dnevni profil očnog pritiska</td> <td>3600</td>
</tr>
<tr <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="glaukom")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Provokacija kod glaukoma</td> <td>2000</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Uklanjanje stranog tela</td> <td>2400</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Aplikacija terapijskog kontaktnog sočiva</td> <td>1200</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Bris konjunktive (po oku)</td> <td>1000</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Subkonjunktivalna injekcija</td> <td>4600</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Parabulbarna injekcija</td> <td>6000</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Mala hirurška intervencija</td> <td>12000</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Sondiranje suznih kanala</td> <td>12000</td>
</tr>

<tr  <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="laserskeop")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Laserska intervencija po oku</td> <td>16000</td>
</tr>
<tr  <?php  

if (isset($_GET["usluga"])) {
    
    if($_GET["usluga"]=="isihara")
    {
        echo "style='background-color:rgb(255, 226, 61);'";
    }
 
}


?>>
<td style=" padding-left:4rem;">
Isihara test</td> <td>1000</td>
</tr>
<tr>
<td style=" padding-left:4rem;">
Fotografija fundusa</td> <td>1300</td>
</tr>

</table>
  </div>




<?php

include_once './komponente/footer.php';

?>




</body>



</html>