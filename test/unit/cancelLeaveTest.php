<?php
include "../product/applyforleave.php";
class cancelLeaveTest extends \PHPUnit\Framework\TestCase{
public function testcancel()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>