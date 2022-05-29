<?php

require_once "functions.inc.php";
require_once "dbh.inc.php";

$jmbg=$_GET["jmbg"];

$email=PronadjiEmail($conn,$jmbg);



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

// sql to delete a record
$sql = "DELETE FROM user WHERE JMBGkor =".$jmbg;


if ($conn->query($sql) === TRUE) {
   
/*
    $to=$email;

    $subject="Izbrisan vam je nalog!";
    
    $message='<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
    <div style="max-width:620px;margin:0 auto;font-family:sans-serif;color:#272727"> 
     <h1 style="background:#f6f6f6;font-weight:600;font-size:1rem;padding:10px;text-align:center;color:red;">
     Vaš nalog je izbrisan sa našeg sajta
     </h1>
     
     <div style="text-align:center;color:#34d3b4;font-weight:600;">
     <h2>Vaš Nclinic tim!</h2>
     </div>
    </div>
    </body>
    </html>';
    
    
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    $headers .= 'From:NClinic<nedzad200010@gmail.com>' . "\r\n";

    
     mail($to, $subject, $message, $headers);
     */
  
} else {
    echo "Error deleting record: " . $conn->error;
 
}



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

// sql to delete a record
$sql = "DELETE FROM izabranilekar WHERE JMBGpacijenta =".$jmbg;


if ($conn->query($sql) === TRUE) {
   

    
} else {
    echo "Error deleting record: " . $conn->error;
 
}


$conn->close();



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

// sql to delete a record
$sql = "DELETE FROM pregledi WHERE JMBGkor ='$jmbg' OR JMBGdok='$jmbg'";


if ($conn->query($sql) === TRUE) {
   

     
} else {
    echo "Error deleting record: " . $conn->error;
 
}


$conn->close();

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

// sql to delete a record
$sql = "DELETE FROM karton WHERE JMBGkorisnika ='$jmbg'";


if ($conn->query($sql) === TRUE) {
   

     
} else {
    echo "Error deleting record: " . $conn->error;
 
}


$conn->close();

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

// sql to delete a record
$sql = "DELETE FROM raspored WHERE JMBGdoktora ='$jmbg'";


if ($conn->query($sql) === TRUE) {
   


    echo '<script>alert("Uspešno ste izbrisali!")</script>';
    echo '<script>window.location.href="../Korisnici.php";</script>';
     
} else {
    echo "Error deleting record: " . $conn->error;
 
}


$conn->close();












?>