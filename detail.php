<?php
  //Kyle Yallits Detail Page
  //Comes up when someone clicks read more or the title of a blog post
  //Allows the user to read the full post
    require('connect.php');

    $id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $query = "SELECT * FROM pokemon WHERE id=:id";
    $statement= $db->prepare($query);
    $statement->bindValue(':id',$id);
    $statement->execute();
    $pokemon = $statement->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS - Details</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Pokemon CMS Details - <?= $pokemon['Name'] ?></a></h1>
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

        
    <h2><?= $pokemon['Name'] ?></h2>
    <div class='pokemon_content'>
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
        </tr>
       <tr>
        <td> <?= $pokemon['Name'] ?></td>
        <td><?= $pokemon['Type1'] ?></td>
        <td><?= $pokemon['Type2'] ?></td>
        <td><?= $pokemon['HP'] ?></td>
        <td><?= $pokemon['Attack'] ?></td>
        <td><?= $pokemon['Defense'] ?></td>
        <td><?= $pokemon['SpAttack'] ?></td>
        <td><?= $pokemon['SpDefense'] ?></td>
        <td><a href="<?="edit.php?id={$pokemon['ID']}"?>">edit</a></td>
       </tr>
      </table>
  </div>
  </div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
