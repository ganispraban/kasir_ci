<?php namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_pembeli', 
        'produk_id', 
        'produk_nama', 
        'jumlah', 
        'total', 
        'diskon', 
        'nilai_diskon', 
        'uang_dibayar', 
        'kembalian',
        'status_pembayaran' 
    ];
    
    

    protected $useTimestamps = false;

    protected $validationRules = [
        'produk_id' => 'required|integer',
        'jumlah'    => 'required|integer',
        'total'     => 'required|decimal'
    ];
}
