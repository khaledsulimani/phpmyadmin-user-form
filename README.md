# 👥 User Management Web App

A simple and clean web application to manage users using *PHP, **MySQL, and **XAMPP*.  
Add users ➕, view them 👁, and toggle their status 🔁 — all from a lightweight interface.

---

## ✨ Features

- 📝 *Add Users*: Input name and age to save a new user in the database.
- 📋 *View Records*: Displays a table of users with ID, Name, Age, and Status.
- 🔄 *Toggle Status*: Switch between 0 (inactive) and 1 (active) with a click.
- ⚡ *Instant Refresh*: Updates appear immediately after toggling.

---

## ⚙ Requirements

- [XAMPP](https://www.apachefriends.org/index.html) 🧰 (Apache + MySQL)
- PHP 💻
- MySQL 🗄
- Web Browser 🌐

---

## 🚀 Getting Started

### 1. Install XAMPP

1. Download and install XAMPP for your OS.
2. Open *XAMPP Control Panel*.
3. Start both *Apache* and *MySQL* services.

### 2. Set Up Database via phpMyAdmin

1. Open http://localhost/phpmyadmin 🌐
2. Create a new database called: userdb
3. Run this SQL to create the table:

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    age INT,
    status TINYINT(1) DEFAULT 0
);
```
---

```php
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
```
---

## 📸 Project Results

Here are some real-world shots of the project in action:

### xampp panel: ![صورة واتساب بتاريخ 1447-01-22 في 07 27 27_1d24e7a4](https://github.com/user-attachments/assets/dd39ab5d-edd0-4f2a-b7e5-15bbb62e295e)

### sql database: ![صورة واتساب بتاريخ 1447-01-22 في 07 35 32_d046d3c3](https://github.com/user-attachments/assets/03cd5e19-39a1-4fff-b48c-4363dd55e5e8)

### website frontend: ![صورة واتساب بتاريخ 1447-01-22 في 07 33 14_8640ad4e](https://github.com/user-attachments/assets/52963fc7-079b-496f-b9fa-5ff33b98392b)

### backend for website: ![صورة واتساب بتاريخ 1447-01-22 في 07 36 07_c6775a24](https://github.com/user-attachments/assets/da7bdd61-eb1c-4132-9777-c5b820e5848c)

---

## 🧑‍💻 Author

- **khaled mahmoud sulaimani** – [@khaledsulimani](https://github.com/khaledsulimani)

