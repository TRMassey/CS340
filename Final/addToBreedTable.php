
	<?php
	/**********************************************************************
	*					 Session set up
	**********************************************************************/

	 /* error check */
//	error_reporting(E_ALL);
//	ini_set('display_errors', 1);

	/* start session */
	// ini_set('session.save_path', '/nfs/stak/students/m/masseyta/session');
 //    session_start();

	/************************************************************************
	* 					Database setup 
	************************************************************************/

	/* include sensitive information */
	include "info.php";

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "masseyta-db", $dbpass, "masseyta-db");
	if($mysqli->connect_errno){
		echo "ERROR : Connection failed: (".$mysqli->connect_errno.")".$mysqli->connect_error;
	}



	/********************************************************************************
	*					Add new breed
	********************************************************************************/
	$name = $_POST['name'];
	$eggType = $_POST['egg'];
	$purpose = $_POST['purpose'];
	$temper = $_POST['temper'];

	if($eggType == "all"){
		$eggType = "NONE 0";
	}

	/* egg has two pieces to match, get them */
	// last
	$lastPortion = strrpos($eggType, ' ')+1;
	$eggQuantity = substr($eggType, $lastPortion);
	
	// first
	$lastSpace = strrpos($eggType, ' ');
	$eggType = substr($eggType, 0, $lastSpace);
	$eggInt = intVal($eggQuantity);



    // Prepare the insert statment
    if (!($stmt = $mysqli->prepare("INSERT INTO breedsTable(name, egg, purpose, temper)
      VALUES (?, 
        (SELECT eID FROM eggTable WHERE eggType=? AND quantity=?),
        (SELECT pID FROM purposeTable WHERE purpose=?),
        (SELECT tID FROM temperTable WHERE trait=?))"))) {
     	 echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    // Add values to search for and insert
    if (!$stmt->bind_param("ssiss", $name, $eggType, $eggInt, $purpose, $temper)) {
      echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
      die();
    }
    // Execute
    if (!$stmt->execute()) {
      if( $stmt->errno == 1062){
      	echo "Names must be unique! This breed already exists. Please enter a new breed name.";
      }
      else{
      	echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
      }
      die();
    }

/* updated */
echo 1;
$stmt->close();
$mysqli->close();
?>

