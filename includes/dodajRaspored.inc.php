<?php
 

session_start();
 if(isset($_POST["submit"]))
 { 
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $IdDoktor=$_POST['id'];
    $datum=$_POST['datum'];
    $vreme=$_POST['vreme'];
    $imeDoktora=PronadjiDoktora($conn,$IdDoktor);
    $danasnji=date('Y/m/d');
    $today=strtotime($danasnji);
    $termin=strtotime($datum);
    echo" ".$IdDoktor;
   
    echo" ".$vreme;
    echo" ".$imeDoktora;
    echo " ".$datum;

    

  
/*


if(isEmptyDok($IdDoktor,$datum,$vreme)!==false)
{
   header("location:../raspored.php?error=praznaPolja");
   exit();
}

if($today>$termin)
{
    header("location:../raspored.php?error=invaliddate");
    
    
}*/


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$sql="SELECT * FROM raspored WHERE JMBGdoktora=$IdDoktor AND Datum='$datum' AND Vreme='$vreme';";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    // output data of each row
    while($row = $result->fetch_assoc()) {
       $rez=true;
    }

    echo "</table>";
} else {
    $rez=false;
}

$conn->close();

if($rez===true)
{
header("location: ../raspored.php?error=zauzetTermin");
    exit();
}




/*dodajRaspored($conn,$IdDoktor,$imeDoktora,$datum,$vreme);*/
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
} 
$sql="INSERT INTO raspored (ImeDoktora,Datum,Vreme,JMBGdoktora) VALUES('$imeDoktora','$datum','$vreme',$IdDoktor);";

if ($conn->query($sql) === TRUE) {
echo '<script>alert("Uspešno ste dodali doktora!")</script>';
echo '<script>window.location.href="../raspored.php";</script>';

} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}


}



 else
 {
    header("location: ../raspored.php");
    exit();
 }

