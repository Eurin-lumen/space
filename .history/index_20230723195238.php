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
