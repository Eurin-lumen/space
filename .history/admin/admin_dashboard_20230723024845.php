<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Tableau de Bord Administrateur</h1>
    </header>
    <nav class="admin-nav">
    <ul>
        <li><a href="admin_dashboard.php">Tableau de Bord</a></li>
        <li><a href="add_book.php">Ajouter un Livre</a></li>
        <li><a href="borrowed_books.php">Livres Empruntés</a></li>
        <li><a href="admin_logout.php">Déconnexion</a></li>
    </ul>
</nav>

    

    <main>
        <h2>Gestion des Livres</h2>
        <a href="add_book.php" class="add-book-button">Ajouter un Livre</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Domaine</th>
                <th>Description</th>
                <th>Exemplaires disponibles</th>
                <th>Actions</th>
            </tr>
            <?php
            require_once '../includes/functions.php';

            // Récupérer tous les livres de la base de données
            $books = getAllBooks();

            foreach ($books as $book) {
                echo '<tr>';
                echo '<td>' . $book['id'] . '</td>';
                echo '<td>' . $book['title'] . '</td>';
                echo '<td>' . $book['author'] . '</td>';
                echo '<td>' . $book['domain'] . '</td>';
                echo '<td>' . $book['description'] . '</td>';
                echo '<td>' . $book['copies'] . '</td>';
                echo '<td>';
                echo '<a href="edit_book.php?id=' . $book['id'] . '">Modifier</a>';
                echo '<a href="delete_book.php?id=' . $book['id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce livre ?\')">Supprimer</a>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
        </table>
    </main>

</body>
</html>
