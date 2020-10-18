<?php
include "../product/stafflist.php";
class leavebalanceTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function ValidatiOk()
    {   $_POST['Usernames'] = "dennis";
        $_REQUEST['Passwords'] = "Dennis12340";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>