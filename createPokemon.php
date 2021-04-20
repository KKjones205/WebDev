<?php
    //Kyle Yallits Create Page
    //Requires authentication, allows the user to create a new page
    //Makes sure the data is proper before posting it

    session_start();
    require('connect.php');
    date_default_timezone_set("America/Chicago");

    if(isset($_SESSION['user']))
    {
      if($_SESSION['role'] == 1)
      {
        header("Location: error.php");
      }
    }else{
      header("Location: error.php");
    }

    require 'D:\Phonebackup\htdocs\project\php-image-resize-master\lib\ImageResize.php';
    require 'D:\Phonebackup\htdocs\project\php-image-resize-master\lib\ImageResizeException.php';
    use \Gumlet\ImageResize;

    $imageName = "";

  function file_upload_path($original_filename, $upload_subfolder_name = 'images') {
    $current_folder = dirname(__FILE__);
    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
    return join(DIRECTORY_SEPARATOR, $path_segments);
  }


  function file_is_valid_type($temporary_path, $new_path) {
    $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png', 'image/gif', 'image/jpeg', 'image/png'];
    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'GIF', 'JPG', 'JPEG', 'PNG'];
    
    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type        = mime_content_type($temporary_path);
    
    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
    
    return $file_extension_is_valid && $mime_type_is_valid;
  }

  function upload(){ 
    if (isset($_FILES['image']) && ($_FILES['image']['error'] === 0)) {
        $image_filename       = $_FILES['image']['name'];
        $temporary_image_path = $_FILES['image']['tmp_name'];
        $new_image_path       = file_upload_path($image_filename);

        if(file_is_valid_type($temporary_image_path, $new_image_path)){
            move_uploaded_file($temporary_image_path, $new_image_path);
            $ext = pathinfo($image_filename, PATHINFO_EXTENSION);
            $image = new ImageResize($new_image_path);
            $image->resizeToBestFit(250,200);
             $image->save("images\\" . $_FILES['image']['name']);
        }
      }
    }

    if($_POST && !empty($_POST['type1']) && !empty($_POST['name'])&& !empty($_POST['hp']) && !empty($_POST['attack']) && !empty($_POST['Defense']) && !empty($_POST['SpAttack']) && !empty($_POST['SpDefense']))
    {

        if (isset($_FILES['image']) && ($_FILES['image']['error'] === 0)) { 
          $image_filename       = $_FILES['image']['name'];
          $temporary_image_path = $_FILES['image']['tmp_name'];
          $new_image_path       = file_upload_path($image_filename);
    
          if(file_is_valid_type($temporary_image_path, $new_image_path)){
              move_uploaded_file($temporary_image_path, $new_image_path);
              $ext = pathinfo($image_filename, PATHINFO_EXTENSION);
              $image = new ImageResize($new_image_path);
              $image->resizeToBestFit(250,200);
              $image->save("images\\" . $_FILES['image']['name']);
              $imageName = filter_var($_FILES['image']['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
          }
        }

        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type1 = filter_input(INPUT_POST, 'type1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $type2 = filter_input(INPUT_POST, 'type2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $hp = filter_input(INPUT_POST, 'HP', FILTER_VALIDATE_INT);
        $attack = filter_input(INPUT_POST, 'attack', FILTER_VALIDATE_INT);
        $defense = filter_input(INPUT_POST, 'Defense', FILTER_VALIDATE_INT);
        $spattack = filter_input(INPUT_POST, 'SpAttack', FILTER_VALIDATE_INT);
        $spdefense = filter_input(INPUT_POST, 'SpDefense', FILTER_VALIDATE_INT);

        $query = "INSERT INTO pokemon (Name,Type1,Type2,HP,Attack,Defense,SpAttack,SpDefense,Image) VALUES (:Name,:Type1,:Type2,:HP,:Attack,:Defense,:SpAttack,:SpDefense,:Image)";
        $statement = $db->prepare($query);
        $statement->bindValue(':Name',$name);
        $statement->bindValue(':Type1',$type1);
        $statement->bindValue(':Type2',$type2);
        $statement->bindValue(':HP',$hp);
        $statement->bindValue(':Attack',$attack);
        $statement->bindValue(':Defense',$defense);
        $statement->bindValue(':SpAttack',$spattack);
        $statement->bindValue(':SpDefense',$spdefense);
        $statement->bindValue(':Image', $imageName);
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
            <h1><a href="index.php">Pokemon CMS - New Pokemon</a></h1>
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
  <form action="createPokemon.php" method="post" enctype="multipart/form-data">
    <fieldset>
      <legend>New Pokemon</legend>
      <p>
        <label for="name">Name</label>
        <input name="name" id="name" />
      </p>
      <p>
        <label for="type1">Main Type</label>
        <input name="type1" id="type1" />
      </p>
      <p>
        <label for="type2">Secondary Type</label>
        <input name="type2" id="type2" />
      </p>
      <p>
        <label for="HP">HP</label>
        <input type="number" name="HP" id="HP">
      </p>
      <p>
        <label for="attack">Attack</label>
        <input type="number" name="attack" id="attack">
      </p>
      <p>
        <label for="Defense">Defense</label>
        <input type="number" name="Defense" id="Defense">
      </p>
      <p>
        <label for="SpAttack">SpAttack</label>
        <input type="number" name="SpAttack" id="SpAttack">
      </p>
      <p>
        <label for="SpDefense">SpDefense</label>
        <input type="number" name="SpDefense" id="SpDefense">
      </p>
            <p>
        <label for="image">Image:</label>
        <input type="file" name="image" id="image"></br>
      </p>
      <p>
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
