<?php
require_once 'config.php';
///* CAPITAINE *////

// Fonction pour récupérer tous les livres de la base de données
function getAllBooks() {
    global $conn;

    $sql = "SELECT * FROM books";
    $result = mysqli_query($conn, $sql);

    $books = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $books[] = $row;
    }

    return $books;
}


//**END CAPITAINE */

// Fonction pour vérifier les informations de connexion de l'utilisateur
function checkLogin($username, $password) {
    global $conn;
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $user_id, $hashed_password);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Vérifier si le mot de passe haché correspond au mot de passe saisi
    if (password_verify($password, $hashed_password)) {
        return $user_id;
    } else {
        return false;
    }
}

// Fonction pour ajouter un nouvel utilisateur
function addUser($username, $hashed_password) {
    global $conn;
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return false;
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashed_password);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    return $result;
}

// Fonction pour récupérer les informations de l'utilisateur par son ID
function getUserById($user_id) {
    global $conn;
    $sql = "SELECT id, username FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $username);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$id) {
        return null;
    }

    return ['id' => $id, 'username' => $username];
}

// Fonction pour récupérer les informations de l'utilisateur par son nom d'utilisateur
function getUserByUsername($username) {
    global $conn;
    $sql = "SELECT id, username FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return null;
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $username);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$id) {
        return null;
    }

    return ['id' => $id, 'username' => $username];
}


// Fonction pour récupérer les livres empruntés par un utilisateur par son ID
function getBorrowedBooksByUserId($user_id) {
    global $conn;
    
    $sql = "SELECT books.title, books.author, books.borrow_date FROM borrowed_books JOIN books ON borrowed_books.book_id = books.id WHERE borrowed_books.user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if (!$stmt) {
        return array();
    }
    
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $borrowedBooks = array();
        while ($book = mysqli_fetch_assoc($result)) {
            $borrowedBooks[] = $book;
        }
        return $borrowedBooks;
    } else {
        return array();
    }
}

// Fonction pour récupérer les informations d'un livre à partir de son identifiant
function getBookById($bookId) {
    global $conn;

    // Préparer la requête SQL pour récupérer les informations du livre
    $sql = "SELECT * FROM books WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Vérifier si la préparation de la requête a réussi
    if (!$stmt) {
        return null; // Une erreur s'est produite lors de la préparation de la requête
    }

    mysqli_stmt_bind_param($stmt, "i", $bookId);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        // Récupérer le résultat de la requête
        $result = mysqli_stmt_get_result($stmt);

        // Vérifier si un livre a été trouvé
        if (mysqli_num_rows($result) === 1) {
            // Récupérer les informations du livre
            $book = mysqli_fetch_assoc($result);
            return $book; // Retourner les informations du livre
        } else {
            return null; // Aucun livre trouvé avec l'identifiant donné
        }
    } else {
        return null; // Une erreur s'est produite lors de l'exécution de la requête
    }
}
