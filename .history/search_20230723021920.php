<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Vérifier si le formulaire de recherche a été soumis
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];

    // Exécuter la recherche
    $searchResults = searchBooks($keyword);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recherche de livres</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="user/user_style.css">

</head>
<body>
    <?php include 'user/user_nav.php'; ?>

    <header>
        <h1>Recherche de Livres</h1>
    </header>

    <main>
        <form method="post" action="search.php" class="search-form">
            <input type="text" name="keyword" placeholder="Entrez un mot-clé">
            <input type="submit" name="search" value="Rechercher">
        </form>

        <?php if (isset($searchResults)) : ?>
            <div class="search-results">
                <?php if (count($searchResults) > 0) : ?>
                    <h2>Résultats de la recherche :</h2>
                    <ul>
                        <?php foreach ($searchResults as $book) : ?>
                            <li>
                                <img src="images/<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>">
                                <h3><?php echo $book['title']; ?></h3>
                                <p><strong>Auteur :</strong> <?php echo $book['author']; ?></p>
                                <p><strong>Domaine :</strong> <?php echo $book['domain']; ?></p>
                                <p><strong>Description :</strong> <?php echo $book['description']; ?></p>
                                <p><strong>Nombre d'exemplaires disponibles :</strong> <?php echo $book['copies']; ?></p>
                                <a href="user/view_book.php?id=<?php echo $book['id']; ?>" class="view-button">Voir Détails</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>Aucun résultat trouvé.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
