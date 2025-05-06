<?php



    include_once('config.php');


    if(isset($_POST['submit']))
    {
        $name=$_POST['name'];
        $surname=$_POST['surname'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $temPass=$_POST['password'];


        $password= password_hash( $temPass,PASSWORD_DEFAULT);




        


        if(empty($name)||empty( $username)||empty($surname)||empty( $email)||empty( $password)){
            echo "You need to fill all the fields.";
        }else{

            $sql="SELECT username from users where username=:username";

            $temSql= $conn->prepare($sql);
            $temSql->bindParam(':username', $username);
            $temSql->execute();

            if($temSql->rowCount()>0){
                echo "username exists!";
                header("refresh:2;url=signup.php");
            }
            else{
                $sql= "INSERT into users (name,surname, email, password) values (:name,:surname,:username, :email, :password)";

                $insertSql = $conn->prepare($sql);

			$insertSql->bindParam(':username', $username);
			$insertSql->bindParam(':name', $name);
			$insertSql->bindParam(':surname', $surname);
			$insertSql->bindParam(':password', $password);
			$insertSql->bindParam(':email', $email);

			$insertSql->execute();

            echo "Data saved successfullly...";

            header("refreshe:2,url=login.php");
            
        }
    }

    }





?>