<?php

function registerUser($username, $password) {
    global $conn;

    // Vérifier si l'utilisateur existe déjà dans la base de données
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Vérifier si un enregistrement correspondant existe déjà
    if (mysqli_stmt_num_rows($stmt) > 0) {
        return false; // L'utilisateur existe déjà
    }

    // Hacher le mot de passe avant de l'insérer dans la base de données
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insérer l'utilisateur dans la base de données
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $username, $hashedPassword);

    // Exécuter la requête
    if (mysqli_stmt_execute($stmt)) {
        return true; // L'utilisateur a été enregistré avec succès
    } else {
        return false; // Une erreur s'est produite lors de l'enregistrement de l'utilisateur
    }
}
