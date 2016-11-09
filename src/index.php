<?php

$link = mysqli_connect(
    'db',
    'user',
    'password'
);

mysqli_select_db($link, 'base');

phpinfo();