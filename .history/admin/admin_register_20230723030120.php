<!DOCTYPE html>
<html>
<head>
    <title>Inscription Administrateur</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="admin/admin_style.css">
</head>
<body>
    <?php include 'admin/admin_nav.php'; ?>

    <div class="register-form">
        <h2>Inscription Administrateur</h2>
        <?php
        // Inclure le fichier de fonctions
        require_once 'includes/functions.php';

        // Vérifier si le formulaire d'inscription a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Vérifier si l'administrateur existe déjà
            $existingAdmin = getAdminByUsername($username);

            if ($existingAdmin) {
                echo '<p class="error-message">Un administrateur avec ce nom d\'utilisateur existe déjà.</p>';
            } else {
                // Inscrire le nouvel administrateur
                if (registerAdmin($username, $password)) {
                    // Rediriger vers la page de connexion
                    header("Location: admin_login.php");
                    exit();
                } else {
                    echo '<p class="error-message">Une erreur s\'est produite lors de l\'inscription. Veuillez réessayer.</p>';
                }
            }
        }
        ?>

        <form action="" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="S'inscrire">

            <p>Vous avez déjà un compte ? <a href="admin_login.php">Connectez-vous ici</a>.</p>
        </form>
    </div>
</body>
</html>
