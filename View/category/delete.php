<?php
require_once(__DIR__ . '/../../Config/init.php');

$categoryController = new CategoryController();
$categories = $categoryController->index(); 
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryId = $_POST['category_id'] ?? null;

    if ($categoryId) {
        // Hapus kategori
        if ($categoryController->destroy($categoryId)) {
            $message = "Category deleted successfully!";
            // Refresh data kategori
            $categories = $categoryController->index();
        } else {
            $message = "Failed to delete category.";
        }
    } else {
        $message = "Please select a category to delete.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .message {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-top: 20px;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Delete Category</h1>

    <?php if ($message) : ?>
        <div class="alert <?php echo strpos($message, 'successfully') ? 'alert-success' : 'alert-danger'; ?> message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)) : ?>
                    <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo htmlspecialchars($category['id']); ?></td>
                            <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                            <td><?php echo htmlspecialchars($category['description']); ?></td>
                            <td>
                                <button type="submit" name="category_id" value="<?php echo htmlspecialchars($category['id']); ?>" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="text-center">No categories available.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </form>

    <a href="../index.php" class="btn btn-secondary mt-3">Back to Home</a>
</body>

</html>
