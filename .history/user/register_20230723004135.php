<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si l'utilisateur est déjà connecté
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier si les mots de passe correspondent
    if ($password !== $confirm_password) {
        $error_message = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si le nom d'utilisateur est disponible
        $existing_user = getUserByUsername($username);
        if ($existing_user) {
            $error_message = "Ce nom d'utilisateur est déjà utilisé. Veuillez en choisir un autre.";
        } else {
            // Hasher le mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Ajouter le nouvel utilisateur dans la base de données
            if (addUser($username, $hashed_password)) {
                // Rediriger vers la page de connexion avec un message de succès
                header('Location: login.php?success=1');
                exit();
            } else {
                $error_message = "Une erreur s'est produite lors de l'inscription. Veuillez réessayer.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="register-container">
        <h2>Inscription</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="S'inscrire">
            </div>
        </form>
        <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous</a></p>
    </div>
</body>
</html>
