<?php
  //Kyle Yallits Project
  //The main page of the CMS
  //Allows the user to read the basic pokemon stats
   require("connect.php");
   session_start();

   $search = filter_input(INPUT_POST, "search", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $query = "SELECT * FROM pokemon WHERE Name LIKE '%" . $search . "%' OR Type1 LIKE '%" . $search . "%' OR Type2 LIKE '%" . $search . "%'";
  $statement = $db->prepare($query);
  $statement->execute();

  $query1 = "SELECT * FROM gymleader WHERE Name LIKE '%" . $search . "%' OR Type LIKE '%" . $search . "%'" ;
  $statement1 = $db->prepare($query1);
  $statement1->execute();

  $query2 = "SELECT * FROM trainer WHERE Name LIKE '%" . $search . "%' OR Type LIKE '%" . $search . "%'";
  $statement2 = $db->prepare($query2);
  $statement2->execute();
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
        <form action="search.php" method="post">
      <fieldset>
          <legend>Search</legend>
          <p>
            <label for="search">Search</label>
            <input name="search" id = "search" />
          </p>
          <p>
            <input type="submit" name="command" value="Create" />
          </p>
      </fieldset>
    </form>
  <h3><a href="signup.php">Sign Up</a></h3>
  <h3><a href="login.php">login</a></h3>
    <?php if (isset($_SESSION['user'])): ?>
    <h2>Welcome Back: <?= $_SESSION['user']?></h2>
    <h4><a href = "logout.php">Sign Out</a></h4>
        <?php if ($_SESSION['role'] == 2): ?>
            <a href="viewUsers.php">View Users</a>
        <?php endif ?> 
    <?php endif ?>
<div class="vertical-menu">
  <a href="index.php" class="active">Home </a>
  <a href="pokemon.php">View Pokemon</a>
  <a href="trainer.php">View Trainers</a>
  <a href="gymleader.php">View Gym Leaders </a>
  <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
  <a href="createPokemon.php">New Pokemon</a>
  <a href="createTrainer.php">New Trainer</a>
  <a href="createGymLeader.php">New GymLeader</a>
  <?php endif ?>
</div> 
<h3>See Pokemon and Trainers by Type</h3>
<p><a href="category.php?type=Fire">Fire</a> , <a href="category.php?type=Fighting">Fighting</a>, <a href="category.php?type=Ghost">Ghost</a>, <a href="category.php?type=Flying">Flying</a></p>
<?php if (isset($_SESSION['user'])): ?>
  <h3>Sort the Data</h3>
  <p><a href="sort.php?sort=Name">Name</a> , <a href="sort.php?sort=ID">ID</a> , <a href="sort.php?sort=Type">Type</a>, <a href="sort.php?sort=ID DESC">Recently Added</a></p>
<?php endif?>
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
          <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
          <th>Edit</th>
          <?php endif ?>
          <th>Details</th>
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
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
        <td><a href="<?="edit.php?id={$row['ID']}"?>">edit</a></td>
        <?php endif ?>
        <td><a href="<?="detail.php?id={$row['ID']}"?>">Details</a></td>
       </tr>
  </div>
  <?php endwhile ?>
</table>
  <h2>List of Gym Leaders</h2>
  <table>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Number of Pokemon</th>
        <th>Max Level</th>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
        <th>Edit</th>
        <?php endif ?>
        <th>Details</th>
      </tr>
    <?php while($rows = $statement1->fetch()): ?>
      <tr>
        <td><?= $rows['Name'] ?></td>
        <td><?= $rows['Type'] ?></td>
        <td><?= $rows['NumOfPokemon'] ?></td>
        <td><?= $rows['MaxLevel'] ?></td>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
        <td><a href="<?="editGymLeader.php?id={$rows['ID']}"?>">edit</a></td>
        <?php endif ?>
        <td><a href="<?="detailGymLeader.php?id={$rows['ID']}"?>">Details</a></td>

      </tr>
    <?php endwhile?>
  </table>
    
    <h2>List of Trainers</h2>
    <table>
      <tr>
        <th>Name</th>
        <th>Type</th>
        <th>Location</th>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
        <th>Edit</th>
        <?php endif ?>
        <th>Details</th>
      </tr>
    <?php while($rowed = $statement2->fetch()): ?>

      <tr>
        <td><?= $rowed['Name'] ?></td>
        <td><?= $rowed['Type'] ?></td>
        <td><?= $rowed['Location'] ?></td>
        <?php if (isset($_SESSION['user']) && $_SESSION['role'] == 2): ?>
        <td><a href="<?="editTrainer.php?id={$rowed['ID']}"?>">edit</a></td>
        <?php endif ?>
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
