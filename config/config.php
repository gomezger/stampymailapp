<?php

if ($_SERVER['HTTP_HOST'] === 'stampymailapp.herokuapp.com')
    define('URL', 'https://stampymailapp.herokuapp.com/'); // production
else
    define('URL', 'http://127.1.1.1/stampymailapp/');  // development

define('HOST', 'remotemysql.com:3306');
define('DB', 'QHjdYpSCvW');
define('USER', 'QHjdYpSCvW');
define('PASSWORD', 'jy3VLLuOGv');
define('CHARSET', 'utf8mb4');



?>