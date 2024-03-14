<?php
// File: src/model/loginmodel.php

function authenticateUser($pdo, $username, $password) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && md5($password) === $user['password']) {
        return $user;
    }
    
    return false;
}
