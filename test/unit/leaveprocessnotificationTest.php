<?php
include "../product/approvingleave.php";
class leaveproceenotificationTest extends \PHPUnit\Framework\TestCase{
public function testleavenotification()
    {   
        $_POST['Usernames'] = "Titus";
        $_REQUEST['Passwords'] = "Titus12345";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>