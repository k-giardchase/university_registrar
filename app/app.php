<?php

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/Course.php';
    require_once __DIR__.'/../src/Student.php';


    $DB = new PDO('pgsql:host=localhost; dbname=uofu');

    $app = new Silex\Application();

    $app['debug'] = true;

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path'=>__DIR__.'/../views'
    ));

    $app->get('/', function() use ($app) {
        return $app['twig']->render('index.twig', array('courses' => Course::getAll()));
    });

    $app->get('/courses', function() use ($app) {
        return $app['twig']->render('courses.twig', array('courses' => Course::getAll()));
    });

    $app->post('/courses', function() use ($app) {
        $course = $_POST['course'];
        $coursenumber = $_POST['coursenumber'];
        $new_course = new Course($course, $coursenumber);
        $new_course->save();
        return $app['twig']->render('courses.twig', array('courses' => Course::getAll()));
    });

    $app->get('/courses/{id}', function($id) use ($app) {
        $course = Course::find($id);
        return $app['twig']->render('course.twig', array('course' => $course, 'courses' => Course::getAll(), 'students' => Student::getAll()));
    });

    $app->post('/courses/{id}', function($id) use($app) {
        $course = Course::find($id);
        $name = $_POST['name'];
        $date = $_POST['date'];
        $new_student = new Student($name, $date);
        $new_student->save();
        return $app['twig']->render
    });

    return $app;

?>
