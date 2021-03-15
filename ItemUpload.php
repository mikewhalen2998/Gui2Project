<?php
// take location input and push user to Selector.HTML
$IName = $_POST["ItemName"];
$ANum = $_POST["AisleNum"];

$uploaddir= 'img/';
$uploadfile = $uploaddir.basename($_FILES['userfile']['name']);

echo"ItemName: ".$IName;
?> <br><?php
echo"AisleNum: ".$ANum;
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


//After here upload to database







?>
