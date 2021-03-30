<?php
  //Kyle Yallits Project
  //The main page of the CMS
  //Allows the user to read the basic pokemon stats
   require("connect.php");

   $query1 = "SELECT * FROM gymleader ORDER BY ID ASC";
   $statement1 = $db->prepare($query1);
   $statement1->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS</title>
    <link rel="stylesheet" href="stylez.css" type="text/css">
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

<div id="pokemon">
<h2>List of Gym Leaders</h2>

<table>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Number of Pokemon</th>
        <th>Max Level</th>
        <th>Edit</th>
        <th>Details</th>
      </tr>
    <?php while($rows = $statement1->fetch()): ?>
      <tr>
        <td><?= $rows['Name'] ?></td>
        <td><?= $rows['Type'] ?></td>
        <td><?= $rows['NumOfPokemon'] ?></td>
        <td><?= $rows['MaxLevel'] ?></td>
        <td><a href="<?="editGymLeader.php?id={$rows['ID']}"?>">edit</a></td>
        <td><a href="<?="detailGymLeader.php?id={$rows['ID']}"?>">Details</a></td>
      </tr>
    <?php endwhile?>
</table>
  </div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
