<?php
use \App\Models\Student;
use \App\Models\Teacher;
spl_autoload_register(function ($class) {
    $prefix = 'App\\';

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $class = substr($class, strlen($prefix));
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/app/' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

$student = new Student('John', 'Information Technology');
$teacher = new Teacher('Mr. Smith', 'Math');

echo $student->getSummary() . PHP_EOL;
echo $teacher->getSummary() . PHP_EOL;