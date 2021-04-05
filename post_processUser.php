<?php

require 'connect.php';
session_start();

$username = filter_input(INPUT_POST,'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$email =    filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$password1  = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$usernameCheck = false;
$passwordCheck = false;

$query = "SELECT * FROM users";
$statement = $db->prepare($query);
$statement->execute();

    while($row = $statement->fetch())
    {
        if($row['Username'] == $username)
        {
            $usernameCheck = true;
        }
    }
    if($password == $password1)
    {
        $passwordCheck = true;
    }

    if($passwordCheck && !$usernameCheck && $_POST['submit'])
    {
        $insert = "INSERT INTO users (Username, Password, Email, Role) values (:username, :password, :email, :role)";
        $role = 1;
        $statement = $db->prepare($insert);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':role', $role);
        $statement->execute();

        header("Location: login.php");
        exit();
    }
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
  <h3><a href="signup.php">Sign Up</a></h3>
    <div class="vertical-menu">
        <a href="index.php" class="active">Home </a>
        <a href="pokemon.php">View Pokemon</a>
        <a href="trainer.php">View Trainers</a>
        <a href="gymleader.php">View Gym Leaders </a>
        <a href="createPokemon.php">New Pokemon</a>
        <a href="createTrainer.php">New Trainer</a>
        <a href="createGymLeader.php">New GymLeader</a>
    </div>

    <?php if($passwordCheck == false): ?>
        <h1>There was an error when attemping to create your user.</h1>
            <p>Please make sure the passwords match</p>
            <a href="signup.php">Retry</a> 
        </div>
    <?php endif ?>
    <?php if($usernameCheck == true): ?>
        <h1>There was an error when attemping to create your user.</h1>
            <p>Try another username</p>
            <a href="signup.php">Retry</a> 
        </div>
    <?php endif ?>
    </div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>

