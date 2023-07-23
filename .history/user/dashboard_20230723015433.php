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
    <title>Tableau de Bord Utilisateur</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="/user_style.css">
</head>
<body>
    <?php include 'user_nav.php'; ?>

    <header>
        <h1>Tableau de Bord Utilisateur</h1>
    </header>

    <main>
        <div class="dashboard-container">
            <div class="dashboard-item">
                <h2 class="dashboard-title">Informations sur l'utilisateur</h2>
                <?php if ($user) : ?>
                    <p><strong>Nom d'utilisateur :</strong> <?php echo $user['username']; ?></p>
                    <p><strong>Rôle :</strong> <?php echo $user['role']; ?></p>
                <?php else : ?>
                    <p>Informations sur l'utilisateur non disponibles.</p>
                <?php endif; ?>
            </div>

            <div class="dashboard-item">
                <h2 class="dashboard-title">Livres empruntés</h2>
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
                    <p>Aucun livre emprunté pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>
