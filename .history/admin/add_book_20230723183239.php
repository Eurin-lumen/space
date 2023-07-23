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

// Traitement du formulaire d'ajout de livre
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
        $image = null;
    }

    // Vérifier si le fichier PDF a été téléchargé avec succès
    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] === UPLOAD_ERR_OK) {
        $pdf = $_FILES['pdf']['name'];
        $target = '../pdf/' . $pdf;
        move_uploaded_file($_FILES['pdf']['tmp_name'], $target);
    } else {
        $pdf = null;
    }

    // Ajouter le livre dans la base de données
    if (addBook($title, $author, $domain, $description, $copies, $image, $pdf)) {
        // Rediriger vers le tableau de bord de l'administrateur avec un message de succès
        header('Location: admin_dashboard.php?message=Le livre a été ajouté avec succès');
        exit();
    } else {
        // Rediriger vers la page d'ajout de livre avec un message d'erreur
        header('Location: add_book.php?error=Une erreur s\'est produite lors de l\'ajout du livre');
        exit();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Livre</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <header>
        <h1>Ajouter un Livre</h1>
    </header>

    <main>
        <div class="admin-container">
            <form action="add_book.php" method="post" enctype="multipart/form-data">
                <label for="title">Titre :</label>
                <input type="text" name="title" required>
                
                <label for="author">Auteur :</label>
                <input type="text" name="author" required>
                
                <label for="domain">Domaine :</label>
                <select id="domain" name="domain" required>
                    <option value="Littérature" <?php if (isset($book) && $book['domain'] === 'Littérature') echo 'selected'; ?>>Littérature</option>
                    <option value="Science-fiction" <?php if (isset($book) && $book['domain'] === 'Science-fiction') echo 'selected'; ?>>Science-fiction</option>
                    <option value="Policier" <?php if (isset($book) && $book['domain'] === 'Policier') echo 'selected'; ?>>Policier</option>
                    <option value="Fantastique" <?php if (isset($book) && $book['domain'] === 'Fantastique') echo 'selected'; ?>>Fantastique</option>
                    <option value="Biographie" <?php if (isset($book) && $book['domain'] === 'Biographie') echo 'selected'; ?>>Biographie</option>
                    <option value="Histoire" <?php if (isset($book) && $book['domain'] === 'Histoire') echo 'selected'; ?>>Histoire</option>
                    <option value="Science" <?php if (isset($book) && $book['domain'] === 'Science') echo 'selected'; ?>>Science</option>
                    <option value="Informatique" <?php if (isset($book) && $book['domain'] === 'Informatique') echo 'selected'; ?>>Informatique</option>
                    <option value="Romance" <?php if (isset($book) && $book['domain'] === 'Romance') echo 'selected'; ?>>Romance</option>
                    <option value="Cuisine" <?php if (isset($book) && $book['domain'] === 'Cuisine') echo 'selected'; ?>>Cuisine</option>
                </select>



                <label for="description">Description :</label>
                <textarea name="description" required></textarea>
                
                <label for="copies">Exemplaires disponibles :</label>
                <input type="number" name="copies" required>

             <!-- Pour le bouton d'image -->
                <label for="image">Image :</label>
                <div class="file-upload">
                    <input type="file" name="image" id="image">
                    <button class="upload-button" type="button">Choisir une image</button>
                    <span class="file-name">Aucun fichier sélectionné</span>
                </div>

                <!-- Pour le bouton de PDF -->
                <label for="pdf">Fichier PDF :</label>
                <div class="file-upload">
                    <input type="file" name="pdf" id="pdf">
                    <button class="upload-button" type="button">Choisir un fichier PDF</button>
                    <span class="file-name">Aucun fichier sélectionné</span>
                </div>


                <input type="submit" name="submit" value="Ajouter">
            </form>
        </div>
    </main>
</body>

<style>
    /* Style pour le formulaire d'ajout de livre */
.admin-container {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.admin-container h1 {
    text-align: center;
    margin-bottom: 20px;
}

.admin-container label {
    display: block;
    margin-bottom: 10px;
}

.admin-container input,
.admin-container select,
.admin-container textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.admin-container input[type="file"] {
    border: none;
    background-color: transparent;
}

.admin-container textarea {
    resize: vertical;
}

.admin-container input:focus,
.admin-container select:focus,
.admin-container textarea:focus {
    border-color: #0088cc;
    outline: none;
}

.admin-container input[type="submit"] {
    background-color: #0088cc;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.admin-container input[type="submit"]:hover {
    background-color: #006699;
}

.admin-container p {
    margin-top: 10px;
}

.error-message {
    color: red;
}

.success-message {
    color: green;
}

/* Styles pour le bouton de téléchargement de fichier */
.file-upload {
    position: relative;
}

.file-upload input[type="file"] {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    bottom: 12:
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.upload-button {
    background-color: #0088cc;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.upload-button:hover {
    background-color: #006699;
}

.file-name {
    margin-top: 5px;
    font-size: 14px;
    color: #555;
}

</style>
</html>
