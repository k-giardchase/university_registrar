<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    class Course
    {
        private $course;
        private $coursenumber;
        private $id;

        function __construct($course, $coursenumber, $id = null)
        {
            $this->course = (string) $course;
            $this->coursenumber = (int) $coursenumber;
            $this->id = (int) $id;
        }

        function getCourse()
        {
            return $this->course;
        }

        function setCourse($new_course)
        {
            $this->course = (string) $new_course;
        }

        function getCourseNumber()
        {
            return $this->coursenumber;
        }

        function setCourseNumber($new_coursenumber)
        {
            $this->coursenumber = (int) $new_coursenumber;
        }

        function getId()
        {
            return $this->id;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO courses (course, coursenumber) VALUES ('{$this->getCourse()}', {$this->getCourseNumber()}) RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses");
            $courses = array();

            foreach($returned_courses as $returned_course){
                $course = $returned_course['course'];
                $coursenumber = $returned_course['coursenumber'];
                $id = $returned_course['id'];
                $new_course = new Course($course, $coursenumber, $id);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses *;");
        }

        function update($new_course, $new_coursenumber)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET course = '{$new_course}' WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("UPDATE courses SET coursenumber = {$new_coursenumber} WHERE id = {$this->getId()};");
            $this->setCourse($new_course);
            $this->setCourseNumber($new_coursenumber);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("DELETE FROM students_courses WHERE course_id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach($courses as $course){
                $course_id = $course->getId();
                if($course_id == $search_id){
                    $found_course = $course;
                }
            }
            return $found_course;
        }

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO students_courses (student_id, course_id) VALUES ({$student->getId()}, {$this->getId()});");
        }

        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT students.* FROM courses JOIN students_courses ON (courses.id = students_courses.course_id) JOIN students ON (students_courses.student_id = students.id) WHERE courses.id = {$this->getId()};");
            $returned_students = $query->fetchAll(PDO::FETCH_ASSOC);

                $students = array();
                foreach($returned_students as $returned_student) {
                $name = $returned_student['name'];
                $date = $returned_student['date'];
                $id = $returned_student['id'];
                $new_student = new Student($name, $date, $id);
                array_push($students, $new_student);
            }
            return $students;
        }
    }
?>
