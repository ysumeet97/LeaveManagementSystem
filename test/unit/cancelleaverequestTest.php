<?php
include "../product/approveleave.php";
class cancelleaverequestTest extends \PHPUnit\Framework\TestCase{
public function testrequestcancel()
    {   
        $_POST['Usernames'] = "Titus";
        $_REQUEST['Passwords'] = "Titus12345";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>