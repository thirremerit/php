<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$recipe_id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE id = ? AND user_id = ?");
$stmt->execute([$recipe_id, $user_id]);
$recipe = $stmt->fetch();

if (!$recipe) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $ingredients = trim($_POST['ingredients']);
    $instructions = trim($_POST['instructions']);

    if ($title === '' || $ingredients === '' || $instructions === '') {
        $error = 'Please fill in all fields.';
    } else {
        $updateStmt = $pdo->prepare("UPDATE recipes SET title = ?, ingredients = ?, instructions = ? WHERE id = ? AND user_id = ?");
        $updateStmt->execute([$title, $ingredients, $instructions, $recipe_id, $user_id]);

        header('Location: dashboard.php');
        exit;
    }
}

$pageTitle = 'Edit Recipe';
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

<h2>Edit Recipe</h2>
<?php if ($error): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="post">
    <input type="text" name="title" placeholder="Recipe Title" value="<?php echo htmlspecialchars($recipe['title']); ?>" required><br><br>
    <textarea name="ingredients" placeholder="Ingredients" rows="5" cols="40" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea><br><br>
    <textarea name="instructions" placeholder="Instructions" rows="5" cols="40" required><?php echo htmlspecialchars($recipe['instructions']); ?></textarea><br><br>
    <button type="submit">Update Recipe</button>
</form>

<p><a href="dashboard.php">Back to Dashboard</a></p>
</body>
</html>
