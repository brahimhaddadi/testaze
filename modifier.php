<?php
require 'connexion.php';
$message = "";

// Si le formulaire est soumis pour modifier
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    
    // Requête préparée pour mettre à jour (UPDATE)[cite: 6]
    $stmt = $pdo->prepare("UPDATE livres SET titre = :titre WHERE id = :id");
    $stmt->execute([':titre' => $titre, ':id' => $id]);
    $message = "Livre modifié !";
}

// Récupération des infos du livre pour pré-remplir le formulaire via l'ID dans l'URL ($_GET)
$livre = null;
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM livres WHERE id = :id");
    $stmt->execute([':id' => $_GET['id']]);
    $livre = $stmt->fetch(PDO::FETCH_ASSOC); // fetch au lieu de fetchAll car on veut un seul livre[cite: 5]
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un livre</title>
</head>
<body>
    <h1>Modifier le livre</h1>
    <p><?= $message ?></p>
    
    <?php if ($livre): ?>
    <form action="modifier.php?id=<?= $livre['id'] ?>" method="POST">
        <!-- Champ caché pour garder l'ID -->
        <input type="hidden" name="id" value="<?= $livre['id'] ?>">
        
        <label>Titre :</label>
        <!-- On pré-remplit avec le titre actuel -->
        <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>">
        
        <input type="submit" name="submit" value="Enregistrer">
    </form>
    <?php else: ?>
        <p>Livre non trouvé.</p>
    <?php endif; ?>
    <a href="voir.php">Retour à la liste</a>
</body>
</html>