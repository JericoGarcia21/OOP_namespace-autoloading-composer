# Set Up a PHP Project with Composer

This guide walks through creating a small PHP project from scratch and setting up Composer PSR-4 autoloading for an authentication class stored in the `Models` folder. Work in the `with-composer` folder; it is a separate example from the demos in `without-composer`.

## 1. Check PHP and Composer

Open a terminal in the `with-composer` folder and run:

```powershell
php -v
composer --version
```

This example uses PHP 8 or later. If either command is not recognized, install PHP or Composer, then open a new terminal and try again. Installing Composer gives you the `composer` command; it does not create this project's files.

## 2. Create the project folders and files

From the `with-composer` folder, create the folders:

```powershell
New-Item -ItemType Directory -Force app\Models
```

Then create these files in VS Code (or another editor):

```text
with-composer/
├── app/
│   └── Models/
│       └── Authentication.php
├── composer.json
└── run.php
```

You create and fill in `composer.json`, `Authentication.php`, and `run.php` in the next steps. Composer will generate `vendor/` and `composer.lock` when you install the project; do not create those yourself.

## 3. Configure `composer.json`

Put this in the `composer.json` file:

```json
{
  "name": "oop/week9-composer-example",
  "description": "Composer PSR-4 authentication example",
  "autoload": {
    "psr-4": {
      "App\\": "app/"
    }
  }
}
```

The mapping tells Composer that a PHP class in the `App\` namespace lives under `app/`. For example, `App\Models\Authentication` maps to `app/Models/Authentication.php`. The namespace, directory names, and filename must match.

## 4. Create the class file

Put this in `app/Models/Authentication.php`:

```php
<?php

namespace App\Models;

class Authentication
{
    public function login(string $username, string $password): bool
    {
        $validUsername = 'admin';
        $validPassword = '1234';

        return $username === $validUsername && $password === $validPassword;
    }
}
```

The namespace corresponds to the folder path below `app/`: `Models` maps to `Models/`, and `Authentication` maps to `Authentication.php`. For this basic demo, `login()` compares the provided username and password with hard-coded values. Do not use hard-coded credentials in a real application.

## 5. Generate Composer's autoloader

In the `with-composer` folder, run:

```powershell
composer install
```

Composer reads `composer.json` and creates `vendor/autoload.php`, which your program will load. This example declares no third-party packages, so there are no application dependencies to download.

If you later change the PSR-4 mapping in `composer.json`, regenerate the autoloader:

```powershell
composer dump-autoload
```

## 6. Create the program entry point

Put this in `run.php`:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Models\Authentication;

$authentication = new Authentication();

echo $authentication->login('admin', '1234')
    ? 'Login successful.'
    : 'Login failed.';
echo PHP_EOL;
```

`vendor/autoload.php` registers Composer's autoloader. When the program first uses `Authentication`, Composer finds and loads its matching PHP file; you do not manually require that class file.

## 7. Run the project

From the `with-composer` folder, run:

```powershell
php .\run.php
```

Expected output:

```text
Login successful.
```

## What Composer does

- You create the project folders, `composer.json`, class file, and entry-point file.
- `composer install` generates `vendor/autoload.php` from the autoload configuration.
- Your PHP code requires the generated autoloader once; Composer loads matching class files when they are used.

This example demonstrates class autoloading and a basic hard-coded login check. The credentials are for demonstration only and should not be used in a real application.
