<?php
//including the database connection file
include("db.php");
 
//getting id of the data from url
$UserID = $_GET['UserID'];
 
//deleting the row from table
$result = mysqli_query($con, "DELETE FROM users WHERE UserID=$UserID");
 
//redirecting to the display page (index.php in our case)
header("Location:Registerstaffs.php");
?>