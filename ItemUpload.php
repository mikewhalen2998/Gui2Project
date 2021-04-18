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

$uploaddir= 'img/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo"Item Name: ".$IName;
?> <br><?php
echo"Aisle Number: ".$ANum;
?> <br><?php
echo"Item Type: ".$IType;
?> <br><?php


echo"Upload file: ".$uploadfile;
?> <br><?php


echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
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
$dbConnection = new mysqli('localhost', 'root', '', 'gui2');
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
}
//Using prepares statments to insert all the item information collected from the html page
//into our database, printing out errors at each location should there be an error
$stmt = $dbConnection->prepare("INSERT INTO items (itemName, aisleNumber, image, itemType) VALUES (?, ?, ?, ?)");
if(false ===$stmt){
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}
$check = $stmt->bind_param("ssss", $IName, $ANum, $uploadfile,$IType);
if(false ===$check){
  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}
$check = $stmt->execute();
if(false ===$check){
  die('execute() failed: ' . htmlspecialchars($stmt->error));
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
