<?php
include 'db.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>User added successfully!</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
  <h2 class="mb-4">Add New User</h2>
  <form method="POST" action="index.php" class="mb-4">
    <div class="mb-3">
      <label for="name" class="form-label">Name:</label>
      <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email:</label>
      <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add User</button>
  </form>
  <hr>
<h3>Registered Users</h3>

<?php
$result = $conn->query("SELECT * FROM users");
if ($result->num_rows > 0) {
    echo "<table class='table table-bordered'>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Actions</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>
                  <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                  <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}
?>

</body>
</html>
