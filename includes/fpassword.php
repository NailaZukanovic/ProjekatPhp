<?php






require_once "functions.inc.php";
require_once "dbh.inc.php";
$email=$_POST["email"];

$jmbg=PronadjiJmbg($conn,$email);

echo " ".$email;
echo " ".$jmbg;

if(emptyPolje($email))
{
    
header("location:../ForgotEmail.php?error=emptyinput");
exit();
   
}


if (invalidEmail($email)!==false) {
    header("location:../ForgotEmail.php?error=invalidEmail");
    exit();
    
}



$to=$Email;

$subject="Zahtev za reset lozinke";

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
 <h1 style='background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:#272727;''>
 Zdravo ".PronadjiDoktora($conn,$jmbg)."!
 </h1>
 <h1 style='background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:#272727;''>
 Ukoliko ste zaboravili lozinku link ispod vas vodi do forme za resetovanje .
 </h1>

 <p style='color:#272727;'>Link  do  forme za reset:</p>
 <div style='width:100%;text-align:center;'><a href='http://localhost/ProjekatPhp/ResetPassword.php?idJ=".$jmbg."' style='font-family:sans-serif;margin:0 auto;text-align:center;padding:10px;background:#34d3b4;border-radius:4px;font-size:20px 10px;color:#fff;cursor:pointer;text-decoration:none;display:inline-block;'>
 Resetuj šifru!
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
$headers .= 'Cc: nedzad200010@gmail.com' . "\r\n";

 mail($to, $subject, $message, $headers);
 echo "<script>alert('Poslali ste zahtev za promenu lozinke!')</script>";
 echo "<script>window.location.href='../ForgotVerified.php?IdJ=".$jmbg."'</script>";
  