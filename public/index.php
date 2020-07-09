<?php
error_reporting(E_ALL);

$minPHPVersion = "7.2";
if (phpversion() < $minPHPVersion)
{
    die("Your PHP version must be {$minPHPVersion} or higher to run.");
}
unset($minPHPVersion);

define("FCPATH", __DIR__ . DIRECTORY_SEPARATOR);
$pathsPath = FCPATH . "../config/Paths.php";
$databasePath = FCPATH . "../config/Database.php";
$appPath = FCPATH . "../config/App.php";
$constantsPath = FCPATH . "../core/Constants.php";

require $appPath;
require $databasePath;
require $constantsPath;

chdir(__DIR__);
require $pathsPath;
$paths = new Config\Paths();

require $paths->systemDirectory . "/App.php";
$app = new Core\App($paths);
$app->start();