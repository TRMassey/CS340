<!-- ****************************************************************************************************************
  * Autor: Tara Massey
  * Project: Final Project
  * Course: Introduction to Databases
  *
  * ALL IMAGES USED : Distributed under the Creative Commons CC0 as public Domain
  * IMAGES found at : pixabay.com
  * Specific URLs : https://pixabay.com/en/chicks-animal-fluffy-poultry-573377/
  *                 https://pixabay.com/en/chicks-spring-chicken-plumage-349035/
  *                 https://pixabay.com/en/chicken-grass-free-range-hen-763960/
  *                 https://pixabay.com/en/hen-chicken-fowl-poultry-farm-311285/
  *                 https://pixabay.com/en/hen-farm-animals-poultry-chicken-333164/
  *                 https://pixabay.com/en/rooster-cock-chicken-animal-farm-21150/
  *                 https://pixabay.com/en/cock-hen-poultry-meadow-hahn-93278/
  *************************************************************************************************************** -->
<?php
  /**********************************************************************
  *          Session set up
  **********************************************************************/

  /* error check */
  // error_reporting(E_ALL);
   //ini_set('display_errors', 1);

   /*start session */ 
  ini_set('session.save_path', '/nfs/stak/students/m/masseyta/session');
  session_start();

  /************************************************************************
  *           Database setup 
  ************************************************************************/

  /* include sensitive information */
  include "info.php";

  $mysqli = new mysqli("oniddb.cws.oregonstate.edu", "masseyta-db", $dbpass, "masseyta-db");
  if($mysqli->connect_errno){
    echo "ERROR : Connection failed: (".$mysqli->connect_errno.")".$mysqli->connect_error;
  }
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title> Poultry Planner Login </title>
  <link rel="stylesheet" href="stylesheet.css" />
  <link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
  <script src="functions.js">
</script>
</head>
<body>

<!-- Navbar -->
  <div class="navbar">
    <a href="main.php"><img src="hen-311284_640.png" width="3%"></a>
    <h3>Poultry Planner</h3>
    <div class="navbar-right">
      <ul>
        <li><a href="flock.php">Edit My Flock</a></li>
        <li><a href="viewAll.php">View All Breeds</a></li>
        <li><a href="basic.php">Basic Search</a></li>
        <li><a href="complex.php">Complex Search</a></li>
        <li><a href="add.php">Add Your Own Info</a></li>
      </ul>
    </div>
  </div>

<!-- Customized Greeting -->
<div class="welcome">
  <p>
    <h2>Optional Care Needs</h2><hr><hr>
  </p>
</div>

  <!-- Img to Left-->
  <div class="leftDec">
    <img src="chicken-516146_1280.jpg">
  
  <!-- contents -->
  <div class="rightDec">

    <!-- background for header -->
    <div class="banner">
      <h2>Your Breed Can Have Many Care Needs (Optional Section)</h2>
    </div>

    <!-- text -->
    <div class="rightText">

    <!-- form start -->
      <div class="addForms">
        <?php 
        echo "<form action ='addAdditional.php' method ='GET'>";

          echo '<p><h3>Select Your Breed From the dropdown</h3></p>';

          echo '<p>';
            echo '<label>Breed:</label>';
               $result = $mysqli->query('SELECT DISTINCT name FROM breedsTable');
                 echo '<select name="name" id="name">';
                  while($row = $result->fetch_object()){
                     $indata = $row->bID;
                     $b = $row->name;
                     echo '<option value="'.$b.'">'.$b.'</option>';
                }
              echo '</select>';
            echo '</p>';

          echo '<p>';
            echo '<p><h3>Then add a special care need for your breed</h3></p>';
            echo '<label>Add a special care need:</label>';
            $result = $mysqli->query('SELECT DISTINCT need FROM needsTable');
            echo '<select name="need" id="need">';
                while($row = $result->fetch_object()){
                   $indata = $row->nID;
                   $n = $row->need;
                   echo '<option value="'.$n.'">'.$n.'</option>';
                }
            echo '</select>';
          echo '</p>';
          echo '<input type ="submit" name="submitNeed" id ="submitNeed" align="center value="Make Me More Interesting">';
        echo '</form>';

        ?>
      </div>
        <form action="add.php">
          <p><h3>If you are done are done adding needs, or do not wish to, click to return home</h3></p>
          <input type="submit" value="All DONE!" align="center">
        </div>
    </div>

  <!-- Closing decoration -->
  <p>
    </br>
  </p>
<?php

    /* if the button has been clicked, add */
    if(isset($_GET['submitNeed'])){
      $needs = $_GET['need'];
      $name= $_GET['name'];

      /* prepare the statement*/

    // Prepare the insert statment -- Many to Many
    if (!($stmt = $mysqli->prepare("INSERT INTO need_breed(breed, need)
      VALUES ((SELECT bID FROM breedsTable WHERE name=?),
      (SELECT nID FROM needsTable WHERE need=?))"))) {
       echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // Add values to search for and insert
    if (!$stmt->bind_param("ss", $name, $needs)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      die();
    }
    // Execute
    if (!$stmt->execute()) {
      echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      die();
    }

    /* updated */
//    echo 1;
    $stmt->close();
    $mysqli->close();
  }
    ?>
  </div>
</div>
</body>
</html>