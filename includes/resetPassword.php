<?php






require_once "functions.inc.php";
require_once "dbh.inc.php";


$pwd=$_POST["pwd"];
$jmbg=$_GET["jmbg"];

$pwdRepeat=$_POST["confirmPwd"];

$ime=PronadjiDoktora($conn,$jmbg);

if(isEmptyPassword($pwd,$pwdRepeat))
{
    header("location:../ResetPassword.php?error=empty&idJ=".$jmbg."");
    exit();
}

if (proveriDuzinuSifre($pwd)==false) {
    header("location:../ResetPassword.php?error=wronglength&idJ=".$jmbg."");
    exit();
    
   }

if (pwdMatch($pwd,$pwdRepeat)!==false) {
    header("location:../ResetPassword.php?error=passwordsdontmatch&idJ=".$jmbg."");
    exit();
    
   }



   $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);

   echo "".$hashedPwd;
 
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

$sql="UPDATE user SET PWD='$hashedPwd'  WHERE JMBGkor=".$jmbg."";



if ($conn->query($sql) === TRUE) {
 

    



  header("location: ../login.php?error=resetSuccess");
  exit();
    
} else {
    echo "Error updating record: " . $conn->error;
 
}


