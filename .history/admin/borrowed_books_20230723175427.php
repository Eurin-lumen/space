<?php
// Inclure le fichier de fonctions
require_once '../includes/functions.php';

// Vérifier si l'administrateur est connecté
session_start();
if (!isAdminLoggedIn()) {
    header("Location: admin_login.php");
    exit();
}

// Récupérer les livres empruntés par les utilisateurs
$borrowed_books = getBorrowedBooks();

?>


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
    // Vérifier si $borrowed_books est un tableau ou un objet non vide avant de le boucler
    if (!empty($borrowed_books) && (is_array($borrowed_books) || is_object($borrowed_books))) {
        foreach ($borrowed_books as $borrowed_book) {
            // Afficher les détails du livre emprunté
            ?>
            <div class="borrowed-book">
                <p>ID de l'Emprunt: <?php echo $borrowed_book['id']; ?></p>
                <p>Titre du Livre: <?php echo $borrowed_book['title']; ?></p>
                <p>Auteur du Livre: <?php echo $borrowed_book['author']; ?></p>
                <p>Nom d'Utilisateur: <?php echo $borrowed_book['username']; ?></p>
                <p>Date d'Emprunt: <?php echo $borrowed_book['borrow_date']; ?></p>
                <p>Date de Retour: <?php echo $borrowed_book['return_date']; ?></p>
                <p>Action: 
                    <?php if ($borrowed_book['returned'] == 0) { ?>
                        <a href="mark_returned.php?id=<?php echo $borrowed_book['id']; ?>">Marquer comme retourné</a>
                    <?php } else { ?>
                        Livre retourné
                    <?php } ?>
                </p>
            </div>
            <?php
        }
    } else {
        // Aucun livre emprunté trouvé
        echo "<p>Aucun livre emprunté pour le moment.</p>";
    }
    ?>
</div>
</body>
</html>
