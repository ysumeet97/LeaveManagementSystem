<?php
include "../product/stafflist.php";
class leaverequesthistoryTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testleavehistory()
    {   $_POST['Usernames'] = "dennis";
        $_REQUEST['Passwords'] = "Dennis12340";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>