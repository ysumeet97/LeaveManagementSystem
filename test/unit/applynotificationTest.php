<?php
include "../product/applyforleave.php";
class applynotificationTest extends \PHPUnit\Framework\TestCase{
public function testnotification()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>