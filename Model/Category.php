<?php

require(__DIR__ . '/../Config/init.php');

class Category extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('categories');
    }

    /** 
     * Method to get all categories from the database.
     */
    public function getAllCategories()
    {
        // Call database selectData
        $database = new Database();
        $result = $database->selectData($this->tableName, null);

        // Fetch all data and return
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Method to get a single category by ID from the database.
     */
    public function getCategoryById($id)
    {
        // Call database selectData with id
        $database = new Database();
        $result = $database->selectData($this->tableName, $id);

        // Fetch and return a single record
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Method to create a new category.
     */
    public function createCategory($data)
    {
        // Call database insertData with category data
        $database = new Database();
        return $database->insertData($this->tableName, $data);
    }

    /**
     * Method to update an existing category by ID.
     */
    public function updateCategory($id, $data)
    {
        // Call database updateData
        $database = new Database();
        return $database->updateData($this->tableName, $id, $data);
    }

    /**
     * Method to delete (soft delete) a category by ID.
     */
    public function deleteCategory($id)
    {
        // Call database deleteRecord
        $database = new Database();
        $database->deleteRecord($this->tableName, $id);
    }

    /**
     * Method to restore all soft-deleted categories.
     */
    public function restoreCategory()
    {
        // Call database restoreRecord
        $database = new Database();
        $database->restoreRecord($this->tableName);
    }
}
