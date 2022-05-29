<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";
if(isset($_POST["submit"]))
{

   $unetiKod=$_POST["vkod"];
  
$danasnji=date('Y-m-d');
  
   $jmbg=$_GET["jmbg"];


if(emptyPolje($unetiKod))
{
    
header("location:../VerificationScreen.php?error=emptyInput&jmbg=".$jmbg."");
exit();
   
}

   if($unetiKod==PronadjiKod($conn,$jmbg))
   {

          
$sql="UPDATE user SET verified=1,verified_at='$danasnji' WHERE JMBGkor=".$jmbg."";



if ($conn->query($sql) === TRUE) {
  
    header("location: ../login.php?error=verifyS");
} else {
    echo "Error updating record: " . $conn->error;
 
}


   }

   else{

    header("location: ../VerificationScreen.php?error=wrong&jmbg=".$jmbg."");
    exit();
   
   }
   

}