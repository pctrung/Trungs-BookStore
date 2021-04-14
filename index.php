<?php

session_start();

require_once('.\App\Core\initializing.php');

global $currentRoute;
global $currentAction;

use App\Core\App;

$app = new App();
