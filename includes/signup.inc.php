<?php

if(isset($_POST["submit"]) )
{
   $name=$_POST["ime"];
   $email=$_POST["email"];
   $jmbg=$_POST["jmbg"];
   $mesto=$_POST["mesto"];
   $datum=$_POST["datum"];
   $m=$_POST["pol"];
   $vrsta="pacijent";
   $doktor=$_POST["doktor"];

   

  
   $pwd=$_POST["pwd"];
   $pwdRepeat=$_POST["pwdrepeat"];
   
   require_once "dbh.inc.php";
   require_once 'functions.inc.php';

   $username=kreirajKorisnicko($conn,$name); 
 
   
  
   

 





  if (emptyInputSignup($name,$email,$username,$pwd,$pwdRepeat)!==false) {
    header("location:../register.php?error=emptyinput");
    exit();
    
     }
  if(CheckName($name)!==true)
   {
    header("location:../register.php?error=invalidName");
    exit();
   }
  
if (invalidEmail($email)!==false) {
 header("location:../register.php?error=invalidEmail");
 exit();
 
}
if (strlen($jmbg)>13 || strlen($jmbg)<13) {
 header("location:../register.php?error=invalidJmbg");
 exit();
 
}

if (jmbgExists($conn,$jmbg)===true) {
  header("location:../register.php?error=alreadyExists");
  exit();
  
 }
if(CheckMesto($mesto)!==true)
{
 header("location:../register.php?error=invalidPlace");
 exit();
}
if(ProveriDatume($datum)!==true)
{
 header("location:../register.php?error=invalidDate");
 exit();
}
if (pwdMatch($pwd,$pwdRepeat)!==false) {
 header("location:../register.php?error=passwordsdontmatch");
 exit();
 
}

if (strlen($pwd)<7 || strlen($pwd)>30) {
  header("location:../register.php?error=invalidpasswordlength");
  exit();
  
 }



  $img_name=$_FILES['image']['name'];
  $img_size=$_FILES['image']['size'];
  $tmp_name=$_FILES['image']['tmp_name'];
  $error=$_FILES['image']['error'];

  if($error===0)
  {
      if($img_size>625000){
        $em="File to large!";
        header("Location:../login.php?error=$em");
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
               createUser($conn,$name,$email,$username,$pwd,$vrsta,$jmbg,$mesto,$datum,$m,$doktor,$new_img_name);
              
          
            }
          else
          {
            $em="You cant upload files of this type!";
        header("Location:login.php?error=$em");   
          }
      }
    

  }
  else{
      $im="";
    createUser($conn,$name,$email,$username,$pwd,$vrsta,$jmbg,$mesto,$datum,$m,$doktor,$im);
 
      
  }
  


*/

}

else{
    header("location: ../register.php");
    exit();
}
