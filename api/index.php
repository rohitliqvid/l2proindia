<?php

require 'Slim/Slim.php';
require_once './database.php';

$app = new Slim();

require_once('./user.php');
require_once('./notes.php');


?>