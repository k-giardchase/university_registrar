<?php

    $DB = new PDO('pgsql:host=localhost;dbname=uofu_test');

    class Student
    {
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
    }

?>
