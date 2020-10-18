<?php
include "../product/holidays.php";
class holidaysTest extends \PHPUnit\Framework\TestCase{
public function testholidays()
    { 
   
        $this->assertTrue(!isset($_SESSION["UserID"]));
      
    }
}
?>