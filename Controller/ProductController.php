<?php
require(__DIR__ . '/../Config/init.php');

class ProductController
{
    private $productModel;

    public function __construct()
    {
        $this->productModel = new Product();
    }

    /**
     * Index: This method allows users to view all products in the database.
     */
    public function index()
    {
        $products = $this->productModel->getAllProducts();
        return $products;
    }

    /**
     * Create: This method allows users to create a new product.
     * @param array $data - Associative array containing product details.
     * @return bool - True if product is created successfully, false otherwise.
     */
    public function create($data)
    {
        return $this->productModel->createProduct($data);
    }

    /**
     * Show: This method is used to show one specific product by its id.
     * @param int $id - The ID of the product that needs to be shown.
     * @return array $product - Associative array containing information about the selected product.
     */
    public function show($id)
    {
        // Fetch the product by ID from the model
        $product = $this->productModel->getProductById($id);

        // Return the product data
        return $product;
    }

    /**
     * Update: This method allows users to update an existing product by ID.
     * @param int $id - The ID of the product to be updated.
     * @param array $data - Associative array containing updated product details.
     * @return bool - True if product is updated successfully, false otherwise.
     */
    public function update($id, $data)
    {
        // Call model's updateProduct method and return the result
        return $this->productModel->updateProduct($id, $data);
    }

    /**
     * Destroy: This method is used to soft-delete a product by ID.
     * @param int $id - The ID of the product to be deleted.
     */
    public function destroy($id)
    {
        // Call model's deleteProduct method
        $this->productModel->deleteProduct($id);
    }

    /**
     * Restore: This method is used to restore all soft-deleted products.
     */
    public function restore()
    {
        // Call model's restoreProduct method
        $this->productModel->restoreProduct();
    }
}
