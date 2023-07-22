<?php
<?php
require_once 'config.php';

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

