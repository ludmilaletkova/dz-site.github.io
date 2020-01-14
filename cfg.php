<?php
session_start();
define('SALT', 'salt'.'isaf'.'ucki'.'ngs'.'lat');
$db = mysqli_connect('localhost', 'u0920273_default', 'La!xV5eW', 'u0920273_default');
mysqli_query($db, 'SET NAMES utf8');
