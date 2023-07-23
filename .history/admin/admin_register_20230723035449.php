<!DOCTYPE html>
<html>
<head>
    <title>Inscription Administrateur</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <div class="register-form">
        <h2>Inscription Administrateur</h2>
        <?php
        // Inclure le fichier de fonctions
        require_once '../includes/functions.php';

        // Vérifier si le formulaire d'inscription a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $username = $_POST["username"];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

            // Inscrire le nouvel administrateur
            $result = registerAdmin($username, $password, $confirm_password);

            if ($result === true) {
                // Rediriger vers la page de connexion après une inscription réussie
                header("Location: admin_login.php");
                exit();
            } elseif ($result === false) {
                echo '<p class="error-message">Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.</p>';
            } elseif ($result === "existing_admin") {
                echo '<p class="error-message">Un administrateur avec ce nom d\'utilisateur existe déjà.</p>';
            } elseif ($result === "password_mismatch") {
                echo '<p class="error-message">Les mots de passe ne correspondent pas.</p>';
            }
        }
        ?>

        <form action="" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirmez le mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="S'inscrire">

            <p>Vous avez déjà un compte ? <a href="admin_login.php">Connectez-vous ici</a>.</p>
        </form>
    </div>
</body>
</html>
