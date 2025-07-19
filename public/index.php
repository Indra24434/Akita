<?php

// Valid PHP Version?
$minPHPVersion = '7.4';
if (phpversion() < $minPHPVersion) {
    die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
}

// Path to the front controller (this file)
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

// Ensure the current directory is pointing to the front controller's directory
chdir(FCPATH);

/*
 *---------------------------------------------------------------
 * BOOTSTRAP THE APPLICATION
 *---------------------------------------------------------------
 * This process sets up the path constants, loads and registers
 * our autoloader, along with Composer's, loads our constants
 * and fires up an environment-specific bootstrapping.
 */

// Load our paths config file
// This is the line that might need to be changed, depending on your folder structure.
$pathsPath = FCPATH . '../app/Config/Paths.php';
require realpath($pathsPath) ?: $pathsPath;

$paths = new Config\Paths();

// Location of the framework bootstrap file.
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';

if (is_file($bootstrap)) {
    require $bootstrap;
} else {
    // Try the new Boot.php location
    $bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'Boot.php';
    if (is_file($bootstrap)) {
        require $bootstrap;
    } else {
        // Fallback: define constants manually
        define('SYSTEMPATH', rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR);
        define('ROOTPATH', rtrim($paths->rootDirectory, '\\/ ') . DIRECTORY_SEPARATOR);
        define('APPPATH', rtrim($paths->appDirectory, '\\/ ') . DIRECTORY_SEPARATOR);
        define('WRITEPATH', rtrim($paths->writableDirectory, '\\/ ') . DIRECTORY_SEPARATOR);
        
        // Load Composer's autoloader
        require ROOTPATH . 'vendor/autoload.php';
    }
}

// Load environment settings from .env files into $_SERVER and $_ENV
if (class_exists('CodeIgniter\Config\DotEnv')) {
    require_once SYSTEMPATH . 'Config/DotEnv.php';
    (new CodeIgniter\Config\DotEnv(ROOTPATH))->load();
}

/*
 * ---------------------------------------------------------------
 * GRAB OUR CODEIGNITER INSTANCE
 * ---------------------------------------------------------------
 *
 * The CodeIgniter class contains the core functionality to make
 * the application run, and does all of the dirty work for us.
 */
$app = Config\Services::codeigniter();
$app->initialize();
$context = is_cli() ? 'php-cli' : 'web';
$app->setContext($context);

/*
 *---------------------------------------------------------------
 * LAUNCH THE APPLICATION
 *---------------------------------------------------------------
 * Now that everything is setup, it's time to actually fire
 * up the engines and make this app do its thang.
 */
$app->run();