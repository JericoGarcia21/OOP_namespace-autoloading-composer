# Composer Setup Guide

This guide shows how to use Composer with PHP namespaces and autoloading.

## 1. Check if Composer is installed

Open the terminal and run:

```powershell
php -v
composer --version
```

If both commands work, Composer is ready to use.

## 2. Create the project structure

Inside the `with-composer` folder, create:

```text
with-composer/
├── app/
│   └── Services/
│       └── Authentication.php
├── composer.json
└── run.php
```

## 3. Configure composer.json

Create `composer.json` and add:

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

This means the namespace `App\` matches the `app/` folder.

## 4. Create the Authentication class

Create `app/Services/Authentication.php`:

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

## 5. Install Composer dependencies

In the `with-composer` folder, run:

```powershell
composer install
```

This creates `vendor/autoload.php`.

If you add or change classes later, refresh the autoloader:

```powershell
composer dump-autoload
```

## 6. Use the class in run.php

Create `run.php`:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Services\Authentication;

$storedPasswordHash = password_hash('demo-password', PASSWORD_DEFAULT);
$authentication = new Authentication($storedPasswordHash);

if ($authentication->authenticate('demo-password')) {
    echo 'Authentication successful.';
} else {
    echo 'Authentication failed.';
}

echo PHP_EOL;
```

## 7. Run the program

```powershell
php .\run.php
```

Expected output:

```text
Authentication successful.
```

## Notes

- You do not need to manually `require` the class file.
- Composer handles autoloading for you.
- This is the Composer version of the project.
