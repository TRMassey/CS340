
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
  // ini_set('display_errors', 1);

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
    <h2>Basic Search</h2><hr><hr>
  </p>
</div>

  <!-- Img to Left-->
  <div class="leftDec">
    <img src="chicks-349035_1280.jpg">
  
  <!-- contents -->
  <div class="rightDec">

    <!-- background for header -->
    <div class="banner">
      <h2>Search for Something from Each Table</h2>
    </div>

    <!-- text -->
    <div class="rightText">

    <!-- form start -->
      <div class="addForms">
        <?php 
        echo "<form action ='basic.php' method ='GET'>";

          echo '<p><h3>Select table from dropdown and input search criteria</h3></p>';
          echo '<p>';
            echo '<label>Search By:</label>';
              echo '<select name="criteria" id="criteria">';
              echo '<option value="breed" name="breed">Breed</option>';
              echo '<option value="egg" name="egg">Egg Type</option>';
              echo '<option value="quantity" name="quantity">Egg Quantity</option>';
              echo '<option value="purpose" name="purpose">Purpose</option>';
              echo '<option value="temperment" name="temperment">Temperament</option>';
              echo '<option value="needs" name="needs">Care Needs</option>';
            echo '</select>';

            echo '<p>';
              echo '<label>Search For:</label>';
              echo '<input type="text" name="searchInfo" id="searchInfo">';
            echo '</p>';
          echo '</p>';

          echo '<input type ="submit" name="submit" id ="submit" align="center" value="Search for Chickens. Bawk!">';
        echo '</form>';
        ?>
      </div>
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
    echo "<table border ='1' align='center' style='width:80%'>";
      echo "<tr>";
        echo "<th>Breed</th>";
        echo "<th>Egg Type</th>";
        echo "<th>Egg Quantity</th>";
        echo "<th>Purpose</th>";
        echo "<th>Temperament</th>";
        echo "<th>Care Needs</th>";
      echo "</tr>";

    /* if the button has been clicked to search, we will populate results */
    if(isset($_GET['submit'])){
      $table = $_GET['criteria'];
      $search = $_GET['searchInfo'];

      /* fill in the table from the db, depending on the table they're searching from */
      if($table == "breed"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          WHERE breedsTable.name = "'.$search.'"');

         // get information all will have
         while($row = mysqli_fetch_array($result)){
          echo '<tr>';
          echo '<td>'.$row['name'].'</td>';
          echo '<td>'.$row['eggType'].'</td>';
          echo '<td>'.$row['quantity'].'</td>';
          echo '<td>'.$row['purpose'].'</td>';
          echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
        $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          WHERE breedsTable.name = "'.$search.'"
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
       }  
      }

      if($table == "egg"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          WHERE eggTable.eggType ="'.$search.'"');

        // get information all will have
      while($row = mysqli_fetch_array($result)){
        echo '<tr>';
        echo '<td>'.$row['name'].'</td>';
        echo '<td>'.$row['eggType'].'</td>';
        echo '<td>'.$row['quantity'].'</td>';
        echo '<td>'.$row['purpose'].'</td>';
        echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
        $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          INNER JOIN eggTable on eggTable.eID = breedsTable.egg
          WHERE eggType ="'.$search.'"
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
     }  
    }


      if($table == "quantity"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          WHERE quantity ="'.$search.'"');
          
          // get information all will have
         while($row = mysqli_fetch_array($result)){
           echo '<tr>';
           echo '<td>'.$row['name'].'</td>';
           echo '<td>'.$row['eggType'].'</td>';
           echo '<td>'.$row['quantity'].'</td>';
           echo '<td>'.$row['purpose'].'</td>';
           echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
          $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          INNER JOIN eggTable on eggTable.eID = breedsTable.egg
          WHERE quantity ="'.$search.'"
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
     }  
    }


      if($table == "purpose"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          WHERE purposeTable.purpose ="'.$search.'"');

          // get information all will have
         while($row = mysqli_fetch_array($result)){
           echo '<tr>';
           echo '<td>'.$row['name'].'</td>';
           echo '<td>'.$row['eggType'].'</td>';
           echo '<td>'.$row['quantity'].'</td>';
           echo '<td>'.$row['purpose'].'</td>';
           echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
          $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          INNER JOIN purposeTable on purposeTable.pID = breedsTable.purpose
          WHERE purposeTable.purpose ="'.$search.'"
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
     }  
    }


      if($table == "temperment"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          WHERE trait ="'.$search.'"');

          // get information all will have
         while($row = mysqli_fetch_array($result)){
           echo '<tr>';
           echo '<td>'.$row['name'].'</td>';
           echo '<td>'.$row['eggType'].'</td>';
           echo '<td>'.$row['quantity'].'</td>';
           echo '<td>'.$row['purpose'].'</td>';
           echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
          $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          INNER JOIN temperTable on temperTable.tID = breedsTable.temper
          WHERE trait ="'.$search.'"    
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
     }  
    }

    
      if($table == "needs"){
        $result = mysqli_query($mysqli, 'SELECT breedsTable.name, eggTable.eggType, eggTable.quantity, purposeTable.purpose, temperTable.trait FROM breedsTable
          INNER JOIN eggTable on breedsTable.egg = eggTable.eID
          INNER JOIN purposeTable on breedsTable.purpose = purposeTable.pID
          INNER JOIN temperTable on breedsTable.temper = temperTable.tID
          INNER JOIN need_breed on breedsTable.bID = need_breed.breed
          INNER JOIN needsTable on needsTable.nID = need_breed.need
          WHERE needsTable.need ="'.$search.'"');

        // get information all will have
         while($row = mysqli_fetch_array($result)){
           echo '<tr>';
           echo '<td>'.$row['name'].'</td>';
           echo '<td>'.$row['eggType'].'</td>';
           echo '<td>'.$row['quantity'].'</td>';
           echo '<td>'.$row['purpose'].'</td>';
           echo '<td>'.$row['trait'].'</td>';

        // for the bird being displayed, gather many-to-many need info for just that bird
          $needResult = mysqli_query($mysqli, 'SELECT needsTable.need FROM needsTable
          INNER JOIN need_breed on needsTable.nID = need_breed.need
          INNER JOIN breedsTable on breedsTable.bID = need_breed.breed
          WHERE needsTable.need ="'.$search.'"
          AND breedsTable.name = "'.$row['name'].'"');

        // print just that birds many needs/no needs, then continue on to next bird/row
        while($Rrow = mysqli_fetch_array($needResult)){
          echo '<td>'.$Rrow['need'].'</td>';
          echo '<tr><td><td><td><td><td>';
        }
        echo '</tr>'; 
     }    
    }
  }
    echo "</table>";
    echo "<p>";
    echo "</br>";
    echo "</p>";
    /* close it all */
    $mysqli->close();
  ?>
  </div>
</div>
</body>
</html>