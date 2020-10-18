<?php
include "../product/approvingleave.php";
class approvingleaveTest extends \PHPUnit\Framework\TestCase{
public function testVadaOk()
    {   
        $_POST['Usernames'] = "Titus";
        $_REQUEST['Passwords'] = "Titus12345";
   
        $this->assertTrue(!isset($_SESSION["Usernames"]));

      
    }
}
?>