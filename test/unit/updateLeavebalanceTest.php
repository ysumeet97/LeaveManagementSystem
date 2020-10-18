<?php
include "../product/updatestaffs.php";
class updateLeavebalanceTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testupdateleaveBalance()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>