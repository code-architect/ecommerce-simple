<?php
/**
 * Created by PhpStorm.
 * User: Code-Architect
 */
ob_start();
session_start();

// Configure paths
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__.DS."template".DS."front");
defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__.DS."template".DS."back");

// Database information
defined("DB_HOST") ? null : define("DB_HOST", "localhost");
defined("DB_USER") ? null : define("DB_USER", "root");
defined("DB_PASS") ? null : define("DB_PASS", "");
defined("DB_NAME") ? null : define("DB_NAME", "ecom_db");

//Database connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Requiring all files necessary
require_once('functions.php');


