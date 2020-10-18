<?php
include "../product/applyforleave.php";
class trackleaveTest extends \PHPUnit\Framework\TestCase{
public function testtrackleav()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>