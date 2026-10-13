# Set Up a PHP Project Without Composer

This guide shows how to create a small PHP project with namespaces, first by including class files manually and then by using PHP's SPL autoloading. Work in the `without-composer` folder; this is separate from the Composer example in [`with-composer/`](../with-composer/README.md).

## 1. Check that PHP is installed

Open a terminal in the `without-composer` folder and run:

```powershell
php -v
```

If `php` is not recognized, install PHP and make sure it is available on your PATH, then open a new terminal and try again. Composer is not needed for this example.

## 2. Create the project folders and files

From the `without-composer` folder, create the model directory:

```powershell
New-Item -ItemType Directory -Force app\Models
```

Create these files in VS Code or another editor:

```text
without-composer/
├── app/
│   └── Models/
│       ├── Student.php
│       └── Teacher.php
├── manual.php
└── spl_autoload.php
```

You will add the model classes first, then create one PHP script for manual loading and another for SPL autoloading.

## 3. Create the Student class

Put this in `app/Models/Student.php`:

```php
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
```

The `App\Models` namespace corresponds to the `app/Models/` folders.

## 4. Create the Teacher class

Put this in `app/Models/Teacher.php`:

```php
<?php

namespace App\Models;

class Teacher
{
    public function __construct(
        private string $name,
        private string $subject
    ) {
    }

    public function getSummary(): string
    {
        return "{$this->name} teaches {$this->subject}";
    }
}
```

Both classes use the same namespace because they are in the same `Models` folder.

## 5. Load the classes manually

Put this in `manual.php`:

```php
<?php

use App\Models\Student;
use App\Models\Teacher;

require_once __DIR__ . '/app/Models/Student.php';
require_once __DIR__ . '/app/Models/Teacher.php';

$student = new Student('John', 'Information Technology');
$teacher = new Teacher('Mr. Smith', 'Math');

echo $student->getSummary() . PHP_EOL;
echo $teacher->getSummary() . PHP_EOL;
```

Each class file is included explicitly with `require_once`. When you add another class, you must add another include.

Run it from this folder:

```powershell
php .\manual.php
```

Expected output:

```text
John is enrolled in Information Technology.
Mr. Smith teaches Math
```

## 6. Add an SPL autoloader

Instead of requiring every class file, put this in `spl_autoload.php`:

```php
<?php

use App\Models\Student;
use App\Models\Teacher;

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
```

The autoloader removes the `App\` namespace prefix and converts the rest of the class name into a path below `app/`. For example, `App\Models\Student` maps to `app/Models/Student.php`.

Run it from this folder:

```powershell
php .\spl_autoload.php
```

It prints the same two summary lines as the manual example.

## Manual loading vs. SPL

- **Manual loading:** You write a `require_once` for every class file.
- **SPL autoloading:** You register a function once; PHP calls it when a class is first used.
- **Composer:** Composer can generate an autoloader from configuration. See the separate [`with-composer/`](../with-composer/README.md) example.
