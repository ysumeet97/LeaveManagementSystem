<?php
include "../product/Registerstaffs.php";
class RegisterstaffsTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function VadationOk()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>