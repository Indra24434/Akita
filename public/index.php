<?php

// CodeIgniter 4 Entry Point for Railway
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
chdir(FCPATH);

// Define all paths manually
define('ROOTPATH', realpath(FCPATH . '../') . DIRECTORY_SEPARATOR);
define('APPPATH', ROOTPATH . 'app' . DIRECTORY_SEPARATOR);
define('SYSTEMPATH', ROOTPATH . 'vendor/codeigniter4/framework/system' . DIRECTORY_SEPARATOR);
define('WRITEPATH', ROOTPATH . 'writable' . DIRECTORY_SEPARATOR);

// Load Composer
require ROOTPATH . 'vendor/autoload.php';

// Load Paths Config
require APPPATH . 'Config/Paths.php';
$paths = new Config\Paths();

// Load Environment
require_once SYSTEMPATH . 'Config/DotEnv.php';
(new CodeIgniter\Config\DotEnv(ROOTPATH))->load();

// Start CodeIgniter
$app = Config\Services::codeigniter();
$app->initialize();
$app->setContext(is_cli() ? 'php-cli' : 'web');
$app->run();