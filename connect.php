<?php
    $servername = "db_alaskokon"; // Gunakan nama servicenya di Coolify
    $username = "webdesa_user";   // Sesuai field "Normal User"
    $password = "user12345";      // Sesuai field "Normal User Password"
    $dbname = "desa";             // Sesuai field "Initial Database"

    // Membuat koneksi ke database MySQL
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
?
