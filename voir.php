<?php
// On inclut le fichier de connexion pour utiliser $pdo[cite: 4, 5]
require 'connexion.php';

// On prépare la requête SQL pour récupérer tous les livres et le nom de leur auteur[cite: 4]
// (On utilise un JOIN car les tables sont séparées selon la question 1 du TD)
$sql = "SELECT livres.id, livres.titre, auteurs.nom AS auteur_nom 
        FROM livres 
        JOIN auteurs ON livres.auteur_id = auteurs.id";

// On exécute la requête[cite: 5]
$resultat = $pdo->query($sql);

// On transforme le résultat brut en un tableau PHP associatif[cite: 5]
$livres = $resultat->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir les livres</title>
</head>
<body>
    <h1>Liste des livres</h1>
    <ul>
        <!-- La boucle foreach reste exactement la même que dans le TD1 ! -->
        <?php foreach ($livres as $livre): ?>
            <li>
                <?= htmlspecialchars($livre['titre']) ?> - <?= htmlspecialchars($livre['auteur_nom']) ?>
                <!-- Lien pour modifier ce livre spécifique (Question 4)[cite: 8] -->
                <a href="modifier.php?id=<?= $livre['id'] ?>">(Modifier)</a>
            </li>
        <?php endforeach; ?>
    </ul>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>