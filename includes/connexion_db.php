<?php
    // 1) connexion
function connect() {
    $db = new PDO('mysql:host=localhost;dbname=musique','root','');
    return $db;
}

?>