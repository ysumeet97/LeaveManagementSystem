<?php
//include auth.php file on all secure pages
include("auth.php");
$_SESSION['Usernames'];
$_SESSION['UserID'];
?>
<?php
// including the database connection file
include_once("db.php");
 //$UserID = $_GET['UserID'];
if(isset($_POST['update']))
{   $LeaveID = $_POST['LeaveID'];
	$ApprovalStatus = $_POST['ApprovalStatus'];
    //$Expirelystatus = $_POST['Expirelystatus'];
    $Comments = $_POST['Comments'];
	
	$UserID = $_POST['UserID'];
  $LeaveBalance= $_POST['LeaveBalance'];
  $Startdate = $_POST['Startdate'];
  $Enddate = $_POST['Enddate'];
  $start_date = strtotime($Startdate); 
  $end_date = strtotime($Enddate); 
  
// Get the difference and divide into  
// total no. seconds 60/60/24 to get  
// number of days 
  $diff = ($end_date - $start_date)/60/60/24;
  echo $diff;
	$NewLeaveBalance=($LeaveBalance-$diff);
    if(empty($LeaveID)||empty($ApprovalStatus)|| empty($Comments)) {                
        
        if(empty($LeaveID)) {
            echo "<font color='red'>LeaveID field is empty.</font><br/>";
        }
        if(empty($ApprovalStatus)) {
            echo "<font color='red'>ApprovalStatus field is empty.</font><br/>";
        }
        
        
        if(empty($Comments)) {
            echo "<font color='red'>Comments field is empty.</font><br/>";
        }
        
		 
        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } 
	else {    
        //updating the table
        $result = mysqli_query($con, "UPDATE LEAVEAPPLICATIONS SET ApprovalStatus='$ApprovalStatus',Comments='$Comments' WHERE LeaveID=$LeaveID");
		$result1 = mysqli_query($con, "UPDATE users SET LeaveBalance=$NewLeaveBalance WHERE UserID=$UserID");
    $leaveApplicationDetails = mysqli_query($con,"SELECT `UserID` FROM LEAVEAPPLICATIONS WHERE LeaveID='$LeaveID'");
    $userID = -1;
    while($res = mysqli_fetch_array($leaveApplicationDetails)){
      $userID = $res['UserID'];
    }
    if($userID != -1){
      $currentUserDetails = mysqli_query($con, "SELECT `Email` FROM users where UserID='$userID'");
      $email= NULL;
      while($res = mysqli_fetch_array($currentUserDetails)) {         

         $email = $res['Email'];    
      
    }
    if ($email != NULL){
      require 'PHPMailer/class.phpmailer.php';	
                                  
                              $mail = new PHPMailer;
                              $bodyContent = "Your Leave Application is ".$ApprovalStatus."";
                              $mail->Mailer = "smtp";                           // Set mailer to use SMTP
                              $mail->Host = "smtp.gmail.com";             // Specify main and backup SMTP servers
                              $mail->SMTPAuth = true;                     // Enable SMTP authentication
                              $mail->Username = "leavemanagementsystem0@gmail.com";          // SMTP username
                              $mail->Password = "product@4"; // SMTP password
                              $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
                              $mail->Port = 465;   
                              $mail->addReplyTo('info@example.com');		
                              $mail->addAddress($email);   // Add a recipient		
                              $mail->addCC('cc@example.com'); // can also add CC here
                              $mail->addBCC('bcc@example.com'); // can also add BCC here
                              $mail->isHTML(true);
                              $mail->addAttachment($target_file);
                              $mail->setFrom('leavemanagementsystem0@gmail.com','LEAVE MANAGEMENT SYSTEM');
                              $mail->Subject   = "Leave Application Outcome";
                              $mail->Body= $bodyContent;
                              if(!$mail->send()) 
                              {
                              $message ='Message could not be sent <br> Mailer Error: ' . $mail->ErrorInfo;
                              echo "<script type='text/javascript'>alert('$message');</script>";
                            header("Location:approveleave.php");
                          
                              }
                          else{
                              $message ='Mail sent ';
                              echo "<script type='text/javascript'>alert('$message');</script>";
                           //   echo "<script>location='Tech_Torrent_Form.php'</script>";
                             header("Location:approveleave.php");
                              }
  }
    }   
        //redirectig to the display page. In our case, it is index.php
    }
}
?>
<?php
//getting id from url
$LeaveID = $_GET['LeaveID'];
//selecting data associated with this particular id
$result = mysqli_query($con, "SELECT L.Description,L.Startdate,L.Enddate,L.ApprovalStatus,L.Comments,L.Fullname,L.UserID,U.UserID,U.LeaveBalance FROM LEAVEAPPLICATIONS L, users U WHERE L.LeaveID=$LeaveID AND L.UserID=U.UserID ");
 
while($res = mysqli_fetch_array($result))
{
/*Description,Startdate,Enddate,ApprovalStatus, Expirelystatus,Comments,Fullname,UserID,LeaveBalance*/
    $Description = $res['Description'];
    $Startdate = $res['Startdate'];
    $Enddate = $res['Enddate'];
    
	$ApprovalStatus = $res['ApprovalStatus'];
    //$Expirelystatus = $res['Expirelystatus'];
    $Comments = $res['Comments'];
	 $Fullname = $res['Fullname'];
	 $LeaveBalance=$res['LeaveBalance'];
	 $UserID=$res['UserID'];
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
<meta charset="utf-8">
<title>Registration</title>
</head>
<body>
<p align="left">Welcome <?php echo $_SESSION['Usernames']; ?>!||USER ID:<?php echo $_SESSION['UserID']; ?></p>
<ul>
  <li><a href="managers.php">HOME</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
<div>




<h1 align="center">EMPLOYEES LEAVE  MANAGEMENT SYSTEM</h1>
<h2 align="center">Approving/Rejecting the staff leave </h2>
<div id="form" style="padding-left:350px">
<form action="approvingleave.php" method="post" name="form1">
        <table width="99%" border="0">
		
            <tr> 
                <td width="19%">Leave Description:</td>
              <td width="29%"><input type="text" value="<?php echo $Description;?>" name="Description" required/></td>
				                <td width="18%">ApprovalStatus:</td>
              <td width="34%">
			  <select name="ApprovalStatus">
				<option value="<?php echo $ApprovalStatus;?>"><?php echo $ApprovalStatus;?></option>
				<option value="accepted">Accepted</option>
				<option value="Rejected">Rejected</option>
			  </select>
			  </td>
            </tr>
            <tr> 
                <td>Start date:</td>
                <td><input type="text" value="<?php echo $Startdate;?>" name="Startdate" required></td>
				<td>Comments:</td>
                <td><input type="text" value="<?php echo $Comments;?>" name="Comments" required/></td>
            </tr>
            <tr> 
                <td>End date:</td>
                <td><input type="text" value="<?php echo $Enddate;?>"  name="Enddate" required/></td>
		                <td>&nbsp;</td>
                        <td></td>		
            </tr>
			<tr> 
            <td><input type="submit" name="update" value="CONFIRM">&nbsp;</td>
                <td><input type="hidden" value=<?php echo $_GET['LeaveID'];?> name="LeaveID" ></td>    
				 <td><input type="hidden" value="<?php echo $UserID;?>" name="UserID" ></td>
                 <td><input type="hidden" value="<?php echo $LeaveBalance;?>" name="LeaveBalance" ></td>
            </tr>
			
    </table>
  </form>
  </div>

</div>
</body>
</html>