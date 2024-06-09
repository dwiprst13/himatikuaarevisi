<?php

// inisialisasi server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "himatikdb";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi apakh berhasil atau tidak
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
