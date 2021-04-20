<?php
///Kyle Yallits Post Process Script
//After a user posts the edit/delete data it comes here
//This checks to see if the data that was edited is valid and updates the database
//If validation fails an error page tells redirecting them back to the main page comes up
require("connect.php");
require 'D:\Phonebackup\htdocs\project\php-image-resize-master\lib\ImageResize.php';
require 'D:\Phonebackup\htdocs\project\php-image-resize-master\lib\ImageResizeException.php';
use \Gumlet\ImageResize;

$queryUpdate = "UPDATE pokemon SET Name = :Name, Type1 = :Type1, Type2 = :Type2, HP = :HP, Attack = :Attack, Defense = :Defense, SpAttack = :SpAttack, SpDefense = :SpDefense, Image = :Image WHERE ID = :ID";
$queryDelete = "DELETE FROM pokemon WHERE id= :id";
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
           $image->resizeToBestFit(150,100);
           $image->save("images\\" . $_FILES['image']['name']);
       }
    }
  }

if(isset($_POST['delete']))
{
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
  $statement = $db->prepare($queryDelete);
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("Location: index.php");
  exit();
}

elseif(!empty($_POST['name']) && !empty($_POST['type1']) && !empty($_POST['HP']) && !empty($_POST['attack']) && !empty($_POST['Defense']) && !empty($_POST['SpAttack']) && !empty($_POST['SpDefense']) && isset($_POST['update']))
  {

    if(isset($_POST['image_delete']) && $_POST['image_delete'] == 'delete'){
      $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
      $imgdelete = "SELECT * FROM pokemon WHERE id = :id";
      $statement = $db->prepare($imgdelete);
      $statement->bindValue(':id', $id);
      $statement->execute();
      $row = $statement->fetch();
      unlink("images\\" .$row["Image"]);
      $imageName = '';
  }

  if (isset($_FILES['image']) && ($_FILES['image']['error'] === 0)) { 
      $image_filename       = $_FILES['image']['name'];
      $temporary_image_path = $_FILES['image']['tmp_name'];
      $new_image_path       = file_upload_path($image_filename);

      if(file_is_valid_type($temporary_image_path, $new_image_path)){
          move_uploaded_file($temporary_image_path, $new_image_path);
          $ext = pathinfo($image_filename, PATHINFO_EXTENSION);
          $image = new ImageResize($new_image_path);
          $image->resizeToBestFit(150,100);
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


    $statement = $db->prepare($queryUpdate);
    $statement->bindValue(':ID', $id);
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
    exit();
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pokemon CMS - Error </title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
        <a href="index.php"></a>
        </div>
        <h1>There was an error when attemping to post your Pokemon.</h1>
        <p>Please make sure each box except secondary type has some content</p>
        <a href="index.php">Go Back</a>
    <div id="footer">
        Copywrong 2021
    </div>
</div>
</body>
</html>