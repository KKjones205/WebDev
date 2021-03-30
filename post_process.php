<?php
///Kyle Yallits Post Process Script
//After a user posts the edit/delete data it comes here
//This checks to see if the data that was edited is valid and updates the database
//If validation fails an error page tells redirecting them back to the main page comes up
require("connect.php");
require('authenticate.php');
$queryUpdate = "UPDATE pokemon SET Name = :Name, Type1 = :Type1, Type2 = :Type2, HP = :HP, Attack = :Attack, Defense = :Defense, SpAttack = :SpAttack, SpDefense = :SpDefense WHERE ID = :ID";
$queryDelete = "DELETE FROM pokemon WHERE id= :id";

if(isset($_POST['delete']))
{
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $statement = $db->prepare($queryDelete);
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("Location: index.php");
  exit();
}

elseif(!empty($_POST['name']) && !empty($_POST['type1']) && !empty($_POST['HP']) && !empty($_POST['attack']) && !empty($_POST['Defense']) && !empty($_POST['SpAttack']) && !empty($_POST['SpDefense']) && isset($_POST['update']))
  {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type1 = filter_input(INPUT_POST, 'type1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $type2 = filter_input(INPUT_POST, 'type2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hp = filter_input(INPUT_POST, 'HP', FILTER_VALIDATE_INT);
    $attack = filter_input(INPUT_POST, 'attack', FILTER_VALIDATE_INT);
    $defense = filter_input(INPUT_POST, 'Defense', FILTER_VALIDATE_INT);
    $spattack = filter_input(INPUT_POST, 'SpAttack', FILTER_VALIDATE_INT);
    $spdefense = filter_input(INPUT_POST, 'SpDefense', FILTER_VALIDATE_INT);


    $statement = $db->prepare($queryUpdate);
    $statement->bindValue(':ID', $id);
    $statement->bindValue(':Name',$name);
    $statement->bindValue(':Type1',$type1);
    $statement->bindValue(':Type2',$type2);
    $statement->bindValue(':HP',$hp);
    $statement->bindValue(':Attack',$attack);
    $statement->bindValue(':Defense',$defense);
    $statement->bindValue(':SpAttack',$spattack);
    $statement->bindValue(':SpDefense',$spdefense);
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
        <h1>There was an error when attemping to post your Pokemon.</h1>
        <p>Please make sure each box except secondary type has some content</p>
        <a href="index.php">Go Back</a>
    <div id="footer">
        Copywrong 2021
    </div>
</div>
</body>
</html>