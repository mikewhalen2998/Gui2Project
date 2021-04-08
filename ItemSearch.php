<!DOCTYPE HTML>
<html>
<head>

<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="searchphpstyle.css">

<title>GSA Search Page</title>
</head>

<body>

<!-- Header with clickable link to homepage -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="homepage.html">Grocery Shopping Assistant</a>
  </nav>

<!-- This div is for printing out what the user entered at the top left. For ex: Pizza and then they select Frozen in the selector -->
<div class="searchInformation">
<?php
$IName=$_POST["ItemName"];
$IType=$_POST["itemType"];


echo"ItemName: ".$IName;
?> <br><?php
echo"Item Type: ".$IType;
?> <br><?php
?>


<!-- This button will return them to the search page if they'd like to search for another item -->
<a href="ItemSearch.html">
      <input type="submit" value ="Search for Another Item"/>
</a>
</div>  <!-- Closing out of searchInformation div -->
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
?>

<br>
<!-- This div will pertain to the information about the item that is printed out on the screen. Ex: Item name, Aisle number, photo, Item type -->
<div class="foodInformation">
 <?php
for($i=0; $i<count($selectedItems);$i++){
  ?>
  <div class="itemNameStyling">
  <?php
  echo"Item Name: ".$selectedItems[$i]["itemName"];
  ?>
</div> <!--itemName Styling close -->

  <div class="aisleNumberStyling">
  <?php
  echo"   Aisle Number: ".$selectedItems[$i]["aisleNumber"];
  ?>
</div> <!-- aisleNumberStyling close -->

    <div class="imageStyling">
    <img src="<?php echo $selectedItems[$i]["image"]?>" alt="Image not displayed">
</div> <!-- imageStyling close -->

    <div class="itemTypeStyling">
    <?php
  echo"   Item Type:  ".$selectedItems[$i]["itemType"];
?>
</div> <!-- itemTypeStyling close div -->
 <hr> <!-- Line below each set of information per product -->
 <br><!-- These are just for spacing -->
 <br><!-- These are just for spacing -->
<?php
} // Close of for loop
?>
</div> <!-- close of foodInformation div -->

<!-- Scripts and close out tags for body and html -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>
