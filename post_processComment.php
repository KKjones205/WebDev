<?php
///Kyle Yallits Post Process Script
//After a user posts the edit/delete data it comes here
//This checks to see if the data that was edited is valid and updates the database
//If validation fails an error page tells redirecting them back to the main page comes up
require("connect.php");
$queryUpdate = "UPDATE comments SET comment = :comment WHERE ID = :ID";
$queryDelete = "DELETE FROM comments WHERE id= :id";

if(isset($_POST['delete']))
{
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $statement = $db->prepare($queryDelete);
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("Location: index.php");
  exit();
}

elseif(!empty($_POST['comment'])&& isset($_POST['update']))
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);


    $statement = $db->prepare($queryUpdate);
    $statement->bindValue(':ID', $id);
    $statement->bindValue(':comment',$comment);
    $statement->execute();
    header("Location: index.php");
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
        <h1>There was an error when attemping to post your Comment.</h1>
        <p>Please make sure each box has some content</p>
        <a href="index.php">Go Back</a>
    <div id="footer">
        Copywrong 2021
    </div>
</div>
</body>
</html>