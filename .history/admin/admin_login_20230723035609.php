<!DOCTYPE html>
<html>
<head>
    <title>Connexion Administrateur</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
    <?php include 'admin_nav.php'; ?>

    <div class="login-form">
        <h2>Connexion Administrateur</h2>
        <?php
        // Inclure le fichier de fonctions
        require_once '../includes/functions.php';

        // Vérifier si l'administrateur est déjà connecté
        if (isAdminLoggedIn()) {
            header("Location: admin_dashboard.php");
            exit();
        }

        // Vérifier si le formulaire de connexion a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $username = $_POST["username"];
            $password = $_POST["password"];

            // Connecter l'administrateur
            $result = adminLogin($username, $password);

            if ($result === true) {
                // Rediriger vers le tableau de bord de l'administrateur après une connexion réussie
                header("Location: admin_dashboard.php");
                exit();
            } elseif ($result === false) {
                echo '<p class="error-message">Nom d\'utilisateur ou mot de passe incorrect.</p>';
            }
        }
        ?>

        <form action="" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
