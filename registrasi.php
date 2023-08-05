<?php

include "koneksi.php";

if (isset($_POST['register'])) {

    $namapetugas = filter_input(INPUT_POST, 'namapetugas', FILTER_SANITIZE_STRING);
    $namamaskapai = filter_input(INPUT_POST, 'namamaskapai', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'usernamemaskapai', FILTER_SANITIZE_STRING);
    $emailmaskapai = filter_input(INPUT_POST, 'emailmaskapai', FILTER_VALIDATE_EMAIL);
    $telpmaskapai = filter_input(INPUT_POST, 'telpmaskapai', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validate email and password
    if (!$emailmaskapai || !$password) {
        // Handle validation errors (e.g., show an error message to the user)
        // For password, you might want to ensure it meets your specific criteria (e.g., minimum length, complexity)
        // Avoid storing plain text passwords in the database, use password hashing (see next point)
        exit("Invalid email or password");
    }

    // Hash the password for security
    // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (namapetugas, namamaskapai, usernamemaskapai, emailmaskapai, telpmaskapai, password) 
            VALUES (:namapetugas, :namamaskapai, :username, :emailmaskapai, :telpmaskapai, :password)";
    $stmt = $conn->prepare($sql);

    // bind parameter ke query
    $stmt->bindParam(":namapetugas", $namapetugas);
    $stmt->bindParam(":namamaskapai", $namamaskapai);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":emailmaskapai", $emailmaskapai);
    $stmt->bindParam(":telpmaskapai", $telpmaskapai);
    $stmt->bindParam(":password", $password); // Store the hashed password in the database

    // eksekusi query untuk menyimpan ke database
    if ($stmt->execute()) {
        // Registration successful
        // Redirect to the login page or show a success message to the user
        echo 'Registrasi Valid';
        exit();
    } else {
        // Handle the case when the execution fails, e.g., show an error message to the user
        exit("Registration failed. Please try again later.");
    }
}
