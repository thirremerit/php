<?php

include_once('config.php');
if(isset($_POST['submit']))
{
    $emri= $_POST['emri'];
    $username= $_POST['username'];
    $email= $_POST['email'];


    $tempPass =$_POST['password'];
    $password= password_hash($tempPass,PASSWORD_DEFAULT);

   

    if(empty($emri) || empty($username) ||empty($email) ||empty($password)){
        echo "You have not filled in all the fields";
    }else{
        $sql = "INSERT INTO users(emri,username,email,password)
         Values (:emri,:username,:email,:password)";

         $insertSql = $conn->prepare($sql);
         $insertSql->bindParam(':emri',$emri);
         $insertSql->bindParam(':username',$username);
         $insertSql->bindParam(':email',$email);
         $insertSql->bindParam(':password',$password);
       

         $inserSql->execute();

         header("Location:login.php");

    }





}

?>