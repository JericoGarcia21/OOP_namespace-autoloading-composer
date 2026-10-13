# Composer Setup and Authentication Class

This guide explains how to set up Composer's PSR-4 autoloading for an authentication class stored in `app/Models/`. This is a separate example from the manual-loading and SPL-autoloading demo in [`without-composer/`](../without-composer/README.md).

## 1. Install and check Composer

Install Composer on your computer, then open a new terminal and check that PHP and Composer are available:

```powershell
php -v
composer --version
```

Installing Composer installs the Composer program. It does not create your project's `composer.json` file.

## 2. Set up the project folders

From this folder, create the following structure:

```text
with-composer/
├── app/
│   └── Models/
│       └── Authentication.php
├── composer.json
└── run.php
```

## 3. Configure `composer.json`

In `composer.json`, map the `App\` namespace to the `app/` folder:

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

This mapping means that the class `App\Models\Authentication` should be in `app/Models/Authentication.php`.

## 4. Create the Authentication class

In `app/Models/Authentication.php`, declare the matching namespace and class. For this basic demo, its public `login()` method checks hard-coded credentials:

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

The `App\Models` namespace matches the `app/Models/` directory, and the class name matches the `Authentication.php` filename. Although this example puts the class in `Models` as shown in the directory structure, authentication logic is commonly organized as a service in a larger application. These hard-coded credentials are only for demonstration.

## 5. Install the project dependencies and generate the autoloader

After creating `composer.json`, open a terminal in this `with-composer` folder and run:

```powershell
composer install
```

`composer install` reads `composer.json`, installs any declared dependencies, and generates `vendor/autoload.php`. This command uses the Composer program you installed on your computer; it does not install Composer itself or create `composer.json`.

If you later change the autoload mapping or add classes, refresh the generated autoloader with:

```powershell
composer dump-autoload
```

## 6. Load and use the class

In `run.php`, include Composer's generated autoloader, then use the class:

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

Composer loads `Authentication.php` when the code first uses `Authentication`; you do not write a separate `require_once` for the class file.

## 7. Run the demo

From this folder, run:

```powershell
php .\run.php
```

Expected output:

```text
Login successful.
```

This example uses hard-coded credentials for demonstration only. Do not use this approach in a real application.

## Troubleshooting

- **`composer` is not recognized**: Install Composer and reopen the terminal.
- **`vendor/autoload.php` not found**: Run `composer dump-autoload` from this folder.
- **Class not found**: Check that the namespace, class name, filename, and `App\` to `app/` mapping match.
