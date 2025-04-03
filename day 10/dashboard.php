<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
include_once("config.php");
$sql = "select * from user";
$getUsers= $conn->prepare($sql);

$getUsers->execute();

$users=$getUsers->fetchAll();

?>



<table>
    <thead>
        <th>ID</th>
        <th>name</th>
        <th>surname</th>
        <th>email</th>
    </thead>

    <tbody>
        <?php
        foreach($users as $user) {
            ?>
            <tr>
                <td><?= $user['id']?></td>
                <td><?= $user['name']?></td>
                <td><?= $user['surname']?></td>
                <td><?= $user['email']?></td>
            </tr>
            <?php } ?>

        
         
         
        
        

            
    </tbody>
</table>

<a href="index.php">go to indeks</a>


    
</body>
</html>