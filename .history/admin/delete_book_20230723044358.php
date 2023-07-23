<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si l'administrateur est connecté
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Rediriger vers la page de connexion si l'administrateur n'est pas connecté
    header('Location: admin_login.php');
    exit();
}

// Vérifier si un livre a été sélectionné pour la suppression
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    
    // Récupérer les informations du livre depuis la base de données
    $book = getBookById($bookId);

    // Vérifier si le formulaire de suppression a été soumis
    if (isset($_POST['submit'])) {
        // Supprimer le livre de la base de données
        if (deleteBook($bookId)) {
            // Rediriger vers le tableau de bord de l'administrateur avec un message de succès
            header('Location: admin_dashboard.php?message=Le livre a été supprimé avec succès');
            exit();
        } else {
            // Rediriger vers la page de suppression de livre avec un message d'erreur
            header('Location: delete_book.php?id=' . $bookId . '&error=Une erreur s\'est produite lors de la suppression du livre');
            exit();
        }
    }
} else {
    // Rediriger vers le tableau de bord de l'administrateur si aucun livre n'a été sélectionné
    header('Location: admin_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un Livre</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Supprimer un Livre</h1>
    </header>

    <main>
        <div class="admin-container">
            <p>Êtes-vous sûr de vouloir supprimer le livre "<?php echo $book['title']; ?>" ?</p>
            <form action="delete_book.php?id=<?php echo $book['id']; ?>" method="post">
                <input type="submit" name="submit" value="Oui">
                <a href="admin_dashboard.php">Annuler</a>
            </form>
        </div>
    </main>
</body>
</html>
