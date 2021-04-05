<?php

    require("connect.php");
    session_start();
    if(isset($_SESSION['user']))
    {
      if($_SESSION['role'] == 1)
      {
        header("Location: error.php");
      }
    }else{
      header("Location: error.php");
    }

    if(isset($_GET['id']))
    {
      $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  
      $query = "SELECT * FROM users WHERE id = :id";
      $statement = $db->prepare($query);
      $statement->bindValue(':id', $id, PDO::PARAM_INT);
      $statement->execute();
      $users = $statement->fetch();
    }
    else{ $id = 'false';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Pokemon CMS</a></h1>
        </div> <!-- END div id="header" -->
<div class="vertical-menu">
  <a href="index.php" class="active">Home </a>
  <a href="pokemon.php">View Pokemon</a>
  <a href="trainer.php">View Trainers</a>
  <a href="gymleader.php">View Gym Leaders </a>
  <a href="createPokemon.php">New Pokemon</a>
  <a href="createTrainer.php">New Trainer</a>
  <a href="createGymLeader.php">New GymLeader</a>
</div> 

<form action="post_processUsers.php" method="post">
    <fieldset>
      <legend>Edit Users</legend>
      <p>
        <label for="Username">Username</label>
        <input name="Username" id="Username" value="<?= $users['Username'] ?>" />
      </p>
      <p>
        <label for="Password">Password</label>
        <input name="Password" id="Password" value="<?= $users['Password'] ?>"/>
      </p>
      <p>
        <label for="Email">Email</label>
        <input type="email" name="Email" id="Email" value="<?= $users['Email'] ?>"/>
      </p>
      <p>
        <label for="Role">Role: 1 for User, 2 for Admin</label>
        <input type="number" name="Role" id="Role" value="<?= $users['Role'] ?>"/>
      </p>
      <p>
        <input type="hidden" name="id" value="<?= $users['ID'] ?>" />
        <input type="submit" name="update" value="Update" />
        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this user?')" />
      </p>
    </fieldset>
  </form>

        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
