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
  // delete on reload as required
  if(isset($_GET['delete'])){
    $delID = $_GET['delete'];
    $mysqli->query("DELETE FROM flock WHERE flock.fID ='$delID'");
  } 
  ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title> Poultry Planner Login </title>
  <link rel="stylesheet" href="stylesheet.css" />
  <link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
  <script src="functionFlock.js"></script>
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
    <h2>View or Edit your Flock</h2><hr><hr>
  </p>
</div>

  <!-- Img to Left-->
  <div class="leftDec">
    <img src="eggs-791463_1280.jpg">
  
  <!-- contents -->
  <div class="rightDec">

    <!-- background for header -->
    <div class="banner">
      <h2>Add from the dropwdown, edit or view flock in tables below</h2>    
    </div>
    <!-- form start -->
      <div class="addForms">
      <form>
        <?php
          echo '<p><h3>Select Chicken to Add to Flock by Breed:</h3></p>';

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
        ?>

        <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
        <button type ="button" value="flock" onclick="addFlock()" align="center">Add to Flock</button>
      </form>
    </div>

  <!-- Closing decoration -->
  <p>
    <hr><hr>
    </br>
  </p>
  <div class = "mainTable">
  <?php 

    /* table for each of the db contents */
    echo "<p><h1>Results</h1></p>";
    echo "<p>";
    echo "</p>";
    echo "<table border ='1' align='center' style='width:90%'>";
      echo "<tr>";
        echo "<th>Remove from Flock</th>";
        echo "<th>Breed</th>";
        echo "<th>Egg Type</th>";
        echo "<th>Egg Quantity</th>";
        echo "<th>Purpose</th>";
        echo "<th>Temperament</th>";
        echo "<th>Care Needs</th>";
      echo "</tr>";

    /* if the button has been clicked to search, we will populate results */

      /* fill in the table from the db, depending on the table they're searching from */
          $result = mysqli_query($mysqli, 'SELECT breedsTable.bID, flock.id, flock.fID, breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          INNER JOIN flock on breedsTable.bID = flock.id');

      // all basic information
      while($row = mysqli_fetch_array($result)){
        echo '<tr align="center">';

        // put in one delete button per bird
        echo "<form action = 'flock.php' method = 'GET'>";
          echo "<td>";
              $statID = $row['fID'];
              echo '<input type= hidden name= delete value="'.$statID.'"><input type= submit value= Delete Breed name=del>';   # Should, in theory, send ID to function for update
            echo "</td>";
          echo "</form>"; // end delete form 

        // put in the information all birds will have
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['eggType'].'</td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '<td>'.$row['purpose'].'</td>';
        echo '<td>'.$row['trait'].'</td>';

        // get the  many to many
        $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          WHERE breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td><td>';
        }
        echo '</tr>';  
      }    

    echo "</table>";
    echo "<p>";
    echo "</br>";
    echo "</p>";

    /* Relevant Information Queries, non-user prompted info */
    echo "<p><h1>Relevant Flock Information</h1></p>";
     echo "<p>";
    echo "</p>";

    // relevant information -- aggregate queries : Number of Chickens
    echo "<table border ='1' align='center' style='width:90%'>";
      echo "<tr>";
        echo "<th>Total Number of Chickens</th>";
      echo "</tr>";

          $result = mysqli_query($mysqli,'SELECT flock.id, breedsTable.bID, COUNT(flock.fID)
          FROM breedsTable
          INNER JOIN eggTable ON breedsTable.egg = eggTable.eID
          INNER JOIN flock ON breedsTable.bID = flock.id');
          $row = mysqli_fetch_array($result);
          echo '<tr>';
          echo '<td>';
          if($row['id'] != NULL){
              $num = '"'.$row['COUNT(flock.fID)'].'"';
              echo $num;
              echo ' number of chickens</td>';
          }
          echo '</tr>';
       echo "</table>";

    // relevant information -- aggregate queries : Eggs
    echo "<table border ='1' align='center' style='width:90%'>";
      echo "<tr>";
        echo "<th>Total Eggs Per Week</th>";
      echo "</tr>";

          $result = mysqli_query($mysqli,'SELECT flock.id, breedsTable.bID, SUM(eggTable.quantity)
          FROM breedsTable
          INNER JOIN flock ON breedsTable.bID = flock.id
          INNER JOIN eggTable ON breedsTable.egg = eggTable.eID');
          $row = mysqli_fetch_array($result);
          echo '<tr>';
          echo '<td>';
          if($row['id'] != NULL){
                $sum = '"'.$row['SUM(eggTable.quantity)'].'"';
                echo $sum;
                echo ' eggs per week</td>';
          }
          echo '</tr>';

       echo "</table>";

    /* close it all */
    $mysqli->close();
  ?>
  </div>
</div>
</body>
</html>