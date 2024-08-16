<?php namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama', 'harga', 'stok'];

    protected $useTimestamps = false;

    // Pastikan menggunakan update dengan array yang sesuai
    public function updateProduk($id, $data)
    {
        // Pastikan $data adalah array yang benar
        return $this->update($id, $data);
    }
}
