<?php
  //Kyle Yallits Project
  //The main page of the CMS
  //Allows the user to read the basic pokemon stats
   require("connect.php");

   $query2 = "SELECT * FROM trainer ORDER BY ID ASC";
   $statement2 = $db->prepare($query2);
   $statement2->execute();
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
<h2>List of Trainers</h2>
  <table>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Location</th>
          <th>Edit</th>
          <th>Details</th>
        </tr>
    <?php while($rowed = $statement2->fetch()): ?>

      <tr>
        <td><?= $rowed['Name'] ?></td>
        <td><?= $rowed['Type'] ?></td>
        <td><?= $rowed['Location'] ?></td>
        <td><a href="<?="editTrainer.php?id={$rowed['ID']}"?>">edit</a></td>
        <td><a href="<?="detailTrainer.php?id={$rowed['ID']}"?>">Details</a></td>
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
