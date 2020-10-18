<?php
include "../product/approveleave.php";
class approveleaveTest extends \PHPUnit\Framework\TestCase{
public function testVadationOk()
    {   
        $_POST['Usernames'] = "Titus";
        $_REQUEST['Passwords'] = "Titus12345";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>