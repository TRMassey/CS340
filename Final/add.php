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
  <script src="functions.js"></script>
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
    <h2>Add to Each Table</h2><hr><hr>
  </p>
</div>

  <!-- Img to Left-->
  <div class="leftDec">
    <img src="chicks-573377_1280.jpg">
  
    <!-- contents -->
    <div class="rightDec">

      <!-- header background -->
      <div class="banner">
        <h2>Each Table has a Submit Button. Add to Tables Individually.</h2>
      </div>

      <!-- Text of page -->
      <div class="rightText">

        <!-- form start -->
        <div class="addForms">
          <form Id="breedInfo">
            
          <!-- Breed Table -->
          <h4>BREED</h4>
          <h4>(Input a new Breed Name, select from dropdowns that contain all information from their respecctive tables to complete breed input)</h4>
          <form>
          <p>
            <label>Breed Name (Required):</label>
            <input type="text" id="name">
          </p>
        </form>

          <!-- Dropdown for current egg types -->
          <p>
            <label>Egg Type:</label>
            <?php
            $result = $mysqli->query('SELECT DISTINCT eggType, quantity FROM eggTable');
            echo '<select name="eggType" id="egg">';
              while($row = $result->fetch_object()){
                $indata = $row->eId;
                $q = $row->quantity;
                $t = $row->eggType;
                echo '<option value="'.$t." ".$q.'">'.$t. " weekly amount: ".$q.'</option>';
              }
            echo '</select>';
            ?>
          </p>

         <!-- dropdown for current purpose types -->
          <p>
            <label>Purpose:</label>
            <?php
            $result = $mysqli->query('SELECT DISTINCT purpose FROM purposeTable');
            echo '<select name="purposeType" id="purpose">';
                while($row = $result->fetch_object()){
                   $indata = $row->pID;
                   $p = $row->purpose;
                   echo '<option value="'.$p.'">'.$p.'</option>';
                }
            echo '</select>';
            ?>
          </p> 

          <!-- Dropdown for temperment -->
          <p>
            <label>Temperament Trait:</label>
            <?php
            $result = $mysqli->query('SELECT DISTINCT trait FROM temperTable');
            echo '<select name="tempermentType" id="temperment">';
                while($row = $result->fetch_object()){
                   $indata = $row->tID;
                   $t = $row->trait;
                   echo '<option value="'.$t.'">'.$t.'</option>';
                }
            echo '</select>';
            ?>
          </p>
        

          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button type ="button" value="breed" onclick="addBreed()" align="center">Add to Breed Table</button>
        </form>


        <!-- Egg table -->
        <form id="eggInfo">
          <h4>EGG TYPE</h4>
          <h4>(Enter information for a new eggType for the egg table)</h4>
          <p>
            <label>Egg color (Required):</label>
            <input type="text" name="color" id="type">
          </p>
          <p>
             <label>Number of eggs per week(required):</label>
            <input type="text" name="numEggs" id="quantity">
          </p>
          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button type ="button" value="egg" onclick="addEgg()" align="center">Add to Egg Table</button>
        </form>


        <!-- Purpose table -->
        <form id="purposeInfo">
          <h4>PURPOSE</h4>
          <h4>(Enter a new purpose for the purpose table)</h4>
          <p>
            <label>Purpose (required):</label>
            <input type="text" name="purpose" id="purposeType">
          </p>
          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button type ="button" value="purpose" onclick="addPurpose()" align="center">Add to Purpose</button>
        </form>

          <!-- Temperment table -->
        <form id="temperInfo">
          <h4>TEMPERAMENT TRAIT</h4>
          <h4>(Enter a new temperament for the temperament table)</h4>
          <p>
            <label>Temperament Trait (required):</label>
            <input type="text" name="temper" id="temperType">
          </p>
          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button type ="button" value="temper" onclick="addTemper()" align="center">Add to Temper Table</button>
        </form>

        <!-- Needs table-->
        <form id="needsInfo">
          <h4>SPECIAL CARE NEED</h4>
          <h4>(Enter a new special care need for the needs table)</h4>
          <p>
            <label>Care Need (required):</label>
            <input type="text" name="care" id="needType">
          </p>
          <!-- Send information to loginCheck function for error handling and ajax call if wrong -->
          <button type ="button" onclick="addNeed()" align="center">Add to Care Table</button>
        </form>
      </div>
    </div>

<div id="output"></div>
  <!-- Closing decoration -->
  <p>
    <hr><hr>
    </br>
  </p>
</div>
</div>
<div id="output"></div>
</body>
</html>
<?php
    $mysqli->close();
?>