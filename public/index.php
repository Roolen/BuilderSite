<?php

$minPHPVersion = "7.2";
if (phpversion() < $minPHPVersion)
{
    die("Your PHP version must be {$minPHPVersion} or higher to run.");
}
unset($minPHPVersion);

define("FCPATH", __DIR__ . DIRECTORY_SEPARATOR);
$pathsPath = FCPATH . "../config/Paths.php";

chdir(__DIR__);
require $pathsPath;
$paths = new Config\Paths();

require $paths->systemDirectory . "/App.php";
$app = new Core\App($paths);
$app->start();