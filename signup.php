<?php
 require 'connect.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <meta charset="utf-8">
    <title>New User</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
 </head>
 <body>

 <div class="vertical-menu">
  <a href="index.php" class="active">Home </a>
  <a href="pokemon.php">View Pokemon</a>
  <a href="trainer.php">View Trainers</a>
  <a href="gymleader.php">View Gym Leaders </a>
  <a href="createPokemon.php">New Pokemon</a>
  <a href="createTrainer.php">New Trainer</a>
  <a href="createGymLeader.php">New GymLeader</a>
</div> 

<form action="post_processUser.php" method="POST">
    <fieldset>
        <legend>Create User</legend>
        <p>
            <label for="username">Username</label>
            <input name="username" id="username"/>
        </p>
        <p>
            <label for="password">Password</label>
            <input name="password" id="password"/>
        </p>
        <p>
            <label for="password1">Please Confirm Password</label>
            <input name="password1" id="password1"/>
        </p>
        <p>
            <label for="email">Email</label>
            <input name="email" id="email"/>
        </p>
        <p>
            <input type="submit" name="submit" value="Create User"/>
        </p>
    </fieldset>
</form>
<div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
 </body>
 </html>
