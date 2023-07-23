<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si un livre a été sélectionné
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];

    // Récupérer les informations du livre depuis la base de données
    $book = getBookById($bookId);
}

// Si le livre n'a pas été trouvé ou si l'ID du livre n'a pas été fourni dans l'URL, rediriger vers la page d'accueil
if (!$book) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $book['title']; ?></title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1><?php echo $book['title']; ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="search.php">Recherche</a></li>
                <li><a href="profile.php">Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="book-details">
            <img src="../images/<?php echo $book['image']; ?>" alt="<?php echo $book['title']; ?>" class="book-image">
            <div class="book-info">
                <h2><?php echo $book['title']; ?></h2>
                <p><strong>Auteur :</strong> <?php echo $book['author']; ?></p>
                <p><strong>Domaine :</strong> <?php echo $book['domain']; ?></p>
                <p><strong>Description :</strong> <?php echo $book['description']; ?></p>
                <p><strong>Nombre d'exemplaires disponibles :</strong> <?php echo $book['copies']; ?></p>
                <?php if ($book['copies'] > 0) : ?>
                    <a href="borrow.php?id=<?php echo $book['id']; ?>" class="borrow-button">Emprunter</a>
                <?php else : ?>
                    <p class="not-available">Désolé, ce livre n'est actuellement pas disponible.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
