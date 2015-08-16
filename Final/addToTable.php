<?php
	/**********************************************************************
	*					 Session set up
	**********************************************************************/

	/* error check */
	 error_reporting(E_ALL);
	 ini_set('display_errors', 1);

	 /*start session */ 
	ini_set('session.save_path', '/nfs/stak/students/m/masseyta/session');
	session_start();

	/************************************************************************
	* 					Database setup 
	************************************************************************/

	/* include sensitive information */
	include "info.php";

	$mysqli = new mysqli("oniddb.cws.oregonstate.edu", "masseyta-db", $dbpass, "masseyta-db");
	if($mysqli->connect_errno){
		echo "ERROR : Connection failed: (".$mysqli->connect_errno.")".$mysqli->connect_error;
	}

	/***********************************************************************
	*				Add to the table 
	* Full add for all tables but Breed
	* Breed is complicated enough to get its own section
	***********************************************************************/

	$variable = $_POST['variable'];
	$table = $_POST['table'];
	$purpose = "purpose";
/* Adding to Egg Table */
	if($table == "egg"){

		$quantity = $_POST['quantity'];

		/* prepare the statement*/
		if (!($stmt = $mysqli->prepare("INSERT INTO eggTable (eggType, quantity) VALUES (?, ?)"))){
			echo "Prepare failed : (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* bind the variables */
	 	if(!$stmt->bind_param('si', $variable, $quantity)){
	 		echo "Binding failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
	 	}

		/* execute */
		if(!$stmt->execute()){
			echo "Execute failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* updated */
		echo 1;
		$stmt->close();
		$mysqli->close();
	}


/* Adding to Purpose Table */
	if($table == "purpose"){

		/* prepare the statement*/
		if (!($stmt = $mysqli->prepare("INSERT INTO purposeTable (purpose) VALUES (?)"))){
			echo "Prepare failed : (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* bind the variables */
	 	if(!$stmt->bind_param('s', $variable)){
	 		echo "Binding failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
	 	}

		/* execute */
		if(!$stmt->execute()){
			echo "Execute failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* updated */
		echo 1;
		$stmt->close();
		$mysqli->close();
	}

/* Adding Temper Table */
	if($table == "temper"){

		/* prepare the statement*/
		if (!($stmt = $mysqli->prepare("INSERT INTO temperTable (trait) VALUES (?)"))){
			echo "Prepare failed : (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* bind the variables */
	 	if(!$stmt->bind_param('s', $variable)){
	 		echo "Binding failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
	 	}

		/* execute */
		if(!$stmt->execute()){
			echo "Execute failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* updated */
		echo 1;
		$stmt->close();
		$mysqli->close();
	}


/* Adding Needs Table */
	if($table == "needs"){

		/* prepare the statement*/
		if (!($stmt = $mysqli->prepare("INSERT INTO needsTable (need) VALUES (?)"))){
			echo "Prepare failed : (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* bind the variables */
	 	if(!$stmt->bind_param('s', $variable)){
	 		echo "Binding failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
	 	}

		/* execute */
		if(!$stmt->execute()){
			echo "Execute failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* updated */
		echo 1;
		$stmt->close();
		$mysqli->close();
	}

/* Add to Your Flock */
	if($table == "flock"){

		/* prepare the statement*/
		if (!($stmt = $mysqli->prepare("INSERT INTO flock (id) VALUES (
			(SELECT bID FROM breedsTable WHERE name= ?))"))) {
			echo "Prepare failed : (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* bind the variables */
	 	if(!$stmt->bind_param('s', $variable)){
	 		echo "Binding failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
	 	}

		/* execute */
		if(!$stmt->execute()){
			echo "Execute failed. (".$mysqli->connect_errno.")".$mysqli->connect_error;
		}

		/* updated */
		echo 1;
		$stmt->close();
		$mysqli->close();
	}
?>