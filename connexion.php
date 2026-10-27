<?php
$host = '127.0.0.1'; // À l'IUT : 'iutinfo-sgbd.uphf.fr'
$dbname = 'iutinfo601';
$user = 'iutinfo601'; // À l'IUT, l'utilisateur est généralement identique au nom de la base
$password = 'q/eA/Sp6';

try {
    // Si l'IUT utilise MySQL :
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    
    // Si l'IUT utilise PostgreSQL, commentez la ligne au-dessus et décommentez celle-ci :
    // $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>