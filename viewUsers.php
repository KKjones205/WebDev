<?php
  //Kyle Yallits Project
  //The main page of the CMS
  //Allows the user to read the basic pokemon stats
   require("connect.php");

   $query = "SELECT * FROM users ORDER BY ID ASC";
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
<h3><a href="signup.php">Create User</a></h3>
<h2>List of Users</h2>
  <table>
        <tr>
          <th>Username</th>
          <th>Password</th>
          <th>Email</th>
          <th>Role</th>
          <th>Edit</th>
        </tr>
    <?php while($row = $statement->fetch()): ?>

      <tr>
        <td><?= $row['Username'] ?></td>
        <td><?= $row['Password'] ?></td>
        <td><?= $row['Email'] ?></td>
        <td><?= $row['Role'] ?></td>
        <td><a href="<?="editUsers.php?id={$row['ID']}"?>">edit</a></td>
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
