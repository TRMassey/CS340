
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
  ?>
  
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title> Poultry Planner Login </title>
  <link rel="stylesheet" href="stylesheet.css" />
  <link href='http://fonts.googleapis.com/css?family=Bubblegum+Sans' rel='stylesheet' type='text/css'>
  <script src="functions.js"></script>
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
    <h2>Welcome to the Poultry Planner Database</h2><hr><hr>
  </p>
</div>

  <!-- Img to Left-->
  <div class="leftDec">
    <img src="rooster-21150_1280.jpg">
  
  <!-- contents -->
  <div class="rightDec">
    <div class="banner">
      <h2>Final Project Navigation</h2>
    </div>
    <div class="rightText">
      <p>
        The navigation bar at the top of the screen links to each required section for the final project.
      </p>
      <p>
        If you're searching for a specific requirement, they can be found as follows:
        <p>
        <ul>
          <li>Add Your Own Info : Add information to every table except flock</li>
            <ul>
              <li> Flock can be added to in "Edit my flock" sections"</li>
              <li> For criteria: Must be able to add to every table </li>
            </ul>
          </p>

          <p>
          <li>Basic Search : Seach for a piece of user entered information from every table except flock</li>
            <ul>
              <li> Will display all breed information for the breed that meets your search criteria</li>
              <li> Flock is used in aggregate select query under "Edit my flock"</li>
              <li> For criteria: Every table must be used in at least one select query</li>
            </ul>
          </p>

          <p>
          <li>Complex Search : search for a breed that <b>does not</b> have a specific criteria</li>
            <ul>
              <li>Select query features NOT IN</li>
            </ul>
          </p>

          <p>
          <li>Complex Search : search for the average amount of eggs laid per week from each chicken temperament or chicken purpose type</li>
            <ul>
              <li>Select query features aggregate function (average)</li>
            </ul>
          </p>

          <p>
          <li>View All : Displays contents of every breed entered</li>
          </p>

          <p>
          <li>Edit My Flock : User can design their own flock by selecting a chicken of a particular breed</li>
            <ul>
              <li>User can add to flock, delete from flock, and receives total egg and bird count information</li>
              <li>Select queries used include COUNT and SUM</li>
              <li>For criteria: Delete from a table (optional, due to complex queries)</li>
              <li>For Criteria: Must be able to add to every table</li>
              <li>For Criteria: Every table must be used in at least one select query</li>
            </ul>
          </p>

        </ul>
      </p>
      <p> At any time you can return to this screen by clicking the chicken in the upper left corner of the navigation bar. </p>
    </div>
  </div>
</div>
  <p>
    <hr><hr>
    </br>
  </p>

</body>
</html>