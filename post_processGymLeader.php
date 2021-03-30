<?php
///Kyle Yallits Post Process Script
//After a user posts the edit/delete data it comes here
//This checks to see if the data that was edited is valid and updates the database
//If validation fails an error page tells redirecting them back to the main page comes up
require("connect.php");
require('authenticate.php');
$queryUpdate = "UPDATE gymleader SET Name = :Name, Type = :Type, NumOfPokemon = :NumOfPokemon, MaxLevel = :MaxLevel WHERE ID = :ID";
$queryDelete = "DELETE FROM gymleader WHERE id= :id";

if(isset($_POST['delete']))
{
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $statement = $db->prepare($queryDelete);
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("Location: index.php");
  exit();
}

elseif(!empty($_POST['name']) && !empty($_POST['type']) && !empty($_POST['numofpokemon']) && !empty($_POST['maxlevel'])  && isset($_POST['update']))
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $numofpokemon = filter_input(INPUT_POST, 'numofpokemon', FILTER_SANITIZE_NUMBER_INT);
    $maxlevel = filter_input(INPUT_POST, 'maxlevel', FILTER_SANITIZE_NUMBER_INT);


    $statement = $db->prepare($queryUpdate);
    $statement->bindValue(':ID', $id);
    $statement->bindValue(':Name',$name);
    $statement->bindValue(':Type',$type);
    $statement->bindValue(':NumOfPokemon',$numofpokemon);
    $statement->bindValue(':MaxLevel',$maxlevel);
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
        <h1>There was an error when attemping to post your Gym Leader.</h1>
        <p>Please make sure each box has some content</p>
        <a href="index.php">Go Back</a>
    <div id="footer">
        Copywrong 2021
    </div>
</div>
</body>
</html>