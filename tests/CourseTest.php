<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    /**
    * @backupGlobals disabled
    * $backupStaticAttribute disabled
    */

    require_once 'src/Course.php';
    require_once "src/Student.php";

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
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

        function test_update()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);
            $test_course->save();
            $new_course = 'Outro';
            $new_coursenumber = 201;

            $test_course->update($new_course, $new_coursenumber);

            $this->assertEquals(['Outro', 201], [$test_course->getCourse(), $test_course->getCourseNumber()]);
        }

        function test_delete()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = null;
            $test_course = new Course($course, $coursenumber, $id);
            $test_course->save();

            $name = 'Otto';
            $date = '2015-09-13';
            $id2 = null;
            $test_student = new Student($name, $date, $id2);
            $test_student->save();

            $test_course->addStudent($test_student);
            $test_course->delete();

            $this->assertEquals([], $test_student->getCourses());
        }

        function test_find()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = 1;
            $test_course = new Course($course, $coursenumber, $id);
            $test_course->save();

            $course2 = 'Outro';
            $coursenumber2 = 201;
            $id2 = 2;
            $test_course2 = new Course($course2, $coursenumber2, $id2);
            $test_course2->save();

            $result = Course::find($test_course->getId());

            $this->assertEquals($test_course, $result);
        }

        function test_addStudent()
        {
            $course = 'Intro';
            $coursenumber = 102;
            $id = 1;
            $test_course = new Course($course, $coursenumber, $id);
            $test_course->save();

            $name = 'John';
            $date = '2015-03-24';
            $id = 2;
            $test_student = new Student($name, $date, $id);
            $test_student->save();

            $test_course->addStudent($test_student);
            $result = $test_course->getStudents();

            $this->assertEquals($test_student, $result[0]);
        }

    }
?>
