<?php
include "../product/login.php";
class loginTest extends \PHPUnit\Framework\TestCase{
public function testValidationOk()
    {   $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>