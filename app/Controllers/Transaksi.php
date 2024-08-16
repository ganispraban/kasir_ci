<?php namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\TransaksiDetailModel;
use App\Models\ProdukModel;

class Transaksi extends BaseController
{
    public function index()
    {
        $model = new TransaksiModel();
        $data['transaksi'] = $model->findAll();
        return view('transaksi/index', $data);
    }

    public function create()
    {
        $produkModel = new ProdukModel();
        $data['produk'] = $produkModel->findAll();

        return view('transaksi/create', $data);
    }

    public function store()
    {
        $produkModel = new ProdukModel();
        $transaksiModel = new TransaksiModel();
        $transaksiDetailModel = new TransaksiDetailModel();
        
        $produkIds = $this->request->getPost('produk_id');
        $jumlahs = $this->request->getPost('jumlah');
        
        $transaksiDetails = [];
        $totalSebelumDiskon = 0;

        for ($i = 0; $i < count($produkIds); $i++) {
            $produkId = $produkIds[$i];
            $jumlah = $jumlahs[$i];
            $produk = $produkModel->find($produkId);

            if ($produk['stok'] < $jumlah) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi.');
            }

            $totalSebelumDiskon += $produk['harga'] * $jumlah;
            $transaksiDetails[] = [
                'produk_id' => $produkId,
                'produk_nama' => $produk['nama'],
                'jumlah' => $jumlah,
                'harga' => $produk['harga'],
            ];
        }

        $transaksiId = $transaksiModel->insert([
            'nama_pembeli' => $this->request->getPost('nama_pembeli'),
            'total' => 0, // Placeholder
            'diskon' => 0, // Placeholder
            'nilai_diskon' => 0, // Placeholder
            'uang_dibayar' => 0, // Placeholder
            'kembalian' => 0, // Placeholder
            'status_pembayaran' => 'Belum Dibayar'
        ]);

        foreach ($transaksiDetails as $detail) {
            $transaksiDetailModel->insert([
                'transaksi_id' => $transaksiId,
                'produk_id' => $detail['produk_id'],
                'produk_nama' => $detail['produk_nama'],
                'jumlah' => $detail['jumlah'],
                'harga' => $detail['harga']
            ]);
        }

        return redirect()->to('/transaksi/bayar/' . $transaksiId)->with('success', 'Transaksi berhasil disimpan. Silakan bayar untuk mengupdate data.');
    }

    public function edit($id)
    {
        $transaksiModel = new TransaksiModel();
        $produkModel = new ProdukModel();
        
        $data['transaksi'] = $transaksiModel->find($id);
        $data['produk'] = $produkModel->findAll();
        
        return view('transaksi/edit', $data);
    }

    public function update($id)
    {
        // Implement update logic if needed
    }

    public function delete($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksiModel->delete($id);

        return redirect()->to('/data_transaksi')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function bayar($id)
    {
        $transaksiModel = new TransaksiModel();
        $transaksiDetailModel = new TransaksiDetailModel();
        
        $data['transaksi'] = $transaksiModel->find($id);
        $data['details'] = $transaksiDetailModel->where('transaksi_id', $id)->findAll();
    
        return view('transaksi/pay', $data);
    }
    

    public function processPayment($id)
    {
        $transaksiModel = new TransaksiModel();
        $produkModel = new ProdukModel();
        $transaksiDetailModel = new TransaksiDetailModel();
    
        $transaksi = $transaksiModel->find($id);
        $details = $transaksiDetailModel->where('transaksi_id', $id)->findAll();
    
        $diskon = $this->request->getPost('diskon');
        $uangDibayar = $this->request->getPost('bayar');
        $total = $this->request->getPost('total');
        $kembalian = $uangDibayar - $total;
    
        // Calculate discount
        $diskonValue = $total * ($diskon / 100);
        $total -= $diskonValue;
    
        if ($uangDibayar >= $total) {
            // Update status pembayaran dan data transaksi
            $transaksiModel->update($id, [
                'diskon' => $diskon,
                'nilai_diskon' => $diskonValue,
                'uang_dibayar' => $uangDibayar,
                'kembalian' => $kembalian,
                'status_pembayaran' => 'Lunas',
            ]);
    
            // Kurangi stok produk berdasarkan detail transaksi
            foreach ($details as $detail) {
                $produk = $produkModel->find($detail['produk_id']);
                $newStok = $produk['stok'] - $detail['jumlah'];
                $produkModel->update($detail['produk_id'], ['stok' => $newStok]);
            }
    
            return redirect()->to('/data_transaksi')->with('success', 'Pembayaran berhasil diproses dan stok diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Uang yang dibayarkan kurang dari total.');
        }
    }
    

}
