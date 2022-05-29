<?php





$idP=$_GET["idP"];
$datum=$_GET["datum"];
$vreme=$_GET["vreme"];



$ex=explode(':',$vreme);
print_r($ex);

$sati=$ex[0];
$minuti=$ex[1];

$danasnjiSat=date('H');
$danasnjimin=date('i');
$danasnji=date('Y/m/d');
$today=strtotime($danasnji);
$termin=strtotime($datum);


echo " ".$today;
echo" ".$termin;
if($today<$termin)
{
   

    
         
        header("location:../SviPreglediZaLekare.php?error=invaliddate");
        
      


}

else if($today===$termin)
{

    
    if($sati>$danasnjiSat)
    {
        
       header("location:../SviPreglediZaLekare.php?error=invaliddate");
    } 
    else if($sati=$danasnjiSat)
    {
        if($minuti>$danasnjimin)
        {
               
       header("location:../SviPreglediZaLekare.php?error=invaliddate");
        }
        else{
            $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PhpProjekat";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    
    
    
    $sql = "DELETE FROM pregledi  WHERE idPregleda =".$idP.";";
    
    
    if ($conn->query($sql) === TRUE) {
        
    
        header("location:../SviPreglediZaLekare.php?success=true");
    
    
    } else {
        echo "Error deleting record: " . $conn->error;
     
    }
    
        }
    }
    else
    {
        $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PhpProjekat";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    
    
    
    $sql = "DELETE FROM pregledi  WHERE idPregleda =".$idP.";";
    
    
    if ($conn->query($sql) === TRUE) {
        
    
        header("location:../SviPreglediZaLekare.php?success=true");
    
    
    } else {
        echo "Error deleting record: " . $conn->error;
     
    }
    
    }

}


else {

    echo "Bio";
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PhpProjekat";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    
    
    
    $sql = "DELETE FROM pregledi  WHERE idPregleda =".$idP.";";
    
    
    if ($conn->query($sql) === TRUE) {
        
    
        header("location:../SviPreglediZaLekare.php?success=true");
    
    
    } else {
        echo "Error deleting record: " . $conn->error;
     
    }
    

}



















?>