# Without Composer: Manual Loading and SPL Autoloading

This guide explains how to work with PHP namespaces and class loading without Composer.

## 1. Check if PHP is installed

Open the terminal and run:

```powershell
php -v
```

If PHP works, you can run the examples in this folder.

## 2. Manual loading example

The `manual.php` file uses `require_once` for each class file.

Example idea:

```php
<?php

require_once __DIR__ . '/app/Models/Student.php';
require_once __DIR__ . '/app/Models/Teacher.php';

use App\Models\Student;
use App\Models\Teacher;

$student = new Student();
$teacher = new Teacher();
```

This works, but you must manually include every file.

## 3. Run the manual example

From the `without-composer` folder, run:

```powershell
php .\manual.php
```

## 4. SPL autoloading example

The `spl_autoload.php` file registers a custom autoloader.

Example structure:

```php
<?php

spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/app/';

    if (strpos($class, $prefix) === 0) {
        $className = substr($class, strlen($prefix));
        $file = $baseDir . str_replace('\\', '/', $className) . '.php';

        if (file_exists($file)) {
            require_once $file;
        }
    }
});
```

Then you can use classes without writing `require_once` for each one:

```php
<?php

use App\Models\Student;
use App\Models\Teacher;

$student = new Student();
$teacher = new Teacher();
```

## 5. Run the SPL autoload example

```powershell
php .\spl_autoload.php
```

## 6. Difference from Composer

- Manual loading: you include each file yourself.
- SPL autoloading: PHP loads the file automatically when the class is used.
- Composer: the autoloader is generated automatically from `composer.json`.

This folder is the “without Composer” version. The Composer version is in the sibling folder named `with-composer`.

## Summary

Without Composer, you either:

1. manually require class files, or
2. create your own autoloader using SPL.

This helps you understand how autoloading works before using Composer.
