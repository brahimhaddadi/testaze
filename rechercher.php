<?php
$livres = [ 
    [ 'titre' => 'Dune', 'auteur' => 'Frank Herbert' ], 
    [ 'titre' => '1984', 'auteur' => 'George Orwell' ],
    [ 'titre' => 'Le Petit Prince', 'auteur' => 'Antoine de Saint-Exupéry' ] 
];

$message = "";

if (isset($_GET['recherche'])) {
    $recherche = htmlspecialchars($_GET['recherche']);
    
    if (!empty($recherche)) {
        $trouve = false;
        
        foreach ($livres as $livre) {
            // Comparaison insensible à la casse pour faciliter la recherche
            if (strtolower($livre['titre']) === strtolower($recherche)) {
                $trouve = true;
                break;
            }
        }
        
        if ($trouve) {
            $message = "Le livre '" . $recherche . "' est dans la médiathèque.";
        } else {
            $message = "Le livre '" . $recherche . "' n'est pas dans la médiathèque.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rechercher un livre</title>
</head>
<body>
    <h1>Rechercher un livre</h1>
    
    <form action="rechercher.php" method="GET">
        <label for="recherche">Rechercher :</label>
        <input type="text" name="recherche" id="recherche">
        <input type="submit" value="Chercher">
    </form>

    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>
    
    <br>
    <a href="index.php">Retour à l'accueil</a>
</body>
</html>