<?php
include "../product/updatestaffs.php";
class updatestaffsTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function VadationOk()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>