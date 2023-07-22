<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

// Vérifier si l'utilisateur est déjà connecté
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Vérifier les champs du formulaire
    if (empty($username) || empty($password)) {
        $error_message = 'Veuillez remplir tous les champs.';
    } else {
        // Vérifier les informations de connexion dans la base de données
        $user = getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            // Authentification réussie, enregistrer l'utilisateur dans la session
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit();
        } else {
            // Mauvais nom d'utilisateur ou mot de passe
            $error_message = 'Nom d\'utilisateur ou mot de passe incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
    <div class="login-form">
        <h2>Connexion</h2>
        <?php if (isset($error_message)) : ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Se connecter">
            </div>
        </form>
        <p>Pas encore inscrit ? <a href="register.php">Inscrivez-vous ici</a>.</p>
    </div>
</body>
</html>
