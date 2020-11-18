<?php

ob_start();
session_start(); 

$timezone=date_default_timezone_set("Africa/Nairobi");

defined('DS') ? null : define('DS',DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT','C:'.DS.'xampp'.DS.'htdocs'.DS.'Rnet');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH',SITE_ROOT.DS.'includes'.DS.'classes');

require_once("database.php");
require_once("db_object.php");
require_once("session.php");
require_once("functions.php");

require_once("user.php");
require_once("post.php");



?>