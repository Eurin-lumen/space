<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="user/user_style.css">
</head>
<body>
    <!-- En-tête (Header) -->
    <header>
        <div class="header-content">
            <h1>LivreLand</h1>
            <p>Bienvenue dans notre bibliothèque en ligne</p>
        </div>
    </header>

    <!-- Section de recherche -->
    <section class="search-section">
        <div class="search-container">
            <h2>Rechercher un livre</h2>
            <form action="#" method="get">
                <input type="text" name="search" placeholder="Entrez un titre, un auteur...">
                <button type="submit">Rechercher</button>
            </form>
        </div>
    </section>

    <!-- Bannière de promotion -->
    <section class="promo-banner">
        <div class="promo-content">
            <h2>Promotion spéciale</h2>
            <p>Profitez de 20% de réduction sur tous les livres jusqu'au 31 juillet !</p>
            <a href="#" class="promo-button">Voir les livres</a>
        </div>
    </section>

    <!-- Catégories de livres -->
    <section class="categories-section">
        <div class="categories-container">
            <h2>Catégories de livres</h2>
            <div class="categories-grid">
                <!-- Catégories proposées dans le projet -->
                <div class="category">
                    <img src="images/litterature.jpg" alt="Littérature">
                    <h3>Littérature</h3>
                </div>
                <div class="category">
                    <img src="images/science_fiction.jpg" alt="Science-fiction">
                    <h3>Science-fiction</h3>
                </div>
                <div class="category">
                    <img src="images/policier.jpg" alt="Policier">
                    <h3>Policier</h3>
                </div>
                <!-- Ajouter d'autres catégories ici -->
            </div>
        </div>
    </section>

    <!-- Inscription / Connexion -->
    <section class="login-section">
        <div class="login-container">
            <h2>Inscription / Connexion</h2>
            <div class="login-form">
                <!-- Formulaire d'inscription / connexion -->
            </div>
        </div>
    </section>

    <!-- Pied de page -->
    <footer>
        <div class="footer-content">
            <p>Tous droits réservés © LivreLand 2023</p>
        </div>
    </footer>

</body>
</html>
