<?php

if(isset($_POST["submit"]) )
{
    session_start();

    $jmbg=$_SESSION["jmbg"];
   $email=$_POST["email"];
   $uid=$_POST["uid"];




  
   $pwd=$_POST["pwd"];
   $pwdRepeat=$_POST["pwdrepeat"];

   
   require_once "dbh.inc.php";
   require_once 'functions.inc.php';

//genetrate vkey



if (invalidUid($username)!==false) {
    header("location:../IzmeniPodatke.php?error=invaildUid");
    exit();
    
}


if (pwdMatch($pwd,$pwdRepeat)!==false) {
 header("location:../IzmeniPodatke.php?error=passwordsdontmatch");
 exit();
 
}
if (uidExists($conn,$username,$email)!==false) {
 header("location: ../IzmeniPodatke.php?error=useranameTaken");
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
             
               if(emptyPolje($uid) || emptyPolje($pwd) || emptyPolje($email))
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
               

                $sql="UPDATE user SET slika='$new_img_name' WHERE JMBGkor=$jmbg";



                if ($conn->query($sql) === TRUE) {
                    header("location:../IzmeniPodatke.php?success=slika");
                    exit();
                    
                } else {
                    echo "Error updating record: " . $conn->error;
                
                }
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
                            $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);

                            $sql="UPDATE user SET slika='$new_img_path',KorisnickoIme='$uid',Email='$email',PWD='$hashedPwd' WHERE JMBGkor=$jmbg";



                            if ($conn->query($sql) === TRUE) {
                                header("location:../IzmeniPodatke.php?success=svi");
                                exit();
                                
                            } else {
                                echo "Error updating record: " . $conn->error;
                            
                            }

              }



            }
          else
          {
            $em="You cant upload files of this type!";
        header("Location:../IzmeniPodatke.php?error=$em");   
          }
      }
    

  }
  else{
      
    if(emptyPolje($uid) || emptyPolje($pwd) || emptyPolje($email))
    {
    
        header("Location:../IzmeniPodatke.php?error=emptyinput");   
        exit();
    } 

   
else if (strlen($pwd)<7 || strlen($pwd)>30) {
    header("location:../IzmeniPodatke.php?error=invalidpasswordlength");
    exit();
    
   }
 else  if(invalidEmail($email)!==false)
{
    header("location:../IzmeniPodatke.php?error=invaildEmail");
    exit();
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
        $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);

        $sql="UPDATE user SET KorisnickoIme='$uid',Email='$email',PWD='$hashedPwd' WHERE JMBGkor=$jmbg";


        if ($conn->query($sql) === TRUE) {
            $_SESSION["Email"]=$email;
            $_SESSION["useruid"]=$uid;
            $_SESSION["PWD"]=$hashedPwd;
            header("location:../IzmeniPodatke.php?success=bezslike");
            exit();
            
        } else {
            echo "Error updating record: " . $conn->error;
        
        }

    }
      
  }
  




}

else{
    header("location: ../Izmeni.php");
    exit();
}
