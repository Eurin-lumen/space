<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['user_id'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}

// Récupérer les informations de l'utilisateur connecté
$user = getUserById($_SESSION['user_id']);

// Récupérer les livres empruntés par l'utilisateur
$borrowedBooks = getBorrowedBooksByUserId($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Profil</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Mon Profil</h1>
        <?php include 'user_nav.php'; ?>
    </header>

    <main>
        <div class="profile-info">
            <h2>Informations sur l'utilisateur</h2>
            <p><strong>Nom d'utilisateur :</strong> <?php echo $user['username']; ?></p>
            <p><strong>Rôle :</strong> <?php echo $user['role']; ?></p>
        </div>

        <div class="borrowed-books">
            <h3>Livres empruntés :</h3>
            <?php if (count($borrowedBooks) > 0) : ?>
                <ul>
                    <?php foreach ($borrowedBooks as $book) : ?>
                        <li>
                            <p class="book-title"><?php echo $book['title']; ?></p>
                            <p class="book-author"><?php echo $book['author']; ?></p>
                            <p class="borrow-date">Emprunté le <?php echo $book['borrow_date']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p class="no-books">Aucun livre emprunté pour le moment.</p>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
