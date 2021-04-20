<?php
// take location input and push user to Selector.HTML
$radioVal = $_POST["location"];

session_start();
$_SESSION['location'] = $radioVal;

if ($radioVal == "Lowell"){
  header("Location:Selector.html");
}
if($radioVal == "Tewksbury"){
  header("Location:Selector.html");
}
else{
  echo "Error Picking Location please try again, Value: ";
  echo $radioVal;

}




   ?>
