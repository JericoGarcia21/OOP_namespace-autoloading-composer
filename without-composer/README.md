# Without Composer: Manual Loading and SPL Autoloading

This folder is a standalone demo of PHP namespaces and two ways to load classes without Composer. Its `app/Models/` folder contains the `Student` and `Teacher` classes used by both scripts.

## Requirements

PHP must be installed and available as `php` in the terminal. Check with:

```powershell
php -v
```

## Manual loading

`manual.php` uses `require_once` for each model file. From this folder, run:

```powershell
php .\manual.php
```

## SPL autoloading

`spl_autoload.php` registers a custom autoloader that maps the `App\` namespace to the local `app/` folder. PHP loads a class file when the script first uses that class. Run:

```powershell
php .\spl_autoload.php
```

Neither example uses Composer. For the separate Composer demo, use the sibling [`with-composer/`](../with-composer/README.md) folder.
