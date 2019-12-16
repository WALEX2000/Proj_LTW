<?php
    include_once('../database/connection.php');
    include_once('../database/stories_queries.php');
    include_once('../includes/session.php');
    include_once('../templates/tpl_common.php');


    if (!isset($_SESSION['username']))
      die(header('Location: ../pages/login.php'));

    $name = dust_off($_POST['title']);
    $country =  dust_off($_POST['country']);
    $city=  dust_off($_POST['city']);
    $address=  dust_off($_POST['address']);
    $details=  dust_off($_POST['details']);
    $price_night = dust_off($_POST['price_night']);
    $capacity = dust_off($_POST['capacity']);

    if (!preg_match("/^([0-9]*[.])?[0-9]+$/", $price_night)) {
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Price can only contain numbers and a dot!');
      die(header('Location: ../pages/add_story.php'));
    }

    //Main image
    if (empty($_FILES["main_image"]["tmp_name"]) == true) { 
      $fileName = NULL;
    } else {
      $file = $_FILES['main_image'];
      //print_r ($file);
      $fileName = $file['name'];
      $fileTmpName = $file['tmp_name'];
      $fileSize = $file['size'];
      $fileError = $file['error'];
      $fileType = $file['type'];
    
      $fileExt = explode('.', $fileName);
      $fileActualExt = strtolower(end($fileExt));
     // print_r($fileActualExt);
    
      $allowed = array('jpg', 'jpeg', 'png');
    
      if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
          if ($fileSize < 1000000) {
            $fileNameNew = uniqid('', true) . "." . $fileActualExt;
            $fileDestination = '../../images/' . $fileNameNew;
    
            if (!move_uploaded_file($fileTmpName, $fileDestination)) {
              $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
              header('Location: ../pages/add_story.php');
            }
          } else {
            $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Your file is too big!');
            header('Location: ../pages/add_story.php');
          }
        } else {
          $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
          header('Location: ../pages/add_story.php');
        }
      } else {
        $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You cannot upload files of this type!');
        header('Location: ../pages/add_story.php');
      }
    }

    
    
    try {
      if ($fileName !== NULL){
        insert_image($fileName, $fileNameNew, NULL);
        $image_id = get_image_id($fileNameNew);
      }else{
        $image_id = NULL;
      }
      
      $story_info = array('name' => $name, 'country' =>$country, 'city' =>$city, 'address' =>$address,'main_image' =>$image_id, 'details' =>$details, 'price_night' =>$price_night, 'capacity' =>$capacity);
      $username = $_SESSION['username'];
      insert_story($story_info, $username);
      $story_id = get_story_id();
      
      // OTHER IMAGES
      if(empty($_FILES['other_images']['name']) == false){
   
        // Count total files
        $countfiles = count($_FILES['other_images']['name']);
       
        // Looping all files
        for($i=0;$i<$countfiles;$i++){
          $filename = $_FILES['other_images']['tmp_name'][$i];
          //print_r($filename);
          
          // Upload file
          $file = $_FILES['other_images'];
          //print_r ($file);
          $fileName = $file['name'][$i];
          $fileTmpName = $file['tmp_name'][$i];
          $fileSize = $file['size'][$i];
          $fileError = $file['error'][$i];
          $fileType = $file['type'][$i];
        
          $fileExt = explode('.', $fileName);
          $fileActualExt = strtolower(end($fileExt));
          print_r($fileActualExt);
        
          $allowed = array('jpg', 'jpeg', 'png');
        
          if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
              if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                $fileDestination = '../../images/' . $fileNameNew;
        
                if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                  $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
                  header('Location: ../pages/add_story.php');
                }
              } else {
                $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Your file is too big!');
                header('Location: ../pages/add_story.php');
              }
            } else {
              $_SESSION['messages'][] = array('type' => 'error', 'content' => 'There was an error uploading your file!');
              header('Location: ../pages/add_story.php');
            }
          } else {
            $_SESSION['messages'][] = array('type' => 'error', 'content' => 'You cannot upload files of this type!');
            header('Location: ../pages/add_story.php');
          }
  
          //Add image to database
          insert_image($fileName, $fileNameNew, $story_id);
        }
       }

      header("Location: ../pages/story.php?story_id=$story_id");
    } catch (PDOException $e) {
      die($e->getMessage());
      $_SESSION['messages'][] = array('type' => 'error', 'content' => 'Failed to add story!');
      $go_to = "Refresh:0;url=../pages/" . $_SESSION['last_page'];
  
      header($go_to);
    }
