<?php
// take location input and push user to Selector.HTML
$radioVal = $_POST["selection"];



if ($radioVal == "ItemSearch"){
  header("Location:ItemSearch.html");
}
else if ($radioVal == "UploadInfo"){
  header("Location:ItemUpload.html");
}
else{
  echo "Improper Radio Value, Value: ";
  echo $radioVal;
}




   ?>
