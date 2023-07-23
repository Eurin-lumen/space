<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$user = getUserById($user_id);
$borrowedBooks = getBorrowedBooksByUserId($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mon Profil</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="user_style.css">
</head>
<body>
    <header>
        <h1>Mon Profil</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Tableau de Bord</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="profile-info">
            <h2>Informations sur l'utilisateur</h2>
            <p><strong>Nom d'utilisateur :</strong> <?php echo $user['username']; ?></p>
            <p><strong>Role :</strong> <?php echo $user['role']; ?></p>
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
                            <a href="return.php?id=<?php echo $book['id']; ?>" class="return-button">Retourner</a>
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
