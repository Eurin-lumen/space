<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Utilisateur</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="/user/user_style.css">
</head>
<body>
    <?php include 'user_nav.php'; ?>

    <header>
        <h1>Tableau de Bord Utilisateur</h1>
    </header>

    <main>
        <div class="dashboard-content">
            <h2>Bienvenue sur votre tableau de bord, <?php echo $user['username']; ?> !</h2>
            <p>Ceci est votre espace personnel où vous pouvez gérer vos emprunts et consulter les livres disponibles.</p>
            <h3>Livres Empruntés</h3>
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
