<?php
    require 'connect.php';
    session_start();

    if($_POST && $_POST['login'])
    {
        $user = filter_input(INPUT_POST,'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $query = "SELECT * FROM users WHERE Username = '$user'";
        $statement = $db->prepare($query);
        $statement->execute();

        if($row = $statement->fetch())
        {
            if($password == $row['Password'])
            {
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $row['Role'];
                header("location: index.php");
            }
            else
            {
                $error = "Your password is wrong please try again";
            }
        }else{
            $error = "Your username is wrong please try again";
        }
    }
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <title>New User</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
 </head>
 <body>
    <?php if(isset($error)): ?>
    <h1><?= $error ?> </h1>
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

    <h2>Please Login</h2>
    <form action="login.php" method="POST">
    <legend>Enter your username and password</legend>
        <p>
            <label for="username">Username</label>
            <input name="username" id="username"/>
        </p>
        <p>
            <label for="password">Password</label>
            <input name="password" id="password"/>
        </p>
        <input type="submit" name="login" value="login">
    </form>
    <h4>Sign up for an account here <a href="signup.php">Click to Sign Up</a></h4>
    <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
 </body>
 </html>
