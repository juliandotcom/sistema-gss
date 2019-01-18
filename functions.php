<?php


function  escape($string) {
global $connection;

    mysqli_real_escape_string($connection, trim($string));

}







?>