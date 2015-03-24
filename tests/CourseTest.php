<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once 'src/Course.php';

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        function test_getCourse()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);

            $result = $test_course->getCourse();

            $this->assertEquals('Intro to Psych', $result);
        }

        function test_setCourse()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);

            $test_course->setCourse('Intro to Math');
            $result = $test_course->getCourse();

            $this->assertEquals('Intro to Math', $result);
        }

        function test_getCourseNumber()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);

            $result = $test_course->getCourseNumber();

            $this->assertEquals(101, $result);
        }

        function test_setCourseNumber()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);

            $test_course->setCourseNumber(102);
            $result = $test_course->getCourseNumber();

            $this->assertEquals(102, $result);
        }

        function test_getId()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = 2;
            $test_course = new Course($course, $coursenumber, $id);

            $result = $test_course->getId();

            $this->assertEquals(2, $result);
        }

        function test_setId()
        {
            $course = 'Intro to Psych';
            $coursenumber = 101;
            $id = 2;
            $test_course = new Course($course, $coursenumber, $id);

            $test_course->setId(3);
            $result = $test_course->getId();

            $this->assertEquals(3, $result);
        }
    }
?>
