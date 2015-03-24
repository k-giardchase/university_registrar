<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    class Student
    {
        private $name;
        private $date;
        private $id;

        function __construct($name, $date, $id = null)
        {
            $this->name = $name;
            $this->date = $date;
            $this->id = $id;
        }

        function getName()
        {
            return $this->name;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getDate()
        {
            return $this->date;
        }

        function setDate($new_date)
        {
            $this->date = (string) $new_date;
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
            $statement = $GLOBALS['DB']->query("INSERT INTO students (name, date) VALUES ('{$this->getName()}', '{$this->getDate()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student){
                $name = $student['name'];
                $date = $student['date'];
                $id = $student['id'];
                $new_student = new Student($name, $date, $id);
                array_push($students, $new_student);
            }

            return $students;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students *;");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student){
                $student_id = $student->getId();
                if($student_id == $search_id){
                    $found_student = $student;
                }
            }
            return $found_student;
        }

        function update($new_name, $new_date)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $GLOBALS['DB']->exec("UPDATE students SET date = '{$new_date}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
            $this->setDate($new_date);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        }


    }
?>
