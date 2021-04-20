<!DOCTYPE html>
<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="stylesheet" href="itemUploadStyle.css">
<title>GSA Item Upload</title>
</head>


<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="homepage.html">Grocery Shopping Assistant</a>
  </nav>

<div class="itemInfoPrintout">
<?php
//Add styling to files for when users using return button
// take location input and push user to Selector.HTML
$IName = $_POST["ItemName"];
$ANum = $_POST["AisleNum"];
$IType = $_POST["itemType"];
session_start();
$Location = $_SESSION['location'];
//getting tags
$EnteredTags = $_POST['TagList'];
$Tags="";
if (!(empty($EnteredTags))){
  $C = count($EnteredTags);
  for($i=0;$i<$C;$i++){
  $Tags =  $Tags.$EnteredTags[$i]." ";
  }

}//tags if over


$uploaddir= 'img/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo"Item Name: ".$IName;
?> <br><?php
echo"Aisle Number: ".$ANum;
?> <br><?php
echo"Item Type: ".$IType;
?> <br><?php
echo"Location: ".$Location;
?> <br><?php
echo"Tags: ".$Tags;
?> <br><?php



echo"Upload file: ".$uploadfile;
?> <br><?php

$TooLarge ="0";
echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and not too large.\n";
} else {
  $TooLarge ="1";
    echo "File to large for database, Crop image and try to reupload.\n";
}
$errMsg="";
$dbConnection = new mysqli('localhost', 'root', '', 'gui2');
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
}
//Using prepares statments to insert all the item information collected from the html page
//into our database, printing out errors at each location should there be an error
//New Locations call for new tables
if($TooLarge == 0){
if ($Location=="Lowell"){
$stmt = $dbConnection->prepare("INSERT INTO ItemsLowell (itemName, aisleNumber, image, itemType, tags) VALUES (?, ?, ?, ?,?)");
if(false ===$stmt){
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}
$check = $stmt->bind_param("sssss", $IName, $ANum, $uploadfile,$IType,$Tags);
if(false ===$check){
  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}
$check = $stmt->execute();
if(false ===$check){
  $errMsg="Failed to Upload Item to Lowell Database, Duplicate Names cannot exist at the same location";
  //die('execute() failed: ' . htmlspecialchars($stmt->error));
}
}//Location If Closed
//New Locations call for new tables
if ($Location=="Tewksbury"){
$stmt = $dbConnection->prepare("INSERT INTO ItemsTewksbury (itemName, aisleNumber, image, itemType, tags) VALUES (?, ?, ?, ?,?)");
if(false ===$stmt){
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}
$check = $stmt->bind_param("sssss", $IName, $ANum, $uploadfile,$IType,$Tags);
if(false ===$check){
  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}
$check = $stmt->execute();
if(false ===$check){
  $errMsg="Failed to Upload Item to Tewksburry Database, Duplicate Names cannot exist at the same location";
  //die('execute() failed: ' . htmlspecialchars($stmt->error));
}
}//Location If Closed
}//too large IF Close
if(!($errMsg=="")){
  ?>
  <div id ="errorMessage">
    <p> <?php echo $errMsg;?>  </p>
  </div>
<style> p{color:red;} <style>
<?php
}
/*
echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
*/
?>

<a href="ItemUpload.html">
      <input type="submit" value ="Return to Item Upload"/>
</a>
</div><!-- itemInfoPrintout close -->
<br><br>
<?php
//After here upload to database
//Opening Connection to database and testing connection

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
