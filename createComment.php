<?php
    //Kyle Yallits Create Page
    //Requires authentication, allows the user to create a new page
    //Makes sure the data is proper before posting it
  
    session_start();
    require('connect.php');


    if($_POST)
    {
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $comment = filter_input(INPUT_POST,'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $pokemon = filter_input(INPUT_POST, 'pokemon', FILTER_VALIDATE_INT);
        $author = $_SESSION['user'];

        $query = "INSERT INTO comments (comment, author, pokemonID) VALUES (:comment,:author, :pokemonID)";
        $statement = $db->prepare($query);
        $statement->bindValue(':comment',$comment);
        $statement->bindValue(':author',$author);
        $statement->bindValue(':pokemonID',$pokemon);
        $statement->execute();
        header("Location: index.php");
    } 
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>New Pokemon</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1><a href="index.php">Pokemon CMS - New Gym Leader</a></h1>
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

<div id="all_blogs">
  <form action="createComment.php" method="post">
    <fieldset>
      <legend>New Comment</legend>
      <p>
        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" ></textarea>
      </p>
      <p>
        <input type="hidden" name="pokemon" value="<?= $_GET['pokemon'] ?>" />
        <input type="submit" name="command" value="Create" />
      </p>
      <?php if($_POST): ?>
      <p style="color:red">  
           Your validation failed, please try again.
      </p>
      <?php endif ?>
    </fieldset>
  </form>
</div>
        <div id="footer">
            Copywrong 2021 - No Rights Reserved
        </div> <!-- END div id="footer" -->
    </div> <!-- END div id="wrapper" -->
</body>
</html>
