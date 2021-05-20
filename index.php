<?php

session_start();
if (!isset($_SESSION['booksInCart'])) {
  $_SESSION['booksInCart'] = [];
}

require_once('.\App\Core\initializing.php');

global $currentRoute;
global $currentAction;

use App\Core\App;

$app = new App();
