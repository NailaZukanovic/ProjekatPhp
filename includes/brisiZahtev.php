<?php
$jmbg=$_GET['jmbg'];
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
$sql = "DELETE FROM zahtev WHERE JMBG =". $jmbg;


if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";

    header("Location: ../adminZahtevi.php");
} else {
    echo "Error deleting record: " . $conn->error;
 
}

$conn->close();
?>