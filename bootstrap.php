<?php

define('APP_DIR', __DIR__ . DIRECTORY_SEPARATOR);
define('VIEW_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR );
define('CONFIG_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'configs' . DIRECTORY_SEPARATOR );
define('IMG_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);
define('HEADER', __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'header.php');
define('FOOTER', __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'footer.php');
define('ADMIN_HEADER', __DIR__ . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'admin_header.php');

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once APP_DIR . 'helpers.php';
