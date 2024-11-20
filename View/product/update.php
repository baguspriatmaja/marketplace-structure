<?php
include(__DIR__ . '/../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();
$categoryController = new CategoryController();

$productDetails = $productController->show($id);
$category_id = $productDetails['category_id'] ?? '';

if (!$productDetails) {
    echo "<script>alert('Product not found!'); window.location.href='../index.php';</script>";
    exit;
}

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi product_name
    if (empty($_POST["product_name"])) {
        $errors['product_name'] = "Product Name is required";
    } else {
        $product_name = $_POST["product_name"];
    }

    // Validate category_id
    if (empty($_POST["category_id"])) {
        $errors['category_id'] = "Category is required";
    } else {
        $category_id = $_POST["category_id"];
    }

    // Validasi price
    if (empty($_POST["price"])) {
        $errors['price'] = "Price is required";
    } else if (!is_numeric($_POST["price"])) {
        $errors['price'] = "Price must be a number";
    } else if (floatval($_POST["price"]) <= 0) {
        $errors['price'] = "Price should be greater than zero";
    } else {
        $price = $_POST["price"];
    }

    // Validasi stock
    if (!isset($_POST["stock"]) || empty($_POST["stock"])) {
        $errors['stock'] = "stock is required";
    } else if (!is_numeric($_POST["stock"])) {
        $errors['stock'] = "stock must be a valid number";
    } else if ((int)$_POST["stock"] < 0) {
        $errors['stock'] = "stock cannot be negative";
    } else if ($_POST["stock"] != (string)(int)$_POST["stock"]) {
        $errors['stock'] = "stock must be an integer";
    } else {
        $stock = $_POST["stock"];
    }

    $description = $_POST['description'];

    if (empty($errors)) {
        $data = [
            'product_name' => $product_name,
            'category_id' => $category_id,
            'price' => $price,
            'stock' => $stock
        ];

        if ($productController->update($id, $data)) {
            header("Location: ../../index.php");
            exit;
        } else {
            echo "<script>alert('Failed to update product!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Update Product</title>
    <!-- Include Bootstrap CSS -->
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
    <h1 class="text-center">Update Product</h1>
    <form method="POST" action="">

        <!-- Product Name -->
        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control <?php echo isset($errors['product_name']) ? 'is-invalid' : ''; ?>" id="product_name" name="product_name" value="<?php echo isset($product_name) ? htmlspecialchars($product_name) : htmlspecialchars($productDetails['product_name']); ?>">
            <?php if (isset($errors['product_name'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['product_name']; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Category -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-control" id="category_id">
                <option value="">Select Category</option>
                <?php
                // Retrieve categories
                $categories = $categoryController->index();
                foreach ($categories as $category):
                ?>
                    <option value="<?php echo htmlspecialchars($category['id']); ?>" <?php echo isset($category_id) && $category_id == $category['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($category['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (isset($errors['category_id'])): ?>
                <div class="text-danger"><?php echo $errors['category_id']; ?></div>
            <?php endif; ?>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control <?php echo isset($errors['price']) ? 'is-invalid' : ''; ?>" id="price" name="price" value="<?php echo isset($price) ? htmlspecialchars($price) : htmlspecialchars($productDetails['price']); ?>">
            <?php if (isset($errors['price'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['price']; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- stock -->
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="text" class="form-control <?php echo isset($errors['stock']) ? 'is-invalid' : ''; ?>" id="stock" name="stock" value="<?php echo isset($stock) ? htmlspecialchars($stock) : htmlspecialchars($productDetails['stock']); ?>">
            <?php if (isset($errors['stock'])) : ?>
                <div class="invalid-feedback">
                    <?php echo $errors['stock']; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Product</button>
        <a href="../../index.php" class="btn btn-secondary">Cancel</a>
    </form>
</body>

</html>
