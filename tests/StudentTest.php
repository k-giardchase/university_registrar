<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once "src/Student.php";

    class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }

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

        function test_setId()
        {
            $name = 'John';
            $date = '3/24/15';
            $id = 1;
            $test_student = new Student($name, $date, $id);

            $test_student->setId(3);
            $result = $test_student->getId();

            $this->assertEquals(3, $result);
        }

        function test_save()
        {
            $name = 'John';
            $date = '2015-03-24';
            $id = null;
            $test_student = new Student($name, $date, $id);
            $test_student->save();

            $result = Student::getAll();

            $this->assertEquals($test_student, $result[0]);
        }

        function test_find()
        {
            $name = 'John';
            $date = '2015-03-24';
            $id = 1;
            $test_student = new Student($name, $date, $id);
            $test_student->save();

            $name2 = 'Jim';
            $date2 = '2014-03-24';
            $id2 = 2;
            $test_student2 = new Student($name2, $date2, $id2);
            $test_student2->save();

            $result = Student::find($test_student->getId());

            $this->assertEquals($test_student, $result);

        }

        function test_update()
        {
            $name = 'John';
            $date = '2015-03-24';
            $id = 1;
            $test_student = new Student($name, $date, $id);
            $test_student->save();
            $new_name = 'Maggie';
            $new_date = '2013-09-02';

            $test_student->update($new_name, $new_date);

            $this->assertEquals(['Maggie', '2013-09-02'], [$test_student->getName(), $test_student->getDate()]);
        }

        function delete()
        {
            $name = 'John';
            $date = '2015-03-24';
            $id = 1;
            $test_student = new Student($name, $date, $id);
            $test_student->save();

            $test_student->delete();
            $result = Student::getAll();

            $this->assertEquals([], $result);
        }

    }

?>
