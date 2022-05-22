<?php

    if(isset($_POST["submit"]))
    {

        $username=$_POST["uid"];
        $pwd=$_POST["pwd"];
     
    
        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if (emptyInputLogin($username,$pwd)!==false) {
            header("location:../login.php?error=emptyinput");
            exit();
            
        }

        $sql="SELECT verified FROM user WHERE KorisnickoIme='$username' OR Email ='$username';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
       
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $verifiedStatus=$row['verified'];
            }
     
            
        } else {
           
        }
       
  
        if($verifiedStatus!=1)
        {
            header("location:../login.php?error=notverified");
            exit();
        }
        
        
            loginUser($conn,$username,$pwd);
            $conn->close();
        
    }

    else{
        header("location:../login.php");
        exit();
    }
