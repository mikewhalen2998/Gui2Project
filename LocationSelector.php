<?php
// take location input and push user to Selector.HTML
$radioVal = $_POST["location"];



if ($radioVal == "Lowell"){
  header("Location:Selector.html");
}
else{
  echo "Lowell is only valid Radio Value Right now, Value: ";
  echo $radioVal;
}




   ?>
