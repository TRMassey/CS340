
 
/*******************************************************************
   *           Adding Birds to Flock
  ********************************************************************/
  function addFlock(){

  /* get values from form */
  var variable = document.getElementById("name").value;
  var whichTable = "flock";

    req = new XMLHttpRequest();
    req.onreadystatechange = function(){
     if(req.readyState == 4 && req.status == 200){

      /* response true, continue */
     if(req.responseText == 1){
        /* everything has passed! Yay! Go into your session */
        window.location.href = "http://web.engr.oregonstate.edu/~masseyta/DBfinal/flock.php";
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
        var tableData = "variable="+variable+"&table="+whichTable;
        req.send(tableData);
  
}
