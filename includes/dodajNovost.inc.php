
<?php
session_start();

require_once "functions.inc.php";
require_once "dbh.inc.php";
 $jmbg=$_SESSION["jmbg"];
$datump=date('Y-m-d');
$naslov=$_POST["naslov"];
$uvod=$_POST["uvod"];
$glavni_deo=$_POST["glavni_deo"];
$citat=$_POST["citat"];



$img_name=$_FILES['image']['name'];
$img_size=$_FILES['image']['size'];
$tmp_name=$_FILES['image']['tmp_name'];
$error=$_FILES['image']['error'];

if (isEmptyKarton($uvod,$glavni_deo,$naslov)!==false) {


             
    header("location:../DodajNovost.php?state=emptyinput");
    exit();
    
}
if($error===0)
{
    if($img_size>625000){
      $em="File to large!";
      header("Location:../DodajNovost.php?error=largePic");
    }
    else{
        $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);//ekstenzijadokumenta
        $img_ex_lc=strtolower($img_ex);
        $allowed_exs=array("jpg","jpeg","png","webp");
        if(in_array($img_ex_lc,$allowed_exs))
        {
            $new_img_name=uniqid("IMG-",true).'.'.$img_ex_lc;
             $img_upload_path='../uploads/'.$new_img_name;
             move_uploaded_file($tmp_name,$img_upload_path);
       
          
           
            if(proveriNaslov($naslov)!==true)
            {
                header("location:../DodajNovost.php?state=invalidnaslov");
                exit();
            }
           else if(proveriUvod($uvod)!==true)
            {
                header("location:../DodajNovost.php?state=invaliduvod");
                exit();
            }
           else  if(proveriGlavni($glavni_deo)!==true)
            {
                header("location:../DodajNovost.php?state=invalidglavni");
                exit();
            }
           else if(proveriCitat($citat)!==true)
            {
                header("location:../DodajNovost.php?state=invalidcitat");
                exit();
            }
            else
            {
                insertNovost($conn,$jmbg,$naslov,$uvod,$glavni_deo,$citat,$new_img_name,$datump);
            }
          
    
           

        
          }
        else
        {
          $em="You cant upload files of this type!";
      header("Location:DodajNovost.php?error=wrongExP");   
        }
    }
  

}
else{
  
    header("location:../DodajNovost.php?state=emptyslika");
    exit();
    
    
}
/*

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PhpProjekat";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO karton (JMBGKorisnika,JMBGlekara,Anamneza,Dijagnoza,Lečenje,Vreme_Pregleda,Datum_Pregleda) VALUES('$jmbg','$jmbgDok','$anamneza','$dijagnoza','$lečenje','$vremep','$datump');";

if ($conn->query($sql) === TRUE) {
  
    header("location:../KartonDodaj.php?state=success&jmbgKorisnika=".$jmbg."&datum=".$datump."&vreme=".$vremep."");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

*/