<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once "src/Student.php";

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        function test_getName()
        {
            //Arrange
            $name = 'John';
            $date = '3/24/15';
            $id = null;
            $test_student = new Student($name, $date, $id);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_setName()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = null;
            $test_student = new Student($name, $date, $id);

            $test_student->setName('Anthony');
            $result = $test_student->getName();

            $this->assertEquals('Anthony', $result);
        }

        function test_getDate()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = null;
            $test_student = new Student($name, $date, $id);

            $result = $test_student->getDate();

            $this->assertEquals($date, $result);
        }

        function test_setDate()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = null;
            $test_student = new Student($name, $date, $id);

            $test_student->setDate('3/23/15');
            $result = $test_student->getDate();

            $this->assertEquals('3/23/15', $result);
        }

        function test_getId()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = 1;
            $test_student = new Student($name, $date, $id);

            $result = $test_student->getId();

            $this->assertEquals(1, $result);
        }

        function setId()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = 1;
            $test_student = new Student($name, $date, $id);

            $test_student->setId(3);
            $result = $test_student->getId();

            $this->assertEquals(3, $result);
        }

        
    }

?>
