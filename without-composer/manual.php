<?php

use App\Models\Student;
use App\Models\Teacher;

require_once __DIR__ . '/app/Models/Student.php';
require_once __DIR__ . '/app/Models/Teacher.php';

$student = new Student('John', 'Information Technology');
$teacher = new Teacher('Mr. Smith', 'Math');
echo __DIR__ . PHP_EOL."path";
echo $student->getSummary() . PHP_EOL;
echo $teacher->getSummary() . PHP_EOL;
