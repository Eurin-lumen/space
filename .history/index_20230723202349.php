<?php
require_once 'includes/config.php';
require_once 'includes/functions.php';

// Récupérer tous les livres disponibles
$books = getAllBooks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="user/user_style.css"> -->
    <link rel="stylesheet" href="css/header.css">

</head>
<body>
    <?php include 'header.php'; ?>
    
    <section class="search-section">
        <form action="search.php" method="GET">
            <input type="text" name="search_query" placeholder="Rechercher par domaine, titre ou auteur" required>
            <button type="submit">Rechercher</button>
        </form>
    </section>

    <section class="promotion-banner">
        <img src="images/bibliothque.jpg" alt="Bannière de promotion">
        <a href="user/view_book.php?id=<?php echo $featured_book['id']; ?>" class="view-more-button">Voir plus</a>
    </section>
    <main>
        <div class="book-list">
            <?php foreach ($books as $book) : ?>
                <div class="book">
                    <img src="images/<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>">
                    <h2><?php echo $book['title']; ?></h2>
                    <p><strong>Auteur :</strong> <?php echo $book['author']; ?></p>
                    <p><strong>Domaine :</strong> <?php echo $book['domain']; ?></p>
                    <p><strong>Description :</strong> <?php echo $book['description']; ?></p>
                    <p><strong>Nombre d'exemplaires disponibles :</strong> <?php echo $book['copies']; ?></p>
                    <a href="user/view_book.php?id=<?php echo $book['id']; ?>" class="view-button">Voir Détails</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

</body>
</html>
