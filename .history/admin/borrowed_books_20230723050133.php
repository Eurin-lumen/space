<!DOCTYPE html>
<html>
<head>
    <title>Livres Empruntés</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <div class="borrowed-books">
        <h2>Livres Empruntés</h2>
        <?php
        // Inclure le fichier de configuration et les fonctions
        require_once '../includes/config.php';
        require_once '../includes/functions.php';

        // Récupérer la liste des livres empruntés depuis la base de données
        $borrowed_books = getBorrowedBooks();

        if (!$borrowed_books) {
            echo '<p class="info-message">Aucun livre emprunté pour le moment.</p>';
        } else {
            // Afficher les livres empruntés dans un tableau
            echo '<table>';
            echo '<tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Utilisateur</th>
                    <th>Date d\'emprunt</th>
                    <th>Statut</th>
                  </tr>';

            foreach ($borrowed_books as $book) {
                echo '<tr>';
                echo '<td>' . $book['id'] . '</td>';
                echo '<td>' . $book['title'] . '</td>';
                echo '<td>' . $book['author'] . '</td>';
                echo '<td>' . $book['username'] . '</td>';
                echo '<td>' . $book['borrow_date'] . '</td>';
                echo '<td>' . ($book['is_returned'] ? 'Retourné' : 'Emprunté') . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        }
        ?>
    </div>
</body>
</html>
