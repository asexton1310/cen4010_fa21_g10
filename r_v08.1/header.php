<?php
  session_start();
?>





<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>RELAY</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
 
  <link rel="stylesheet" href="css/stylesheet.css">   

  <!-- search button icon -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
</head>
<body>


<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">RELAY</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          
          <li class="nav-item">
            <a class="nav-item nav-link" id="home" href="index.php">community</a>
          </li>
          
          <?php
            if (isset($_SESSION["userName"])){
              echo "<li class='nav-item'> <a class='nav-item nav-link' id='chat' href='feed.php'>feed</a> </li>";
              echo "<li class='nav-item'><a class='nav-item nav-link' id='post' href='post.php'>post</a></li>";
              echo "<li class='nav-item'> <a class='nav-item nav-link' id='chat' href='chat.php'>chat</a> </li>";
              echo "<li class='nav-item'> <a class='nav-item nav-link' id='profile' href='profile.php'>profile</a> </li>";
              echo "<li class='nav-item'> <a class='nav-item nav-link' id='profile' href='include/script_logout.php'>logout</a> </li>";
              echo '<form id="search" action="returned_search.php" method="post">';
              echo '<select name="results">
              <option value="user">User</option>
              <option value="post">Post</option>
              </select>';
              echo '<input type="text" placeholder="Search" name="search" type="search" required>';
              echo '<button type="submit" name="submit">Submit</button>';
              echo '</form>';
            }
          else{
            echo "<li class='nav-item'><a class='nav-item nav-link' id='logi' href='login.php'>login</a></li>";
            echo "<li class='nav-item'><a class='nav-item nav-link' id='register' href='register.php'>register</a></li>";
          }
          ?>

        </ul>
      </div>
    </div>
  </nav>
  <br>
        </body>