<?php


 function emptyInputSignup($name,$email,$username,$pwd,$pwdRepeat)
 {




    $result;

    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result=true;
    }
    else{
        $result=false;
    }


    return $result;
 }


 function invalidUid($username)
 {

    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username))
    {
        $result=true;
    }

    else{
        $result=false;
    }

    return $result;
 }

 function invalidEmail($email)
 {

    $result;
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $result=true;
    }

    else{
        $result=false;
    }

    return $result;
 }

 
 function pwdMatch($pwd,$pwdRepeat)
 {

    $result;
    if($pwd!==$pwdRepeat)
    {
        $result=true;
    }

    else{
        $result=false;
    }

    return $result;
 }
 function proveriJmbg($jmbg)
 {

    $result;

    if(strlen($jmbg)==13)
    {
        $result=true;
    }

    else{
        $result=false;
    }

    return $result;
 }

 function uidExists($conn,$username,$email)
 {

    $sql="SELECT * FROM user WHERE KorisnickoIme= ? OR Email= ?;";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$username,$email);

    mysqli_stmt_execute($stmt);


    $resultData=mysqli_stmt_get_result($stmt);

    if($row=mysqli_fetch_assoc($resultData))
    {
              return $row;
    }
    else
    {
        $result=false;
        
         return $result;
    }

    mysqli_stmt_close($stmt);
 

}
 function createUser($conn,$name,$email,$username,$pwd,$vrsta,$jmbg,$mesto,$datum,$pol,$doktor,$slika)
 {
    
if($doktor==="Doktor")
{
    $sql="INSERT INTO zahtev (Ime,Email,KorisnickoIme,PWD,VrstaKorisnika,JMBG,Mesto_Rodj,Datum_Rodj,Pol,slika) VALUES(?,?,?,?,?,?,?,?,?,?);";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:../register.php?error=stmtfailed");
        exit();
    }
 
   $dok="doktor";
   $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"ssssssssss",$name,$email,$username,$hashedPwd,$dok,$jmbg,$mesto,$datum,$pol,$slika);
    
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    
    session_start();
        $_SESSION["Ime"]=$name;
        $_SESSION["Email"]=$email;
        $_SESSION["KorisnickoIme"]=$username;
        $_SESSION["PWD"]=$hashedPwd;
        $_SESSION["Jmbg"]=$jmbg;
        $_SESSION["MestoR"]=$mesto;
        $_SESSION["DatumR"]=$datum;
        $_SESSION["Pol"]=$pol;
   
    header("location:../zahtevdok.php?error=none");
    exit();


}
       


else
{

    $sql="INSERT INTO user (Ime,Email,KorisnickoIme,PWD,vrsta,JMBGKor,Mesto_Rodj,Datum_Rodj,Pol,slika,vkey,verified) VALUES(?,?,?,?,?,?,?,?,?,?,?,?);";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:../register.php?error=stmtfailed");
        exit();
    }
 

   $hashedPwd=password_hash($pwd,PASSWORD_DEFAULT);
$verifiedBegin=0;
$vkey=substr(md5(time().$username),0,10);

    mysqli_stmt_bind_param($stmt,"ssssssssssss",$name,$email,$username,$hashedPwd,$vrsta,$jmbg,$mesto,$datum,$pol,$slika,$vkey,$verifiedBegin);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
   
    $to=$email;

    $subject="Verifikacija na Nclinic!";
    
    $message="<!DOCTYPE html>
    <html lang='en'>
    <head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <style>
    @media only screen and (max-width:620px){
        .h1{
            font-size:20px;
            padding:5px;
        }
    }
    </style>
    </head>
    <body>
    <div>
    <div style='max-width:620px;margin:0 auto;font-family:sans-serif;color:#272727'> 
     <h1 style='background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:#272727;'>
     Vaš verifikacioni kod je ".$vkey."
     </h1>
     <p style='color:#272727;'>Link ispod vas vodi do forme za verifikaciju:</p>
     <div style='width:100%;text-align:center;'><a href='http://localhost/ProjekatPhp/VerificationScreen.php?jmbg=$jmbg' style='font-family:sans-serif;margin:0 auto;text-align:center;padding:10px;background:#34d3b4;border-radius:4px;font-size:20px 10px;color:#fff;cursor:pointer;text-decoration:none;display:inline-block;'>
     Unesi!
     </a>
     </div>
     <div style='text-align:center;color:#34d3b4;font-weight:600;'>
     <h2>Vaš Nclinic tim!</h2>
     </div>
    </div>
    </body>
    </html>";
    
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    $headers .= 'From:NClinic<nedzad200010@gmail.com>' . "\r\n";
   
    
     mail($to, $subject, $message, $headers);
       
 
    
    header("location:../VerificationScreen.php?jmbg=".$jmbg."");
    exit();


}
       
        

 }




 function emptyInputLogin($username,$pwd)
 {




    $result;

    if (empty($username) || empty($pwd)) {
        $result=true;
    }
    else{
        $result=false;
    }


    return $result;
 }


 
 function emptyPolje($polje)
 {




    $result;

    if (empty($polje)) {
        $result=true;
    }
    else{
        $result=false;
    }


    return $result;
 }


function loginUser($conn,$username,$pwd)
{

     $uidExist=uidExists($conn,$username,$username);

     if($uidExist===false)
     {
         header("location:../login.php?error=wronglogin");
         exit();
     }

     $pwdHashed=$uidExist["PWD"];

     $checkPwd=password_verify($pwd,$pwdHashed);

     if ($checkPwd===false) {
        header("location:../login.php?error=wronglogin");
        exit();
     }

     else if($checkPwd===true)
     {

        session_start();
        $_SESSION["userid"]=$uidExist["usersId"];
        $_SESSION["useruid"]=$uidExist["KorisnickoIme"];
        $_SESSION["userVrsta"]=$uidExist["vrsta"];
        $_SESSION["ime"]=$uidExist["Ime"];
        $_SESSION["jmbg"]=$uidExist["JMBGKor"];
        $_SESSION["Email"]=$uidExist["Email"];
        $_SESSION["Pol"]=$uidExist["Pol"];
        $_SESSION["DatumR"]=$uidExist["Datum_Rodj"];
        $_SESSION["MestoR"]=$uidExist["Mesto_Rodj"];
       
       
        header("location:../profil.php");
        exit();
     }


}

function isEmptyDok($dok,$datum,$vreme)
{
    $result;
    if(empty($dok) || empty($datum) || empty($vreme))
    {
        $result=true;
    }
    else
    {
        $result=false;
    }
   return $result;
}
function isEmptyKarton($anamneza,$dijagnoza,$lečenje)
{
    $result;
    if(empty($anamneza) || empty($dijagnoza) || empty($lečenje))
    {
        $result=true;
    }
    else
    {
        $result=false;
    }
   return $result;
}
function isEmptyPassword($pwd,$pwdRepeat)
{
    $result;
    if(empty($pwd) || empty($pwdRepeat))
    {
        $result=true;
    }
    else
    {
        $result=false;
    }
   return $result;
}


function dodajRaspored($conn,$idDoktora,$doktor,$datum,$vreme)
{

    $sql="INSERT INTO raspored (JMBGdoktora,ImeDoktora,Datum,Vreme) VALUES (?,?,?,?);";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:../raspored.php?error=stmtfailed");
        exit();
    }
 

 

    mysqli_stmt_bind_param($stmt,"ssss",$idDoktora,$doktor,$datum,$vreme);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);


    exit();
        


}




function PronadjiDoktora($conn,$JMBGDoktora)
{
 

    $sql="SELECT Ime FROM user WHERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $JMBGDoktora);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         return $row["Ime"];
    }


$conn->close();


}
function PronadjiSliku($conn,$jmbgzasliku)
{

    $sql="SELECT slika FROM user WhERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbgzasliku);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['slika'];
         return $pdoktor;
    }
   




}

function PronadjiEmail($conn,$jmbge)
{

    $sql="SELECT Email FROM user WhERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbge);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['Email'];
         return $pdoktor;
    }
   




}
function PronadjiDatum($conn,$jmbge)
{

    $sql="SELECT Datum_Rodj FROM user WhERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbge);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['Datum_Rodj'];
         return $pdoktor;
    }
   




}
function MestoRodjenja($conn,$jmbge)
{

    $sql="SELECT Mesto_Rodj FROM user WhERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbge);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['Mesto_Rodj'];
         return $pdoktor;
    }
   




}


function IzabraniDoktori($conn,$jmbge)
{

    $sql="SELECT JMBGpacijenta,JMBGdoktora FROM izabranilekar WhERE JMBGpacijenta=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbge);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['JMBGdoktora'];
         return $pdoktor;
    }
   




}




function postojiTermin($conn,$idDoktora,$Datum,$Vreme)
{


   


    

   $sql="SELECT * FROM raspored WHERE idDoktora=? AND Datum=? AND Vreme=?;";

   $stmt=mysqli_stmt_init($conn);

   if (!mysqli_stmt_prepare($stmt,$sql)) {
       header("location: ../raspored.php?error=stmtfailed");
       exit();
   }

   mysqli_stmt_bind_param($stmt,"iss",$IdDoktora,$Datum,$Vreme);

   mysqli_stmt_execute($stmt);


   $resultData=mysqli_stmt_get_result($stmt);

   if($row=mysqli_fetch_assoc($resultData))
   {
             return $row;
   }
   else
   {
       $result=false;
       
        return $result;
   }

   mysqli_stmt_close($stmt);


}


function IzabraniLekar($conn,$jmbgD,$imeD,$imeP,$jmbgP,$emailp,$Polp)
{

    $sql="INSERT INTO izabranilekar (JMBGdoktora,ImeDoktora,ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta) VALUES(?,?,?,?,?,?);";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:../register.php?error=stmtfailed");
        exit();
    }
 

    mysqli_stmt_bind_param($stmt,"ssssss",$jmbgD,$imeD,$imeP,$jmbgP,$emailp,$Polp);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
   
   
    echo '<script>alert("Uspešno ste izvrisli!")</script>';
    echo '<script>window.location.href="../profil.php";</script>';
    
    exit();

}


function PromeniDoktora($conn,$jmbgD,$imeD,$imeP,$jmbgP,$emailp,$Polp)
{

    $sql="INSERT INTO promenalekara (JMBGdoktora,ImeDoktora,ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta) VALUES(?,?,?,?,?,?);";

    $stmt=mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location:../register.php?error=stmtfailed");
        exit();
    }
 

    mysqli_stmt_bind_param($stmt,"ssssss",$jmbgD,$imeD,$imeP,$jmbgP,$emailp,$Polp);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
   
   
    echo '<script>alert("Uspešno ste poslali zahtev za promenu lekara!Admin tim će vas putem maila blagovremeno obavestiti.")</script>';
    echo '<script>window.location.href="../profil.php";</script>';
    
    exit();

}


function daliImaIzabranog($conn,$idd)
{

    $sql = "SELECT ImePacijenta,JMBGpacijenta,EmailPacijenta,PolPacijenta FROM izabranilekar WHERE JMBGpacijenta=$idd;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $idd);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $pdoktor=$row['ImePacijenta'];
         return $pdoktor;
    }


$conn->close();


}


function selectUser($conn,$jmbg22)
{

    
    $sql="SELECT Ime,Email,KorisnickoIme,PWD,vrsta,JMBG,Mesto_Rodj,Datum_Rodj,Pol FROM user WhERE JMBG='?';";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $jmbg22);
    $stmt->execute();
    $result = $stmt->get_result();
    echo "<form method='GET'><div class='sred'><table id='customers'><tr><th>Ime</th><th>Email</th><th>Korisnicko Ime</th><th>Mesto_Rodj</th><th>Datum_Rodj</th><th>Pol</th></tr>";
    while ($row = $result->fetch_assoc()) {
       
      
            echo "<tr><td>".$row["Ime"]."</td><td>".$row["Email"]."</td><td>".$row["KorisnickoIme"]."</td><td>".$row["Mesto_Rodj"]."</td><td>".$row["Datum_Rodj"]."</td><td>".$row["Pol"]."</td><td style='padding:1rem;'><a href='./includes/brisiZahtev.php?jmbg=".$row['JMBG']."'><i style='color:red;' class='fas fa-trash'></i></a>/<a href='./includes/dodajZahtev.inc.php'><i style='color:green;' class='fas fa-check-circle'></i></a></td></tr>";
        
    }
    
    echo "</table>";
    echo "</div>";
    


$conn->close();
return $pdoktor;


}



function PronadjiPassword($conn,$jmbgp)
{

    $sql="SELECT PWD FROM zahtev WHERE JMBG=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("i", $jmbgp);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         $hash=$row['PWD'];
         return $hash;
    }
    $conn->close();




}


function PronadjiKod($conn,$JMBGDoktora)
{
 

    $sql="SELECT vkey FROM user WHERE JMBGkor=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $JMBGDoktora);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         return $row["vkey"];
    }


$conn->close();


}
function PronadjiJmbg($conn,$email)
{
 

    $sql="SELECT JMBGkor FROM user WHERE Email=?;";

    $stmt = $conn->prepare($sql); 
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
         return $row["JMBGkor"];
    }


$conn->close();


}



function proveriDuzinuSifre($pwd)
{

   $result;

   if(strlen($pwd)>4 && strlen($pwd)<26) 
   {
       $result=true;
   }

   else{
       $result=false;
   }

   return $result;
}
