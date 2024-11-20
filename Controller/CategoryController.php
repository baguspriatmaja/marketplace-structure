<?php
require(__DIR__ . '/../Config/init.php');

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    /**
     * Menampilkan semua kategori.
     */
    public function index()
    {
        return $this->categoryModel->getAllCategories();
    }

    /**
     * Membuat kategori baru.
     * @param array $data - Data kategori.
     * @return bool - True jika berhasil, False jika gagal.
     */
    public function create($data)
    {
        return $this->categoryModel->createCategory($data);
    }

    /**
     * Menampilkan kategori berdasarkan ID.
     * @param int $id - ID kategori.
     */
    public function show($id)
    {
        return $this->categoryModel->getCategoryById($id);
    }

    /**
     * Memperbarui kategori berdasarkan ID.
     * @param int $id - ID kategori.
     * @param array $data - Data baru kategori.
     */
    public function update($id, $data)
    {
        return $this->categoryModel->updateCategory($id, $data);
    }

    /**
     * Menghapus kategori (soft delete).
     * @param int $id - ID kategori.
     */
    public function destroy($id)
    {
        $this->categoryModel->deleteCategory($id);
    }

    /**
     * Memulihkan kategori yang dihapus.
     */
    public function restore()
    {
        $this->categoryModel->restoreCategory();
    }
}
