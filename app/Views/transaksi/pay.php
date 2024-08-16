<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayar Transaksi</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <script>
        function calculateTotals() {
            const totalInput = document.getElementById('total');
            const diskonInput = document.getElementById('diskon');
            const bayarInput = document.getElementById('bayar');
            const kembalianInput = document.getElementById('kembalian');
            const diskonAmount = document.getElementById('diskon-amount');
            
            let total = parseFloat(totalInput.value) || 0;

            // Apply discount
            const diskon = parseFloat(diskonInput.value) || 0;
            const diskonValue = total * (diskon / 100);
            total -= diskonValue;

            // Update total after discount
            totalInput.value = total.toFixed(2);
            diskonAmount.textContent = `Diskon ${diskon}% = Rp ${diskonValue.toFixed(2)}`;

            // Calculate change
            const bayar = parseFloat(bayarInput.value) || 0;
            const kembalian = bayar - total;
            kembalianInput.value = kembalian.toFixed(2);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Add event listeners
            document.getElementById('diskon').addEventListener('input', calculateTotals);
            document.getElementById('bayar').addEventListener('input', calculateTotals);
        });
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1>Bayar Transaksi</h1>

        <form action="<?= site_url('data_transaksi/bayar/' . $transaksi['id']) ?>" method="post">
            <div class="mb-3">
                <label for="number" class="form-label">Diskon (%)</label>
                <input type="number" class="form-control" id="diskon" name="diskon" value="0" required><br>
                <span id="diskon-amount">Diskon 0% = Rp 0.00</span><br>
            </div>
            <div class="mb-3">
                <label for="bayar" class="form-label">Uang Dibayar</label>
                <input type="number" class="form-control" id="bayar" name="bayar" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="kembalian" class="form-label">Kembalian</label>
                <input type="number" class="form-control" id="kembalian" name="kembalian" step="0.01" readonly>
            </div>
            <button type="submit" class="btn btn-primary">Bayar</button>
            <a href="<?= site_url('data_transaksi') ?>" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</body>
</html>
