<?php

$host = 'localhost';
$username = 'root';
$passwd = '';
$dbname = 'kolekcija';
$mysqli = new mysqli ($host, $username, $passwd, $dbname);
if ($mysqli->connect_errno) {
    echo 'Došlo je do greške u spajanju na bazu podataka!</br>';
    echo 'ID greške: '.$mysqli->connect_errno.'</br>';
    echo 'Opis greške: '.$mysqli->connect_error.'</br>';
    die ();
}
else {
    $mysqli->set_charset('utf8');
}
