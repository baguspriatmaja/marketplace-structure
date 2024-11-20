<?php
include(__DIR__ . '/../../Config/init.php');

$id = $_GET['id'];

$productController = new ProductController();

$productDetails = $productController->show($id);

// Check if the product exists
if (!$productDetails) {
    echo "<script>alert('Product not found!'); window.location.href='../../index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            margin-top: 20px;
        }
        table td,
        table th {
            padding: 8px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        table th {
            background-color: #f2f2f2;
        }
        a {
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <h2>Product Details</h2>
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($productDetails['id']); ?></td>
        </tr>
        <tr>
            <th>Product Name</th>
            <td><?php echo htmlspecialchars($productDetails['product_name']); ?></td>
        </tr>
        <tr>
            <th>Price</th>
            <td><?php echo htmlspecialchars($productDetails['price']); ?></td>
        </tr>
        <tr>
            <th>Stock</th>
            <td><?php echo htmlspecialchars($productDetails['stock']); ?></td>
        </tr>
    </table>
    <a href="../../index.php" class="btn btn-secondary">Back to Home</a>
</body>

</html>
