<?php
include "../product/updatestaffs.php";
class updaterolesTest extends \PHPUnit\Framework\TestCase{
    /** @test */
public function testupdateroles()
    {   
        $_POST['Usernames'] = "admin";
        $_REQUEST['Passwords'] = "admin";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>