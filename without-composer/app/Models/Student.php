<?php

namespace App\Models;

class Student
{
    public function __construct(
        private string $name,
        private string $course
    ) {
    }

    public function getSummary(): string
    {
        return "{$this->name} is enrolled in {$this->course}.";
    }
}