# Composer Setup and Authentication Class

This guide explains how to set up Composer's PSR-4 autoloading for an `Authentication` class. This is a separate example from the manual-loading and SPL-autoloading demo in [`without-composer/`](../without-composer/README.md).

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
│   └── Services/
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

This mapping means that the class `App\Services\Authentication` should be in `app/Services/Authentication.php`.

## 4. Create the Authentication class

In `app/Services/Authentication.php`, declare the matching namespace and class. For this demo, the class can receive a password hash and use `password_verify()` to check a supplied password:

```php
<?php

namespace App\Services;

class Authentication
{
    public function __construct(
        private string $passwordHash
    ) {
    }

    public function authenticate(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
```

`authenticate()` returns `true` when the supplied password matches the hash, and `false` otherwise. In a real application, the hash would normally be retrieved from a database; this short example is for learning class autoloading, not a complete login system.

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

use App\Services\Authentication;

$storedPasswordHash = password_hash('demo-password', PASSWORD_DEFAULT);
$authentication = new Authentication($storedPasswordHash);

echo $authentication->authenticate('demo-password')
    ? 'Authentication successful.'
    : 'Authentication failed.';
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
Authentication successful.
```

The supplied `run.php` also checks an incorrect password and prints `Authentication failed.` for that check.

## Troubleshooting

- **`composer` is not recognized**: Install Composer and reopen the terminal.
- **`vendor/autoload.php` not found**: Run `composer dump-autoload` from this folder.
- **Class not found**: Check that the namespace, class name, filename, and `App\` to `app/` mapping match.
