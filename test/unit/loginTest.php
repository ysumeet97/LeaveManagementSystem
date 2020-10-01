<?php
include "../product/login.php";
class loginTest extends \PHPUnit_Framework_TestCase{
public function testValidationOk()
    {   if (isset($_POST['Usernames'])){
        is_string($_POST['Usernames']) && is_string($_REQUEST['Passwords']);

    }

    }
}
?>