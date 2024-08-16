<?php namespace App\Models;

use CodeIgniter\Model;

class TransaksiDetailModel extends Model
{
    protected $table = 'transaksi_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = ['transaksi_id', 'produk_nama', 'jumlah', 'harga'];

    // Optionally, set validation rules if needed
    protected $validationRules = [
        'transaksi_id' => 'required|integer',
        'produk_id' => 'required|integer',
        'produk_nama' => 'required|string',
        'jumlah' => 'required|integer',
        'harga' => 'required|decimal'
    ];

    protected $validationMessages = [
        'transaksi_id' => [
            'required' => 'Transaksi ID is required',
            'integer' => 'Transaksi ID must be an integer'
        ],
        'produk_id' => [
            'required' => 'Produk ID is required',
            'integer' => 'Produk ID must be an integer'
        ],
        'produk_nama' => [
            'required' => 'Produk name is required',
            'string' => 'Produk name must be a string'
        ],
        'jumlah' => [
            'required' => 'Jumlah is required',
            'integer' => 'Jumlah must be an integer'
        ],
        'harga' => [
            'required' => 'Harga is required',
            'decimal' => 'Harga must be a decimal number'
        ]
    ];
}
