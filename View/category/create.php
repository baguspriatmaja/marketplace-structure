<?php
require(__DIR__ . '/../../Config/init.php');


$categoryController = new CategoryController();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi category_name
    if (empty($_POST["category_name"])) {
        $errors['category_name'] = "Category Name is required";
    } else {
        $category_name = $_POST["category_name"];
    }

    // Jika tidak ada error validasi, buat kategori baru
    if (empty($errors)) {
        $data = [
            'category_name' => $category_name
        ];

        if ($categoryController->create($data)) {
            echo "<script>alert('Category added successfully!');</script>";
            header("Location: ../../categories.php");
            exit;
        } else {
            echo "<script>alert('Failed to add category!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: auto;
        }

        label {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Create Category</h1>
    <form method="POST" action="">
        <!-- Category Name -->
        <div class="mb-3">
            <label for="category_name" class="form-label">Category Name</label>
            <input type="text" class="form-control <?php echo isset($errors['category_name']) ? 'is-invalid' : ''; ?>" id="category_name" name="category_name" value="<?php echo isset($category_name) ? htmlspecialchars($category_name) : ''; ?>">
            <?php if (isset($errors['category_name'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['category_name']; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Category</button>
        <a href="../../categories.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>

</html>
