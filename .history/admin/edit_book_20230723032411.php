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

// Vérifier si un livre a été sélectionné pour l'édition
if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    
    // Récupérer les informations du livre depuis la base de données
    $book = getBookById($bookId);

    // Vérifier si le formulaire d'édition a été soumis
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $domain = $_POST['domain'];
        $description = $_POST['description'];
        $copies = $_POST['copies'];

        // Vérifier si l'image a été téléchargée avec succès
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image']['name'];
            $target = '../images/' . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        } else {
            $image = $book['image'];
        }

        // Vérifier si le fichier PDF a été téléchargé avec succès
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
            $pdf = $_FILES['pdf']['name'];
            $target = '../pdf/' . $pdf;
            move_uploaded_file($_FILES['pdf']['tmp_name'], $target);
        } else {
            $pdf = $book['pdf'];
        }

        // Mettre à jour le livre dans la base de données
        if (updateBook($bookId, $title, $author, $domain, $description, $copies, $image, $pdf)) {
            // Rediriger vers le tableau de bord de l'administrateur avec un message de succès
            header('Location: admin_dashboard.php?message=Le livre a été mis à jour avec succès');
            exit();
        } else {
            // Rediriger vers la page d'édition de livre avec un message d'erreur
            header('Location: edit_book.php?id=' . $bookId . '&error=Une erreur s\'est produite lors de la mise à jour du livre');
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
    <title>Éditer un Livre</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Éditer un Livre</h1>
    </header>

    <main>
        <div class="admin-container">
            <form action="edit_book.php?id=<?php echo $book['id']; ?>" method="post" enctype="multipart/form-data">
                <label for="title">Titre :</label>
                <input type="text" name="title" value="<?php echo $book['title']; ?>" required>
                
                <label for="author">Auteur :</label>
                <input type="text" name="author" value="<?php echo $book['author']; ?>" required>
                
                <label for="domain">Domaine :</label>
                <select id="domain" name="domain" required>
                    <option value="Littérature" <?php if ($book['domain'] === 'Littérature') echo 'selected'; ?>>Littérature</option>
                    <option value="Science-fiction" <?php if ($book['domain'] === 'Science-fiction') echo 'selected'; ?>>Science-fiction</option>
                    <option value="Policier" <?php if ($book['domain'] === 'Policier') echo 'selected'; ?>>Policier</option>
                    <option value="Fantastique" <?php if ($book['domain'] === 'Fantastique') echo 'selected'; ?>>Fantastique</option>
                    <option value="Biographie" <?php if ($book['domain'] === 'Biographie') echo 'selected'; ?>>Biographie</option>
                    <option value="Histoire" <?php if ($book['domain'] === 'Histoire') echo 'selected'; ?>>Histoire</option>
                    <option value="Science" <?php if ($book['domain'] === 'Science') echo 'selected'; ?>>Science</option>
                    <option value="Informatique" <?php if ($book['domain'] === 'Informatique') echo 'selected'; ?>>Informatique</option>
                    <option value="Romance" <?php if ($book['domain'] === 'Romance') echo 'selected'; ?>>Romance</option>
                    <option value="Cuisine" <?php if ($book['domain'] === 'Cuisine') echo 'selected'; ?>>Cuisine</option>
                </select>

                <label for="description">Description :</label>
                <textarea name="description" required><?php echo $book['description']; ?></textarea>
                
                <label for="copies">Exemplaires disponibles :</label>
                <input type="number" name="copies" value="<?php echo $book['copies']; ?>" required>

                <label for="image">Image :</label>
                <input type="file" name="image">

                <label for="pdf">Fichier PDF :</label>
                <input type="file" name="pdf">

                <input type="submit" name="submit" value="Mettre à jour">
            </form>
        </div>
    </main>
</body>
</html>
