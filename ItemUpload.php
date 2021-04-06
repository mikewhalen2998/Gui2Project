<?php
//Add styling to files for when users using return button
// take location input and push user to Selector.HTML
$IName = $_POST["ItemName"];
$ANum = $_POST["AisleNum"];
$IType = $_POST["itemType"];

$uploaddir= 'img/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo"ItemName: ".$IName;
?> <br><?php
echo"AisleNum: ".$ANum;
?> <br><?php
echo"Item Type: ".$IType;
?> <br><?php


echo"Uploadfile: ".$uploadfile;
?> <br><?php


echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "File is valid, and was successfully uploaded.\n";
} else {
    echo "Possible file upload attack!\n";
}

echo 'Here is some more debugging info:';
print_r($_FILES);

print "</pre>";
?>
<a href="ItemUpload.html">
      <input type="submit" value ="Return to Item Upload"/>
</a>
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
