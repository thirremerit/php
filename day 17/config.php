<?php  

$user = "root";
$pass = "";
$server="localhost";
$dbname="dbanes";

try{
    $conn = new PDO("mysql:host=$server; dbname=$dbname",$user.$pass);
}catch(PDOException $e){
    echo "error:". $e->getMessage();
}







?>