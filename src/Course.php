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






    }
?>
