<?php
include "../product/sendstaffnotifications.php";
class sendsstaffnotificationsTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function annualNotification()
    {   $_POST['Usernames'] = "dennis";
        $_REQUEST['Passwords'] = "Dennis12340";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>