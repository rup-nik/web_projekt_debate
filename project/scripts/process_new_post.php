<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $naslov = $_POST['naslov'];
    $kratki_sadrzaj = $_POST['kratki_sadrzaj'];
    $tekst = $_POST['tekst'];
    $slika = $_POST['slika'];
    $kategorija = $_POST['kategorija'];
    $author = $_SESSION['admin_id'];
    
    if (filter_var($slika, FILTER_VALIDATE_URL) === false) {
        echo "Invalid URL format for image.";
        exit();
    }
    
    $stmt = $conn->prepare("INSERT INTO posts (title, author, category, image_url, content, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    if ($stmt === false) {
        echo "Error preparing statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("sisss", $naslov, $author, $kategorija, $slika, $tekst);
    
    if ($stmt->execute()) {
        echo "New post created successfully";
        header("Location: ../index.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
