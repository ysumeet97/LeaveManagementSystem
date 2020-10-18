<?php
include "../product/Registerstaffs.php";
class userlistTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testusers()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>