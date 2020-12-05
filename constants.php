<?php
/**
 * Created by PhpStorm.
 * User: Acer
 * Date: 05.10.2019
 * Time: 12:35
 */

define('DEBUG', true);
define('APP_DIR', $_SERVER['DOCUMENT_ROOT']);
define('CONFIG_DIR', APP_DIR . DIRECTORY_SEPARATOR . 'configs');
define('VIEW_DIR', APP_DIR . DIRECTORY_SEPARATOR . 'view');
define('DB_DRIVER', 'mysql');

define('UPLOAD_DIR_NAME', 'upload');
define('UPLOAD_DIR', APP_DIR.DIRECTORY_SEPARATOR.UPLOAD_DIR_NAME);
