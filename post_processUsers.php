<?php
///Kyle Yallits Post Process Script
//After a user posts the edit/delete data it comes here
//This checks to see if the data that was edited is valid and updates the database
//If validation fails an error page tells redirecting them back to the main page comes up
require("connect.php");
$queryUpdate = "UPDATE users SET Username = :Username, Password = :Password, Email = :Email, Role = :Role WHERE ID = :ID";
$queryDelete = "DELETE FROM users WHERE id= :id";

if(isset($_POST['delete']))
{
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $statement = $db->prepare($queryDelete);
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("Location: viewUsers.php");
  exit();
}

elseif(!empty($_POST['Username']) && !empty($_POST['Password']) && !empty($_POST['Email']) && !empty($_POST['Role']) && isset($_POST['update']))
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $role = filter_input(INPUT_POST, 'Role', FILTER_VALIDATE_INT);
    $username = filter_input(INPUT_POST, 'Username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'Password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $statement = $db->prepare($queryUpdate);
    $statement->bindValue(':ID', $id);
    $statement->bindValue(':Username',$username);
    $statement->bindValue(':Password',$password);
    $statement->bindValue(':Email',$email);
    $statement->bindValue(':Role',$role);
    $statement->execute();
    header("Location: viewUsers.php");
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS - Error </title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
        <a href="index.php"></a>
        </div>
        <h1>There was an error when attemping to update your user.</h1>
        <p>Please make sure each box has some content</p>
        <a href="index.php">Go Back</a>
    <div id="footer">
        Copywrong 2021
    </div>
</div>
</body>
</html>