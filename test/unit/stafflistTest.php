<?php
include "../product/stafflist.php";
class stafflistTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function ValidationOk()
    {   $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));
      
    }
}
?>