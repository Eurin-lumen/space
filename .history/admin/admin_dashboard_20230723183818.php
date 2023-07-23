<?php
session_start();

// Vérifier si l'administrateur est connecté
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

require_once '../includes/config.php';
require_once '../includes/functions.php';

// Récupérer tous les livres
$books = getAllBooks();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de Bord Administrateur</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Tableau de Bord Administrateur</h1>
    </header>

    <main>
        <div class="admin-container">
            <h2>Liste des Livres</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Domaine</th>
                    <th>Description</th>
                    <th>Exemplaires disponibles</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?php echo $book['id']; ?></td>
                        <td><img src="<?php echo $book['image_filename']; ?>" alt="Image du livre"></td>
                        <td><?php echo $book['title']; ?></td>
                        <td><?php echo $book['author']; ?></td>
                        <td><?php echo $book['domain']; ?></td>
                        <td><?php echo $book['description']; ?></td>
                        <td><?php echo $book['copies']; ?></td>
                        
                        <td>
                            
                            <a href="edit_book.php?id=<?php echo $book['id']; ?>">Modifier</a>
                            <a href="delete_book.php?id=<?php echo $book['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?')">Supprimer</a>
                            <a href="view_book.php?id=<?php echo $book['id']; ?>">Consulter</a>
                            <a href="../pdf/<?php echo $book['pdf']; ?>" target="_blank">Voir PDF</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>

</body>
</html>
