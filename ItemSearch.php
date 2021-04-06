<?php
$IName=$_POST["ItemName"];
$IType=$_POST["itemType"];

echo"ItemName: ".$IName;
?> <br><?php
echo"Item Type: ".$IType;
?> <br><?php
?>
<a href="ItemUpload.html">
      <input type="submit" value ="Return to Item Seach"/>
</a>
<br><br>
<?php

//Opening Connection to database and testing connection
$dbConnection = new mysqli('localhost', 'root', '', 'gui2');
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
}

$stmt = $dbConnection->prepare("Select * FROM items WHERE itemName like CONCAT( '%',?,'%') AND itemType = ? ");
if(false ===$stmt){
  die('prepare() failed: ' . htmlspecialchars($mysqli->error));
}
$check = $stmt->bind_param("ss", $IName, $IType);
if(false ===$check){
  die('bind_param() failed: ' . htmlspecialchars($stmt->error));
}
$check = $stmt->execute();
if(false ===$check){
  die('execute() failed: ' . htmlspecialchars($stmt->error));
}
$selectedItems = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
 $stmt->close();
 //var_dump($selectedItems);

?> <br> <?php
for($i=0; $i<count($selectedItems);$i++){
  echo"Item Name: ".$selectedItems[$i]["itemName"];
  echo"   Aisle Number: ".$selectedItems[$i]["aisleNumber"];
  echo"   Image:  ".$selectedItems[$i]["image"];
  echo"   Item Type:  ".$selectedItems[$i]["itemType"];
?> <br><br> <?php

}


?>
