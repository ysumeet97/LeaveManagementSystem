<?php
include "../product/updatestaffspassword.php";
class updatemanagerpasswordTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testmanagerpassword()
    {   $_POST['Usernames'] = "Titus";
        $_REQUEST['Passwords'] = "Titus12345";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>