<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $getUser = $conn->query("SELECT * FROM users WHERE id = $id");
    $row = $getUser->fetch_assoc();
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET name='$name', email='$email' WHERE id = $id";
    if ($conn->query($sql)) {
        header("Location: index.php");
    } else {
        echo "Update failed: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2>Edit User</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Name:</label>
      <input type="text" name="name" value
