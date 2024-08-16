<!-- app/Views/transaksi/edit.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Transaksi</h1>
        <form action="<?= site_url('data_transaksi/update/'.$transaksi['id']) ?>" method="post">
    <label>Nama Pembeli:</label>
    <input type="text" name="nama_pembeli" value="<?= $transaksi['nama_pembeli'] ?>" required><br>

    <label>Produk:</label>
    <select name="produk_id" id="produk_id" required>
        <?php foreach ($produk as $item): ?>
            <option value="<?= $item['id'] ?>" <?= $item['id'] == $transaksi['produk_id'] ? 'selected' : '' ?>><?= $item['nama'] ?></option>
        <?php endforeach; ?>
    </select><br>

    <label>Jumlah:</label>
    <input type="number" id="jumlah" name="jumlah" value="<?= $transaksi['jumlah'] ?>" required><br>

    <label>Diskon (%):</label>
    <input type="number" id="diskon" name="diskon" step="0.01" value="<?= $transaksi['diskon'] ?>"><br>
    <span id="diskon-amount">Diskon <?= $transaksi['diskon'] ?>% = Rp <?= $transaksi['nilai_diskon'] ?></span><br>

    <label>Total:</label>
    <input type="number" id="total" name="total" step="0.01" value="<?= $transaksi['total'] ?>" readonly><br>

    <label>Uang Dibayar:</label>
    <input type="number" id="bayar" name="bayar" step="0.01" value="<?= $transaksi['uang_dibayar'] ?>"><br>

    <label>Kembalian:</label>
    <input type="number" id="kembalian" name="kembalian" step="0.01" value="<?= $transaksi['kembalian'] ?>" readonly><br>

    <label>Status Pembayaran:</label>
    <select name="status_pembayaran">
        <option value="Belum Dibayar" <?= $transaksi['status_pembayaran'] == 'Belum Dibayar' ? 'selected' : '' ?>>Belum Dibayar</option>
        <option value="Lunas" <?= $transaksi['status_pembayaran'] == 'Lunas' ? 'selected' : '' ?>>Lunas</option>
    </select><br>

    <input type="submit" value="Update">
</form>

    </div>
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Function to calculate total and change on input change
        function calculateTotals() {
            const produkSelect = document.getElementById('produk_id');
            const jumlahInput = document.getElementById('jumlah');
            const totalInput = document.getElementById('total');
            const diskonInput = document.getElementById('diskon');
            const bayarInput = document.getElementById('bayar');
            const kembalianInput = document.getElementById('kembalian');
            
            const selectedOption = produkSelect.options[produkSelect.selectedIndex];
            const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
            const jumlah = parseFloat(jumlahInput.value) || 0;
            let total = harga * jumlah;

            // Apply discount
            const diskon = parseFloat(diskonInput.value) || 0;
            const diskonValue = total * (diskon / 100);
            total -= diskonValue;

            totalInput.value = total.toFixed(2);

            // Calculate change
            const bayar = parseFloat(bayarInput.value) || 0;
            const kembalian = bayar - total;
            kembalianInput.value = kembalian.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners
            document.getElementById('produk_id').addEventListener('change', calculateTotals);
            document.getElementById('jumlah').addEventListener('input', calculateTotals);
            document.getElementById('diskon').addEventListener('input', calculateTotals);
            document.getElementById('bayar').addEventListener('input', calculateTotals);
        });
    </script>
</body>
</html>
