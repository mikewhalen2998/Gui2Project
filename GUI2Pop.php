<?php

//Creates new instance of the Database that Cindy gave us
$DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];

$DBInit = "gui2";

// Connects to the SQL Server
if($myconnection = mysqli_connect('localhost', 'root', '') ){
    echo "Connected to Sql Server<br>";
} else  {
    die ('Could not connect to server');

}

//Checks to see if Database already exists
if($mydb = mysqli_select_db ($myconnection, 'gui2')){
    echo "Connection made to gui2<br>";
} else  {
    echo "gui2 could not be found <br>";
    if (mysqli_query($myconnection, "CREATE DATABASE gui2")) {
        echo "gui2 created successfully <br>";
        $mydb = mysqli_select_db ($myconnection, 'gui2');
        } else {
        echo "Error creating gui2: " . mysqli_error($conn);
        die ('Could not connect to gui2');
      }
}

//gets gui2 sql puts it into $query
$fp = fopen("$DOCUMENT_ROOT/GUI2/code/gui2Pop.sql",'r');
$query = "";
while(!feof($fp)) {
    $newLine = fgets($fp);
    // echo $newLine . "<br>";
    $query = $query . $newLine  ;
}
fclose($fp);
$query = $query . "" ;



// runs query to build gui2 database
if(mysqli_multi_query($myconnection, $query)) {
    echo $DBInit . " gui2 populated successfully";
  } else {
    echo "Error populating gui2: " . mysqli_error($myconnection);
  }

?>
