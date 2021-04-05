<?php
    //Kyle Yallits Create Page
    //Requires authentication, allows the user to create a new page
    //Makes sure the data is proper before posting it
  
    session_start();
    require('connect.php');
    date_default_timezone_set("America/Chicago");

    if(isset($_SESSION['user']))
    {
      if($_SESSION['role'] == 1)
      {
        header("Location: error.php");
      }
    }else{
      header("Location: error.php");
    }

    if($_POST)
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type = filter_input(INPUT_POST, 'type', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $numofpokemon = filter_input(INPUT_POST, 'numofpokemon', FILTER_SANITIZE_NUMBER_INT);
        $maxlevel = filter_input(INPUT_POST, 'maxlevel', FILTER_SANITIZE_NUMBER_INT);
      
      

        $query = "INSERT INTO gymleader (Name,Type,NumOfPokemon,MaxLevel) VALUES (:Name,:Type,:NumOfPokemon,:MaxLevel)";
        $statement = $db->prepare($query);
        $statement->bindValue(':Name',$name);
        $statement->bindValue(':Type',$type);
        $statement->bindValue(':NumOfPokemon',$numofpokemon);
        $statement->bindValue(':MaxLevel',$maxlevel);
        $statement->execute();
        header("Location: index.php");
    } 
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Pokemon</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Pokemon CMS - New Gym Leader</a></h1>
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
  <form action="createGymLeader.php" method="post">
    <fieldset>
      <legend>New Pokemon</legend>
      <p>
        <label for="name">Name</label>
        <input name="name" id="name" />
      </p>
      <p>
        <label for="type">Main Type</label>
        <input name="type" id="type" />
      </p>
      <p>
        <label for="numofpokemon">Number of Pokemon</label>
        <input type="number" name="numofpokemon" id="numofpokemon" />
      </p>
      <p>
        <label for="maxlevel">Max Level</label>
        <input type="number" name="maxlevel" id="maxlevel" />
      </p>
      <p>
        <input type="submit" name="command" value="Create" />
      </p>
      <?php if($_POST): ?>
      <p style="color:red">  
           Your validation failed, please try again.
      </p>
      <?php endif ?>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
