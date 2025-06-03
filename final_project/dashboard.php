<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$recipes = $stmt->fetchAll();

$pageTitle = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Recipe Manager - <?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/style.css" />
</head>
<body>
    <h1>This is the Dashboard</h1>

    <link rel="stylesheet" href="assets/style.css" />

<nav>
    <a href="dashboard.php">Dashboard</a> |
    <a href="add_recipe.php">Add Recipe</a> |
    <a href="logout.php">Logout</a>
</nav>

<h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
<p>This is your dashboard. Here are your recipes:</p>

<?php if (count($recipes) === 0): ?>
    <p>You have no recipes yet. <a href="add_recipe.php">Add one now!</a></p>
<?php else: ?>
    <ul>
        <?php foreach ($recipes as $recipe): ?>
            <li>
                <strong><?php echo htmlspecialchars($recipe['title']); ?></strong><br>
                <a href="edit_recipe.php?id=<?php echo $recipe['id']; ?>">Edit</a> |
                <a href="delete_recipe.php?id=<?php echo $recipe['id']; ?>" onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

</body>
</html>
