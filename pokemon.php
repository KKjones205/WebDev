<?php
  //Kyle Yallits Project
  //The main page of the CMS
  //Allows the user to read the basic pokemon stats
   require("connect.php");

  $query = "SELECT * FROM pokemon ORDER BY ID ASC";
  $statement = $db->prepare($query);
  $statement->execute();
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
<h2>List of Pokemon</h2>
<table>
        <tr>
          <th>Name</th>
          <th>Type</th>
          <th>Secondary Type</th>
          <th>HP</th>
          <th>Attack</th>
          <th>Defense</th>
          <th>Special Attack</th>
          <th>Special Defense</th>
          <th>Edit</th>
          <th>Detail</th>
        </tr>

  <?php while($row = $statement->fetch()): ?>
    <div class='pokemon_content'>

       <tr>
        <td> <?= $row['Name'] ?></td>
        <td><?= $row['Type1'] ?></td>
        <td><?= $row['Type2'] ?></td>
        <td><?= $row['HP'] ?></td>
        <td><?= $row['Attack'] ?></td>
        <td><?= $row['Defense'] ?></td>
        <td><?= $row['SpAttack'] ?></td>
        <td><?= $row['SpDefense'] ?></td>
        <td><a href="<?="edit.php?id={$row['ID']}"?>">edit</a></td>
        <td><a href="<?="detail.php?id={$row['ID']}"?>">Details</a></td>
       </tr>
  </div>
  <?php endwhile ?>
</table>
  </div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
