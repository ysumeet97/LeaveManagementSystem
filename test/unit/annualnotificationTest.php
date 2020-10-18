<?php
include "../product/Recivedstaffnotifications.php";
class annualnotificationsTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testanualnotifications()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>