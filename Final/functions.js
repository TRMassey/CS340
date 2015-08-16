

  /*******************************************************************
   *           Adding Egg Info
  ********************************************************************/
  function addEgg(){

  /* get values from form */
  var variable = document.getElementById("type").value;
  var quantity = document.getElementById("quantity").value;
  var whichTable = "egg";

  /* check for blanks in the form */
  if(variable == null || variable == ""){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
    document.getElementById("eggInfo").reset();
    return;
  }

  /* check for blanks in the form */
  if(quantity == null || quantity == "" || quantity == 0){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
    document.getElementById("eggInfo").reset();
    return;
  }

  /* check that the egg amount is numeric */
  if(isNaN(quantity)){
    alert("Your input should be numeric");
    document.getElementById("output").innerHTML ="Quantity input should be numeric.";
    document.getElementById("eggInfo").reset();
    return;
  }

  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        alert("Table Successfully Updated");
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/add.php";
     }

     /* response false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output").innerHTML = "Error adding information.";
      document.getElementById("eggInfo").reset();
    }

    /* horribleness has occured. Tell me what it was */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output").innerHTML = req.responseText;
       }
    }
  }

        /* send data to create table */
        req.open("POST","addToTable.php", true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var tableData = "variable="+variable+"&quantity="+quantity+"&table="+whichTable;
        req.send(tableData);
    }
}

  /*******************************************************************
   *           Adding Purpose Info
  ********************************************************************/
  function addPurpose(){

  /* get values from form */
  var variable = document.getElementById("purposeType").value;
  var whichTable = "purpose";

  /* check for blanks in the form */
  if(variable == null || variable == ""){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
    document.getElementById("purposeInfo").reset();
    return;
  }

  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        alert("Table Successfully Updated");
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/add.php";
     }

     /* response false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output").innerHTML = "Error adding information.";
      console.log(req.responseText);
      document.getElementById("eggInfo").reset();
    }

    /* horribleness has occured. Tell me what it was */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output").innerHTML = req.responseText;
       }
    }
  }

        /* send data to create table */
        req.open("POST","http://web.engr.oregonstate.edu/~masseyta/DBfinal/addToTable.php", true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var tableData = "variable="+variable+"&table="+whichTable;
        req.send(tableData);
    }
}


  /*******************************************************************
   *           Adding Temper Info
  ********************************************************************/
  function addTemper(){

  /* get values from form */
  var variable = document.getElementById("temperType").value;
  var whichTable = "temper";

  /* check for blanks in the form */
if(variable == null || variable == ""){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
    document.getElementById("temperInfo").reset();
    return;
  }

  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        alert("Table Successfully Updated");
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/add.php";
     }

     /* response false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output").innerHTML = "Error adding information.";
      document.getElementById("temperInfo").reset();
    }

    /* horribleness has occured. Tell me what it was */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output").innerHTML = req.responseText;
       }
    }
  }

        /* send data to create table */
        req.open("POST","addToTable.php", true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var tableData = "variable="+variable+"&table="+whichTable;
        req.send(tableData);
    }
}


  /*******************************************************************
   *           Adding Need Info
  ********************************************************************/
  function addNeed(){

  /* get values from form */
  var variable = document.getElementById("needType").value;
  var whichTable = "needs";

  /* check for blanks in the form */
  if(variable == null || variable == ""){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
    document.getElementById("temperInfo").reset();
    return;
  }

  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        alert("Table Successfully Updated");
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/add.php";
     }

     /* response false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output").innerHTML = "Error adding information.";
      document.getElementById("needsInfo").reset();
    }

    /* horribleness has occured. Tell me what it was */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output").innerHTML = req.responseText;
       }
    }
  }

        /* send data to create table */
        req.open("POST","addToTable.php", true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var tableData = "variable="+variable+"&table="+whichTable;
        req.send(tableData);
    }
}


/***********************************************************************
*       Add Breed to Table
***********************************************************************/
 function addBreed(){

  /* get values from form */
  var name = document.getElementById("name").value;
  var eggType = document.getElementById("egg").value;
  var purpose = document.getElementById("purpose").value;
  var temper = document.getElementById("temperment").value;
 // var needs = document.getElementById("needs").value;

  if(name == null || name == ""){
    alert("You must enter input if submitting");
    document.getElementById("output").innerHTML = "You must enter input if submitting";
  }

  else{
    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        alert("Table Successfully Updated");
       window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/addAdditional.php";
     }

     /* response false, can't add to DB */
    if(req.responseText == 0){
      document.getElementById("output").innerHTML = "Error adding information.";
      document.getElementById("breedInfo").reset();
      document.getElementById("eggInfo").reset();
      document.getElementById("purposeInfo").reset();
      document.getElementById("temperInfo").reset();
    }

    /* horribleness has occured. Tell me what it was */
     else if(req.responseText != 1 && req.responseText != 0){
          document.getElementById("output").innerHTML = req.responseText;
       }
    }
  }

        /* send data to create table */
        req.open("POST","addToBreedTable.php", true);
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        var tableData = "name="+name+"&egg="+eggType+"&purpose="+purpose+"&temper="+temper;
        req.send(tableData);
    }
}

 