<?php
// DB connection
$conn = new mysqli("localhost", "root", "", "userdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['age'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $age = (int) $_POST['age'];

    $conn->query("INSERT INTO users (name, age) VALUES ('$name', $age)");
}

// Toggle status
if (isset($_GET['toggle'])) {
    $id = (int) $_GET['toggle'];
    $result = $conn->query("SELECT status FROM users WHERE id = $id");
    if ($row = $result->fetch_assoc()) {
        $newStatus = $row['status'] == 1 ? 0 : 1;
        $conn->query("UPDATE users SET status = $newStatus WHERE id = $id");
    }
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Form</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        input[type="text"], input[type="number"] { padding: 5px; }
        table { border-collapse: collapse; margin-top: 20px; width: 50%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
    </style>
</head>
<body>

<h3>Add User</h3>
<form method="POST">
    Name: <input type="text" name="name" required>
    Age: <input type="number" name="age" required>
    <input type="submit" value="Submit">
</form>

<h3>Users List</h3>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Age</th><th>Status</th><th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM users");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['age']}</td>
            <td>{$row['status']}</td>
            <td><a href='?toggle={$row['id']}'>Toggle</a></td>
        </tr>";
    }
    ?>
</table>

</body>
</html>