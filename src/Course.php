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




    }
?>
