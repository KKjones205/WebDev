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
  <a href="createPokemon.php">New Pokemon</a>
  <a href="createTrainer.php">New Trainer</a>
  <a href="createGymLeader.php">New GymLeader</a>
</div> 

<h1>You have need to be an admin to use that function</h1>
<p>Please contact PokemonMan@gmail.com if you have any questions</p>
<h2><a href="index.php">Return Home </a></h2>

<div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>