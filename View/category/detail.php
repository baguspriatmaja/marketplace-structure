<?php
include(__DIR__ . '/../../Config/init.php');

$id = $_GET['id'];

$categoryController = new CategoryController();
$categoryDetails = null;

if ($id) {
    $categoryDetails = $categoryController->show($id);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .details-table {
            max-width: 400px;
            margin: auto;
            margin-top: 20px;
        }

        .details-table th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 8px;
        }

        .details-table td {
            padding: 8px;
        }
    </style>
</head>

<body>
    <h1 class="text-center">Category Details</h1>

    <?php if ($categoryDetails) : ?>
        <table class="table details-table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($categoryDetails['id']); ?></td>
            </tr>
            <tr>
                <th>Category Name</th>
                <td><?php echo htmlspecialchars($categoryDetails['category_name']); ?></td>
            </tr>
        </table>
    <?php else : ?>
        <div class="alert alert-danger text-center">
            Category not found or invalid ID.
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="../../categories.php" class="btn btn-secondary">Back to Home</a>
    </div>
</body>

</html>
