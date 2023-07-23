

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
        <table>
            <tr>
                <th>ID de l'Emprunt</th>
                <th>Titre du Livre</th>
                <th>Auteur du Livre</th>
                <th>Nom d'Utilisateur</th>
                <th>Date d'Emprunt</th>
                <th>Date de Retour</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
            <?php foreach ($borrowed_books as $book) : ?>
                <tr>
                    <td><?php echo $book['borrow_id']; ?></td>
                    <td><?php echo $book['title']; ?></td>
                    <td><?php echo $book['author']; ?></td>
                    <td><?php echo $book['username']; ?></td>
                    <td><?php echo $book['borrow_date']; ?></td>
                    <td><?php echo $book['return_date']; ?></td>
                    <td><?php echo $book['is_returned'] ? 'Retourné' : 'Emprunté'; ?></td>
                    <td>
                        <?php if (!$book['is_returned']) : ?>
                            <a href="mark_returned.php?borrow_id=<?php echo $book['borrow_id']; ?>">Marquer comme Retourné</a>
                        <?php endif; ?>
                        <a href="delete_borrow.php?borrow_id=<?php echo $book['borrow_id']; ?>">Supprimer l'Emprunt</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
