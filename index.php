<?php

session_start();
if (!isset($_SESSION['bookInCart'])) {
  $_SESSION['bookInCart'] = [];
}

require_once('.\App\Core\initializing.php');

global $currentRoute;
global $currentAction;

use App\Core\App;

$app = new App();
