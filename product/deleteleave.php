<?php
//including the database connection file
include("db.php");
 
//getting id of the data from url
$LeaveID = $_GET['LeaveID'];
 $user = $_GET['User'];
//deleting the row from table
$result = mysqli_query($con, "DELETE FROM LEAVEAPPLICATIONS WHERE LeaveID=$LeaveID");
$currentUserDetails = mysqli_query($con, "SELECT `Email` FROM users where User_Type='manager'");
$email= NULL;
while($res = mysqli_fetch_array($currentUserDetails)) {         
 
   $email = $res['Email'];    
        

require 'PHPMailer/class.phpmailer.php';	
                                  
$mail = new PHPMailer;
$bodyContent = $user." has cancelled the leave request approved by you.";
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
$mail->Subject   = $user.' cancelled approved leave';
$mail->Body= $bodyContent;
if(!$mail->send()) 
{
    echo "<script type='text/javascript'>alert('Error sending Email');
	window.location.href='applyforleave.php';
	</script>";

}
else{

echo "<script type='text/javascript'>alert('Mail Sent.');
	window.location.href='applyforleave.php';
	</script>";
}
}
?>