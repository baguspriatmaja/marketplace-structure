<?php
require_once(__DIR__ . '/Config/init.php');

$categoryController = new CategoryController();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'] ?? null;

    if ($categoryId && $categoryController->destroy($categoryId)) {
        $message = "Category deleted successfully!";
    } else {
        $message = "Category deleted successfully!";
    }
}

$categories = $categoryController->index();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["restoreCategoryId"])) {
    $categoryController->restore($_POST["restoreCategoryId"]);
    header("Location: categories.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Categories</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h1 class="text-center">All Categories</h1>

        <?php if ($message) : ?>
            <div class="alert <?php echo strpos($message, 'successfully') ? 'alert-success' : 'alert-danger'; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="mb-4 justify-content-between d-flex">
            <a href="index.php" class="btn btn-secondary">Back to Products</a>
            <div>
                <a href="View/category/create.php" class="btn btn-primary">Add Categories</a>
            </div>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $index => $category) : ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                        <td>
                            <a href="View/category/detail.php?id=<?php echo $category['id']; ?>" class="btn btn-success btn-sm">Detail</a>
                            <a href="View/category/update.php?id=<?php echo $category['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form method="POST" action="" class="d-inline">
                                <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- Form to restore a deleted category -->
    <form method="POST">
            <input type="hidden" name="restoreCategoryId" value="<?php echo $category['id']; ?>">
            <button type="submit" class="btn btn-secondary" style="margin-left:100px">Restore</button>
    </form>
</body>

</html>
