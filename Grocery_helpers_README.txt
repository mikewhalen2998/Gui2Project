Grocery Helpers README

Connor Gonthier and Michael Whalen


Project Purpose: Design a website that grocery store shoppers can use to upload their findings at a grocery store and be able to search for where to find items at a grocery store. 
This project gives power to the users and is expandible by having willing participants of the website.


In order to run our program you can simply just go to our website at: http://weblab.cs.uml.edu/~cgonthie/gui2project/Homepage.html

You can test all functionality through the website on both desktop/mobile.

Lets talk about how the program works:
First you start off on the homepage and have to select the location at which you shop at and want to upload or search for an item.
After selecting and submitting the location you then are prompted with two choices. You can either search for an item or upload an item yourself.
If you select upload you will be prompted with several text fields, a file field, and a select menu along with a section of radio boxes that are optional.
You then upload your findings from the grocery store and upload them to our database.
Then if you wanted to search for an item you can click the previous page button in our header and go back and select item search. You then type in the name of the item you would like to search and select its type.
After doing both you will be presented with all items that match your search parameters.



If you want to see some error checking for search you can just search for an item like "pencil" and see the error message that will say something along the lines of "searched for item: pencil not found".

If you want to error check upload item, you can try to upload files that are too big in size or you can try to leave the fields that are required empty and see that you get prompted to fill out things.

The same goes for leaving search fields empty.


This Section is for if you wanted to implement the code yourself:

If you want to work with our code you have to import the folder called gui2project.
Then in the ItemUpload.php and ItemSearch.html where the below code is visible you would need to connect to your own database
following the same format and where it says ("use cgonthie") replace cgonthie with the database name you wish to use;

$dbConnection = new mysqli('weblab.cs.uml.edu', '[UserName]', '[Password]', '');
$dbConnection->query("use cgonthie");
if ($dbConnection->connect_error) {
  die("Connection failed: " . $dbConnection->connect_error);
}

Then you just have to have the same location table in the format of below. 
This is showing my table ItemsLowell but everylocation has the same style table with a different name
+-------------+--------------+------+-----+---------+----------------+
| Field       | Type         | Null | Key | Default | Extra          |
+-------------+--------------+------+-----+---------+----------------+
| id          | int(11)      | NO   | PRI | NULL    | auto_increment |
| itemName    | varchar(255) | NO   | UNI | NULL    |                |
| aisleNumber | varchar(255) | NO   |     | NULL    |                |
| image       | varchar(255) | NO   |     | NULL    |                |
| itemType    | varchar(255) | NO   |     | NULL    |                |
| tags        | varchar(255) | NO   |     | NULL    |                |
+-------------+--------------+------+-----+---------+----------------+

