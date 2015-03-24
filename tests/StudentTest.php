<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once "src/Student.php";

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        function test_myFunction_firstTest()
        {
            //Arrange
            $test_MyProjectClass = new MyProjectClass;

            //Act
            $result = $test_MyProjectClass->myFunction();

            //Assert
            $this->assertEquals( /* expectation */, $result);
        }
    }

?>
