<?php
include 'includes/connexion_db.php';

$db = connect();

$query = $db -> prepare('SELECT * FROM users');

$query -> execute();
$results = $query -> fetchAll();
echo json_encode($results);
?>