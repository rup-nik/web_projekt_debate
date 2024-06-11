<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: index.php");
    exit();
}

include '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $summary = $_POST['summary'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    $image = $_FILES['image'];
    $imagePath = '../uploads/' . basename($image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);

    $sql = "INSERT INTO posts (title, summary, content, image_url, category, author, created_at) VALUES (?, ?, ?, ?, ?, 'Admin', NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $title, $summary, $content, $imagePath, $category);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
