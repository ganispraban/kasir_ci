<?php

namespace App\Controllers;

use App\Models\ProdukModel;

class Produk extends BaseController
{
    protected $produkModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'produk' => $this->produkModel->findAll()
        ];

        return view('produk/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Produk'
        ];

        return view('produk/create', $data);
    }

    public function store()
    {
        // Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer'
        ])) {
            return redirect()->back()->withInput();
        }

        // Simpan data produk
        $this->produkModel->save([
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/data_produk')->with('message', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = $this->produkModel->find($id);
        
        if (!$produk) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Produk dengan ID $id tidak ditemukan");
        }

        $data = [
            'title' => 'Edit Produk',
            'produk' => $produk
        ];

        return view('produk/edit', $data);
    }

    public function update($id)
    {
        // Validasi input
        if (!$this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer'
        ])) {
            return redirect()->back()->withInput();
        }

        // Update data produk
        $this->produkModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'harga' => $this->request->getPost('harga'),
            'stok' => $this->request->getPost('stok')
        ]);

        return redirect()->to('/data_produk')->with('message', 'Produk berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->produkModel->delete($id);
        return redirect()->to('/data_produk')->with('message', 'Produk berhasil dihapus');
    }
}
