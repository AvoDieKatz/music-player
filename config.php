<?php
    define('DB_SERVER', '127.0.0.1');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', '@Tungta2001');
    define('DB_NAME', 'TuneSource');

    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($link === false) {
        die("ERROR: Can't connect. " . mysqli_connect_error());
    }
?>