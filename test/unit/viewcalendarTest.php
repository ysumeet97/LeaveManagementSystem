<?php
include "../product/applyforleave.php";
class viewcalendarTest extends \PHPUnit\Framework\TestCase{
public function testcalander()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>