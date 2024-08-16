<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>POS TOKO</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href= "<?= base_url('assets/css/bootstrap.min.css') ?>" />
    <link rel="stylesheet" href= "<?= base_url('assets/css/lineicons.css') ?>" />
    <link rel="stylesheet" href= "<?= base_url('assets/css/materialdesignicons.min.css') ?>" />
    <link rel="stylesheet" href= "<?= base_url('assets/css/fullcalendar.css') ?>" />
    <link rel="stylesheet" href= "<?= base_url('assets/css/main.css') ?>" />
    <!-- tabler icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/1.35.0/iconfont/tabler-icons.min.css" integrity="sha512-tpsEzNMLQS7w9imFSjbEOHdZav3/aObSESAL1y5jyJDoICFF2YwEdAHOPdOr1t+h8hTzar0flphxR76pd0V1zQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
function calculateTotals() {
    const produkSelect = document.getElementById('produk_id');
    const jumlahInput = document.getElementById('jumlah');
    const totalInput = document.getElementById('total');
    const diskonInput = document.getElementById('diskon');
    const bayarInput = document.getElementById('bayar');
    const kembalianInput = document.getElementById('kembalian');
    const diskonAmount = document.getElementById('diskon-amount');
    
    const selectedOption = produkSelect.options[produkSelect.selectedIndex];
    const harga = parseFloat(selectedOption.getAttribute('data-harga')) || 0;
    const jumlah = parseFloat(jumlahInput.value) || 0;
    let total = harga * jumlah;

    // Apply discount
    const diskon = parseFloat(diskonInput.value) || 0;
    const diskonValue = total * (diskon / 100);
    total -= diskonValue;

    totalInput.value = total.toFixed(2);
    diskonAmount.textContent = `Diskon ${diskon}% = Rp ${diskonValue.toFixed(2)}`;

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
  </head>
  <body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
      <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
      <div class="navbar-logo">
        <a href="index.html">
          <h>POS Toko</h3>
        </a>
      </div>
      <nav class="sidebar-nav">
        <ul>
        <li class="nav-item mb-2">
            <a href="<?= site_url('/') ?>">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
              <span class="text">Dashboard</span>
            </a>
          </li>

          <li class="nav-item mb-2">
            <a href="<?= site_url('/data_produk') ?>">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
              <span class="text">Data Produk</span>
            </a>
          </li>
          <li class="nav-item mb-2">
            <a href="<?= site_url('/data_transaksi') ?>">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" /><path d="M15 12h-12l3 -3" /><path d="M6 15l-3 -3" /></svg>
              <span class="text">Transaksi</span>
            </a>
          </li>
        </ul>
      </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <!-- ========== header start ========== -->
      <header class="header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-6">
              <div class="header-left d-flex align-items-center">
                <div class="menu-toggle-btn mr-15">
                  <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                    <i class="lni lni-chevron-left me-2"></i> Menu
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- ========== header end ========== -->


        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
            <!-- ========== title-wrapper start ========== -->
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                        <h2>Tambah Transaksi</h2>
                          <form action="<?= site_url('data_transaksi/store') ?>" method="post">
                                  <label>Nama Pembeli:</label>
                                  <input type="text" name="nama_pembeli" required><br>
                                  <label>Produk:</label>
                                  <select name="produk_id" id="produk_id" required>
                                      <?php foreach ($produk as $item): ?>
                                          <option value="<?= $item['id'] ?>" data-harga="<?= $item['harga'] ?>"><?= $item['nama'] ?></option>
                                      <?php endforeach; ?>
                                  </select><br>
                                      <label>Jumlah:</label>
                                      <input type="number" id="jumlah" name="jumlah" required><br>
                                      <input type="submit" value="Simpan">
                              </form>
                            <a href="<?= site_url('data_transaksi') ?>">Kembali</a>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- ========== title-wrapper end ========== -->
            </div>
            <!-- end container -->
        </section>
        <!-- ========== section end ========== -->
        </main>
        <!-- ======== main-wrapper end =========== -->
    

    <!-- ========= All Javascript files linkup ======== -->
    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js' ) ?> "></script>
    <script src="<?= base_url('assets/js/jvectormap.min.js' ) ?> "></script>
    <script src="<?= base_url('assets/js/polyfill.js' ) ?> "></script>
    <script src="<?= base_url('assets/js/main.js' ) ?> "></script>
  </body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h1>Tambah Transaksi</h1>
    <form action="<?= site_url('data_transaksi/store') ?>" method="post">
        <label>Produk:</label>
        <select name="produk_id">
            <?php foreach ($produk as $item): ?>
                <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <label>Jumlah:</label>
        <input type="number" name="jumlah" required><br>
        <label>Total:</label>
        <input type="number" name="total" step="0.01" required><br>
        <input type="submit" value="Simpan">
    </form>
    <a href="<?= site_url('data_transaksi') ?>">Kembali</a>
</body>
</html>
