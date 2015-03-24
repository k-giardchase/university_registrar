<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once 'src/Course.php';

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
        }

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

        function test_save()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = 1;
            $test_course = new Course($course, $coursenumber, $id);

            $test_course->save();

            $result = Course::getAll();
            $this->assertEquals([$test_course], $result);
        }

        function test_getAll()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = 1;
            $test_course = new Course($course, $coursenumber, $id);
            $test_course->save();
            $course2 = 'PopLit';
            $coursenumber2 = 202;
            $id2 = 2;
            $test_course2 = new Course($course2, $coursenumber2, $id2);
            $test_course2->save();

            $result = Course::getAll();

            $this->assertEquals([$test_course, $test_course2], $result);
        }
    }
?>
