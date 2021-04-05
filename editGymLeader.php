<?php
  //Kyle Yallits edit script
  //This script gets the blog post that the user wanted to edit or delete
  //It then allows them to edit it
  //It then posts the data to post process script to actually post the edit or delete
  require('connect.php');
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

    $query = "SELECT * FROM gymleader WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $gymleader = $statement->fetch();
  }
  else{ $id = 'false';}

  if(!is_integer($id))
  {
      header("Location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS - Edit GymLeader </title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Pokemon CMS - Edit Gym Leader</a></h1>
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

<div id="all_blogs">
  <form action="post_processGymLeader.php" method="post">
    <fieldset>
      <legend>Edit</legend>
      <p>
        <label for="name">Name</label>
        <input name="name" id="name" value="<?= $gymleader['Name'] ?>" />
      </p>
      <p>
        <label for="type">Main Type</label>
        <input name="type" id="type" value="<?= $gymleader['Type'] ?>"/>
      </p>
      <p>
        <label for="numofpokemon">Number of Pokemon</label>
        <input type="number" name="numofpokemon" id="numofpokemon" value="<?= $gymleader['NumOfPokemon'] ?>"/>
      </p>
      <p>
        <label for="maxlevel">Max Level</label>
        <input type="number" name="maxlevel" id="maxlevel" value="<?= $gymleader['MaxLevel'] ?>" />
      </p>
      <p>
        <input type="hidden" name="id" value="<?= $gymleader['ID'] ?>" />
        <input type="submit" name="update" value="Update" />
        <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this pokemon?')" />
      </p>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
