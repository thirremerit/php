<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO recipes (user_id, title, ingredients, instructions) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $ingredients, $instructions]);

    header('Location: dashboard.php');
    exit;
}

$pageTitle = 'Add Recipe';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Recipe Manager - <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="add_recipe.php">Add Recipe</a> |
    <a href="logout.php">Logout</a>
</nav>

<h2>Add New Recipe</h2>
<form method="post">
    <input type="text" name="title" placeholder="Recipe Title" required><br><br>
    <textarea name="ingredients" placeholder="Ingredients" required rows="5" cols="40"></textarea><br><br>
    <textarea name="instructions" placeholder="Instructions" required rows="5" cols="40"></textarea><br><br>
    <button type="submit">Add Recipe</button>
</form>
<p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
