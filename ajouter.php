<?php
require 'connexion.php';
$message = "";

if (isset($_POST['submit'])) {
    if (!empty($_POST['titre']) && !empty($_POST['auteur_id'])) {
        
        $titre = $_POST['titre'];
        $auteur_id = $_POST['auteur_id']; // On récupère l'ID de l'auteur
        
        // 1. On prépare la requête avec des marqueurs nommés (:titre, :auteur_id) pour éviter les piratages[cite: 6]
        $stmt = $pdo->prepare("INSERT INTO livres (titre, auteur_id) VALUES (:titre, :auteur_id)");
        
        // 2. On exécute en remplaçant les marqueurs par les vraies variables[cite: 6]
        $stmt->execute([
            ':titre' => $titre,
            ':auteur_id' => $auteur_id
        ]);
        
        $message = "Le livre a été ajouté avec succès !";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre</title>
</head>
<body>
    <h1>Ajouter un livre</h1>
    <p><?= $message ?></p>
    
    <form action="ajouter.php" method="POST">
        <label>Titre :</label>
        <input type="text" name="titre"><br><br>
        
        <label>ID de l'auteur (ex: 1) :</label>
        <input type="number" name="auteur_id"><br><br>
        
        <input type="submit" name="submit" value="Ajouter">
    </form>
</body>
</html>