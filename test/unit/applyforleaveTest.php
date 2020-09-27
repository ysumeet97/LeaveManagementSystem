<?php
include "../product/applyforleave.php";
class applyforleaveTest extends \PHPUnit\Framework\TestCase{
public function testValidnOk()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>