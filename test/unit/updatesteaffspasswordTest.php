<?php
include "../product/updatestaffspassword.php";
class updatestaffspasswordTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testupdatepass()
    {   $_POST['Usernames'] = "dennis";
        $_REQUEST['Passwords'] = "Dennis12340";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>