<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<?php
// including the database connection file
include_once("db.php");
 //$UserID = $_GET['UserID'];
if(isset($_POST['update']))
{   
//$NewPasswords = $_POST['NewPasswords'];
    //$Telphone = $_POST['Telphone'];
    //$Email = $_POST['Email'];
	//$Status = $_POST['Status'];
    //$User_Type = $_POST['User_Type'];
    //$Usernames = $_POST['Usernames'];
	$Passwords1 = $_POST['Passwords'];
	$UserID = $_POST['UserID'];
    if(empty($Passwords1) || empty($UserID)) 
	{                
        if(empty($UserID)) {
            echo "<font color='red'>UserID field is empty.</font><br/>";
        }
        
        if(empty($Newpasswords)) {
            echo "<font color='red'>Newpasswords field is empty.</font><br/>";
        }
        
       
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } 
	else {    
        //updating the table
		
        $result = mysqli_query($con, "UPDATE users SET Passwords='$Passwords1' WHERE UserID=$UserID");
        
        //redirectig to the display page. In our case, it is index.php
        header("Location:updatestaffspassword.php");
		echo '<script language="javascript">';
echo 'alert(" Your password is updated succesfully!!!!.")';
echo '</script>';
//echo '<script type="text/javascript">alert("Your password is updated succesfully!");</script>';
    }
}
?>
<?php
//getting id from url
$UserID = $_SESSION['UserID'];

//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT * FROM users WHERE UserID=$UserID");
 
while($res = mysqli_fetch_array($result))
{
/*FullName,Telphone,Email,Status, User_Type,Usernames,Passwords*/
    $FullName = $res['FullName'];
    //$Telphone = $res['Telphone'];
    //$Email = $res['Email'];
	//$Status = $res['Status'];
    //$User_Type = $res['User_Type'];
    $Usernames = $res['Usernames'];
	 $Passwords = $res['Passwords'];
}
?>



<!DOCTYPE html>
<html>
<head>
<link href="style.css" rel="stylesheet">
<style>
body
{
background-color:#FFFFCC;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333333;
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111111;
}
</style>
<style>
/* Style all input fields */
input {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: white;
  width:205px;
}

/* Style the container for inputs */
.container {
  background-color: #f1f1f1;
  padding: 20px;
}

/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}
</style>
<meta charset="utf-8">
<title>Registration</title>
</head>
<body>
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?>!||Your Leave balance is:<?php echo $_SESSION['LeaveBalance']; ?></p>
<ul>
  <li><a href="staffs.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Update the Password </h2>
<div id="form" style="padding-left:350px">
<form action="updatestaffspassword.php" method="post" name="form1">
        <table width="99%" border="0" align="left">
		
            <tr> 
                <td width="12%">Full Name:</td>
              <td width="14%"><input type="text" name="FullName" value="<?php echo $FullName;?>" disabled="true" required/></td>
				               
            </tr>
            <tr> 
                <td>UserName:</td>
                <td><input type="text" name="Usernames"  value="<?php echo $Usernames;?>" disabled="true" required/></td>
            </tr>
            <tr> 
                <td>Password:</td>
                <td><input type="text" name="Passwords1" value="<?php echo $Passwords;?>" disabled="true" required/></td>		
            </tr>
			<tr> 
            <td>New Password: </td>
                <td>
<input type="text" name="Passwords" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{10,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 10 or more characters" required/>
			  
				</td>    
            </tr>
			
			<tr> 
            <td><input type="submit" name="update" width="60%" value="UPDATE PASSWORD"></td>
                <td><input type="hidden" name="UserID" value=<?php echo $_SESSION['UserID']; ?>></td>    
			</tr>
    </table>
  </form>
  </div>

</div>
<script>
var myInput = document.getElementById("Passwords");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
</body>
</html>