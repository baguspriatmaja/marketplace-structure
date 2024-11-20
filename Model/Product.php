<?php

require(__DIR__ . '/../Config/init.php');

class Product extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('products');
    }

    /**
     * Method to get all products from the database and return the result as an associative array.
     */
    public function getAllProducts()
    {
        $query = "SELECT products.*, categories.category_name 
                  FROM {$this->tableName} 
                  INNER JOIN categories ON products.category_id = categories.id 
                  WHERE products.isDeleted = 0";
        $stmt = $this->db->getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Method to get a single product by ID from the database.
     */
    public function getProductById($id)
    {
        // Call database selectData with id
        $database = new Database();
        $result = $database->selectData($this->tableName, $id);
        
        // Fetch and return a single record
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Method to create a new product.
     */
    public function createProduct($data)
    {
        // Call database insertData with category data
        $database = new Database();
        return $database->insertData($this->tableName, $data);
    }

    /**
     * Method to update an existing product by ID.
     */
    public function updateProduct($id, $data)
    {
        // Call database updateData
        $database = new Database();
        return $database->updateData($this->tableName, $id, $data);
    }

    /**
     * Method to delete (soft delete) a product by ID.
     */
    public function deleteProduct($id)
    {
        // Call database deleteRecord
        $database = new Database();
        $database->deleteRecord($this->tableName, $id);
    }

    /**
     * Method to restore all soft-deleted products.
     */
    public function restoreProduct()
    {
        // Call database restoreRecord
        $database = new Database();
        $database->restoreRecord($this->tableName);
    }
}
