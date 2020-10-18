<?php
include "../product/index.php";
class switchrolesTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testswitchaccounts()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>