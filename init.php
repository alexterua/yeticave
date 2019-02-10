<?php

date_default_timezone_set("Europe/Kiev");

require_once __DIR__ . '/functions.php';
$db = require_once __DIR__ . '/config/db.php';

$link = mysqli_connect($db['host'], $db['user'], $db['password'], $db['database']);
mysqli_set_charset($link, "utf8");

$categories = [];
$content = '';