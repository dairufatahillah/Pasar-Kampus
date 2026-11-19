<?php
declare(strict_types=1);

$defaultTab = $defaultTab ?? ($_GET['tab'] ?? 'syarat');
if (!in_array($defaultTab, ['syarat', 'keamanan', 'kebijakan'], true)) {
    $defaultTab = 'syarat';
}

$pageTitles = [
    'syarat' => 'Syarat & Ketentuan - PasarKampus',
    'keamanan' => 'Panduan Keamanan COD - PasarKampus',
    'kebijakan' => 'Kebijakan Privasi & Platform - PasarKampus'
];
$title = $pageTitles[$defaultTab] ?? 'Dukungan & Panduan - PasarKampus';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <meta name="description" content="Halaman resmi Kebijakan Privasi, Panduan Keamanan Transaksi COD, serta Syarat & Ketentuan Platform PasarKampus.">
    <!-- Google Fonts Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS Stylesheet Global -->
    <link rel="stylesheet" href="<?= asset("css/style.css") ?>">
    <link rel="stylesheet" href="<?= asset("css/flasher.css") ?>">
    
    <style>
        :root {
            --pk-blue-primary: #1D4ED8;
            --pk-blue-hover: #1E40AF;
            --pk-navy-footer: #1D356D;
            --pk-text-main: #0F172A;
            --pk-text-body: #334155;
            --pk-text-muted: #64748B;
            --pk-border-light: #E2E8F0;
            --pk-bg-page: #FFFFFF;
            --pk-bg-card: #FFFFFF;
        }

        body.pk-doc-body {
            background-color: var(--pk-bg-page);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: var(--pk-text-body);
            margin: 0;
            padding: 0;
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
        }

        /* ================= 1. HEADER (PERSIS Group 5.png) ================= */
        .pk-navbar-custom {
            background: linear-gradient(180deg, #1D4ED8 0%, #2355B8 60%, #1E40AF 100%);
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 32px;
            color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .pk-navbar-custom .pk-nav-inner {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .pk-navbar-custom .pk-nav-logo {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
            color: #FFFFFF;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .pk-navbar-custom .pk-nav-links {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .pk-navbar-custom .pk-nav-links a {
            color: #FFFFFF;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            opacity: 0.95;
            transition: opacity 0.2s, transform 0.2s;
        }

        .pk-navbar-custom .pk-nav-links a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        /* ================= 2. MAIN DOCUMENT CONTAINER (Area Blank Putih) ================= */
        .pk-doc-container {
            max-width: 960px;
            margin: 0 auto;
            padding: 44px 24px 80px;
            min-height: calc(100vh - 64px - 320px);
        }

        /* Breadcrumb / Back Navigation */
        .pk-doc-top-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pk-doc-back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--pk-blue-primary);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .pk-doc-back-link:hover {
            color: var(--pk-blue-hover);
            text-decoration: underline;
        }

        /* Navigation Tab Switcher */
        .pk-doc-tabs {
            display: inline-flex;
            background: #F1F5F9;
            padding: 4px;
            border-radius: 10px;
            border: 1px solid var(--pk-border-light);
            gap: 4px;
            flex-wrap: wrap;
        }

        .pk-doc-tab-btn {
            border: none;
            background: transparent;
            padding: 8px 18px;
            border-radius: 7px;
            font-family: inherit;
            font-size: 0.88rem;
            font-weight: 600;
            color: var(--pk-text-muted);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .pk-doc-tab-btn:hover {
            color: var(--pk-text-main);
            background: rgba(255, 255, 255, 0.6);
        }

        .pk-doc-tab-btn.active {
            background: #FFFFFF;
            color: var(--pk-blue-primary);
            font-weight: 700;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        /* White Document Paper (Simple, Rapi seperti Screenshot) */
        .pk-doc-paper {
            background: var(--pk-bg-card);
            border: 1px solid var(--pk-border-light);
            border-radius: 12px;
            padding: 44px 50px;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.03);
        }

        .pk-doc-pane {
            display: none;
        }

        .pk-doc-pane.active {
            display: block;
            animation: fadeIn 0.25s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Typography Styling persis Screenshot */
        .pk-doc-title {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-size: 1.85rem;
            font-weight: 800;
            color: var(--pk-text-main);
            margin: 0 0 12px 0;
            letter-spacing: -0.3px;
            text-transform: uppercase;
        }

        .pk-doc-divider {
            border: 0;
            height: 1px;
            background: var(--pk-border-light);
            margin: 16px 0 20px;
        }

        .pk-doc-subtitle {
            font-size: 1rem;
            color: var(--pk-text-body);
            margin: 0 0 10px 0;
            font-weight: 500;
        }

        .pk-doc-weblink {
            color: #2563EB;
            font-size: 0.95rem;
            text-decoration: underline;
            margin-bottom: 24px;
            display: inline-block;
        }

        .pk-doc-weblink:hover {
            color: #1D4ED8;
        }

        .pk-doc-alert-heading {
            font-weight: 800;
            font-size: 0.95rem;
            color: var(--pk-text-main);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 28px 0 12px 0;
        }

        .pk-doc-intro-text {
            font-size: 0.92rem;
            line-height: 1.8;
            color: var(--pk-text-body);
            text-align: justify;
            margin-bottom: 24px;
        }

        .pk-doc-section-title {
            font-weight: 700;
            font-size: 1.05rem;
            color: var(--pk-text-main);
            margin: 28px 0 12px 0;
        }

        .pk-doc-list {
            margin: 0 0 20px 0;
            padding-left: 20px;
        }

        .pk-doc-list li {
            margin-bottom: 10px;
            line-height: 1.75;
            font-size: 0.92rem;
        }

        .pk-doc-term-item {
            margin-bottom: 14px;
            font-size: 0.92rem;
            line-height: 1.75;
        }

        .pk-doc-term-item strong {
            color: var(--pk-text-main);
        }

        .pk-doc-highlight-box {
            background-color: #F8FAFC;
            border-left: 4px solid var(--pk-blue-primary);
            padding: 16px 20px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
            font-size: 0.92rem;
            line-height: 1.7;
            color: #1E293B;
        }

        .pk-doc-highlight-box strong {
            color: #0F172A;
        }

        .pk-badge-cod {
            display: inline-block;
            background: #EFF6FF;
            color: #1D4ED8;
            padding: 3px 10px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.8rem;
            border: 1px solid #BFDBFE;
            margin-bottom: 6px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .pk-doc-paper {
                padding: 28px 20px;
            }
            .pk-doc-title {
                font-size: 1.5rem;
            }
            .pk-doc-tabs {
                width: 100%;
                display: flex;
            }
            .pk-doc-tab-btn {
                flex: 1;
                text-align: center;
                justify-content: center;
                padding: 8px 10px;
                font-size: 0.8rem;
            }
            .pk-navbar-custom {
                padding: 0 16px;
            }
        }
    </style>
</head>
<body class="pk-doc-body">

    <!-- ================= 1. HEADER (PERSIS Group 5.png) ================= -->
    <header class="pk-navbar-custom">
        <div class="pk-nav-inner">
            <a href="<?= route('/') ?>" class="pk-nav-logo">
                PasarKampus
            </a>
            <div class="pk-nav-links">
                <a href="<?= route('/riwayat.php') ?>">Riwayat</a>
                <a href="<?= route('/profil.php') ?>">Profil</a>
            </div>
        </div>
    </header>

    <!-- ================= 2. MAIN DOCUMENT CONTENT (Blank Putih Bersih) ================= -->
    <main class="pk-doc-container">

        <!-- Top Navigation: Back button & Tabs -->
        <div class="pk-doc-top-nav">
            <a href="<?= route('/') ?>" class="pk-doc-back-link">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Beranda
            </a>

            <!-- Switcher Tabs -->
            <div class="pk-doc-tabs" role="tablist">
                <button type="button" class="pk-doc-tab-btn <?= $defaultTab === 'syarat' ? 'active' : '' ?>" onclick="switchDocTab('syarat')" id="tabBtn-syarat" role="tab">
                    Syarat &amp; Ketentuan
                </button>
                <button type="button" class="pk-doc-tab-btn <?= $defaultTab === 'keamanan' ? 'active' : '' ?>" onclick="switchDocTab('keamanan')" id="tabBtn-keamanan" role="tab">
                    Panduan Keamanan COD
                </button>
                <button type="button" class="pk-doc-tab-btn <?= $defaultTab === 'kebijakan' ? 'active' : '' ?>" onclick="switchDocTab('kebijakan')" id="tabBtn-kebijakan" role="tab">
                    Kebijakan Privasi
                </button>
            </div>
        </div>

        <!-- Document Paper Card -->
        <article class="pk-doc-paper">

            <!-- ================= TAB 1: SYARAT & KETENTUAN ================= -->
            <section id="pane-syarat" class="pk-doc-pane <?= $defaultTab === 'syarat' ? 'active' : '' ?>" role="tabpanel">
                <h1 class="pk-doc-title">SYARAT &amp; KETENTUAN</h1>
                <div class="pk-doc-divider"></div>

                <div class="pk-doc-alert-heading">PENTING: MOHON DIPERHATIKAN</div>
                <p class="pk-doc-intro-text">
                    SILAKAN BACA 'SYARAT DAN KETENTUAN' YANG TERTULIS DI BAWAH INI DENGAN SEKSAMA SEBELUM MENGAKSES MAUPUN MENGGUNAKAN LAYANAN DI SITUS WEB KAMI. DENGAN MENGAKSES, MEMBUAT AKUN, MEMASANG IKLAN BARANG, ATAU MENGAJUKAN PEMBELIAN PRODUK DI PASARKAMPUS, ANDA MENYATAKAN TELAH MEMBACA, MEMAHAMI, DAN SETUJU UNTUK TERIKAT DENGAN SYARAT DAN KETENTUAN INI SERTA KEBIJAKAN PRIVASI KAMI. KAMI MENGANJURKAN ANDA UNTUK MENYIMPAN MAUPUN MEMERIKSA KETENTUAN INI SECARA BERKALA SEBAGAI REFERENSI DI MASA MENDATANG.
                </p>

                <div class="pk-doc-section-title">Dalam Syarat Layanan ini:</div>
                <div class="pk-doc-term-item">
                    <strong>'Kami', 'Kita' dan 'Milik kami'</strong> merujuk kepada Tim Pengelola PasarKampus (Project Based Learning Mahasiswa).
                </div>
                <div class="pk-doc-term-item">
                    <strong>'Pengguna' / 'Anda'</strong>, yaitu Mahasiswa atau Konsumen yang mengakses Situs ini untuk memesan Produk, menjual barang perkuliahan, atau menggunakan Layanan dari Situs ini.
                </div>
                <div class="pk-doc-term-item">
                    <strong>'Produk' / 'Barang'</strong>, yaitu barang perlengkapan perkuliahan bekas (preloved/thrifting) yang diunggah dan ditawarkan oleh sesama mahasiswa di platform.
                </div>
                <div class="pk-doc-term-item">
                    <strong>'Pengajuan'</strong>, yaitu permohonan minat pembelian yang diajukan oleh Pembeli kepada Penjual melalui formulir di Website sebelum terjadi koordinasi langsung.
                </div>
                <div class="pk-doc-term-item">
                    <strong>'COD (Cash On Delivery)'</strong>, yaitu metode serah terima barang langsung dan pembayaran tatap muka yang dilakukan mandiri oleh penjual dan pembeli di lingkungan kampus.
                </div>

                <div class="pk-doc-section-title">1. Peran &amp; Batasan Tanggung Jawab Platform</div>
                <p class="pk-doc-intro-text">
                    PasarKampus bertindak murni sebagai penyedia wadah katalog digital dan alur penghubung pengajuan barang perkuliahan. PasarKampus <strong>bukan merupakan pemroses pembayaran</strong>, tidak menyediakan rekening bersama (escrow), dan tidak menyediakan layanan kurir pengiriman. Segala pembayaran (tunai maupun transfer langsung) serta serah terima fisik barang dilakukan sepenuhnya secara langsung antara Penjual dan Pembeli di luar platform.
                </p>

                <div class="pk-doc-section-title">2. Kewajiban &amp; Tanggung Jawab Penjual</div>
                <ul class="pk-doc-list">
                    <li>Penjual hanya diperkenankan memposting barang yang merupakan hak milik sah pribadi mahasiswa.</li>
                    <li>Penjual wajib menyertakan foto asli, deskripsi spesifikasi jujur, penetapan harga wajar, serta skala kondisi barang yang objektif (Skala 1: Kurang, Skala 2: Cukup, Skala 3: Baik, Skala 4: Sangat Baik).</li>
                    <li><strong>Larangan Barang:</strong> Dilarang keras memajang atau memperjualbelikan barang ilegal, barang curian, tiruan/palsu (counterfeit), senjata tajam, obat-obatan terlarang, materi pornografi, joki tugas/skripsi, atau barang yang melanggar hukum dan tata tertib kampus.</li>
                    <li>Penjual wajib merespons pengajuan masuk (menerima/menolak) dalam waktu maksimal 1x24 jam sebelum pengajuan kedaluwarsa secara otomatis.</li>
                </ul>

                <div class="pk-doc-section-title">3. Kewajiban &amp; Pembatasan Pembeli</div>
                <ul class="pk-doc-list">
                    <li>Pembeli hanya mengajukan pembelian pada produk yang benar-benar berniat untuk dibeli dan disepakati.</li>
                    <li><strong>Batas Maksimal Kuota Pengajuan:</strong> Demi mencegah penimbunan atau penguncian barang (slot lockout), setiap akun dibatasi maksimal <strong>3 pengajuan berstatus 'Pending'</strong> pada waktu yang bersamaan.</li>
                    <li>Setelah pengajuan disetujui penjual, pembeli wajib segera mengoordinasikan jadwal dan lokasi serah terima COD melalui tautan WhatsApp resmi yang disediakan platform.</li>
                </ul>

                <div class="pk-doc-section-title">4. Ketentuan Status Pengajuan &amp; Transaksi</div>
                <ul class="pk-doc-list">
                    <li><strong>Pending:</strong> Pengajuan baru diajukan oleh pembeli. Pengajuan yang tidak ditanggapi penjual otomatis ditutup (Closed) setelah 1x24 jam sehingga slot kuota pembeli kembali tersedia.</li>
                    <li><strong>Process:</strong> Pengajuan diterima oleh penjual. Tautan koordinasi WhatsApp dibuka. Transaksi berstatus Process yang tidak dikonfirmasi manual otomatis diselesaikan (Done) setelah 2x24 jam.</li>
                    <li><strong>Done:</strong> Transaksi serah terima fisik barang dan pembayaran telah selesai dilaksanakan.</li>
                    <li><strong>Closed / Dibatalkan:</strong> Pengajuan ditolak oleh penjual, dibatalkan oleh pembeli, atau kedaluwarsa otomatis oleh sistem.</li>
                </ul>

                <div class="pk-doc-section-title">5. Penegakan Aturan &amp; Moderasi Admin</div>
                <p class="pk-doc-intro-text">
                    Platform dilengkapi dengan tombol <strong>"Laporkan" (Report)</strong> pada detail produk dan profil pengguna. Admin berhak menurunkan tayang produk bermasalah, menangguhkan, atau memblokir permanen (ban) akun yang melanggar aturan ini demi menjaga keamanan civitas kampus.
                </p>

                <div class="pk-doc-highlight-box">
                    <strong>Catatan:</strong> Syarat dan ketentuan ini dibuat untuk mendukung ekosistem Project Based Learning (PBL) mahasiswa yang aman, transparan, dan saling percaya.
                </div>
            </section>

            <!-- ================= TAB 2: PANDUAN KEAMANAN COD ================= -->
            <section id="pane-keamanan" class="pk-doc-pane <?= $defaultTab === 'keamanan' ? 'active' : '' ?>" role="tabpanel">
                <h1 class="pk-doc-title">PANDUAN KEAMANAN COD (CASH ON DELIVERY)</h1>
                <div class="pk-doc-divider"></div>

                <div class="pk-doc-alert-heading">PENTING: MOHON DIPERHATIKAN SEBELUM BERTEMU</div>
                <p class="pk-doc-intro-text">
                    METODE CASH ON DELIVERY (COD) ADALAH METODE UTAMA DI PASARKAMPUS AGAR ANDA DAPAT MEMERIKSA KONDISI FISIK BARANG SECARA LANGSUNG SEBELUM MEMBAYAR, TANPA BEBAN BIAYA ONGKIR. UNTUK MENGHINDARI PENIPUAN, KERUSAKAN BARANG, MAUPUN INSIDEN YANG TIDAK DIINGINKAN, SELURUH CIVITAS DIWAJIBKAN MEMATUHI PROTOKOL KEAMANAN DI BAWAH INI.
                </p>

                <div class="pk-doc-highlight-box">
                    <strong>Prinsip Emas COD PasarKampus:</strong><br>
                    "Pembayaran dilakukan langsung saat serah terima fisik barang. Selalu periksa dan uji kondisi kelayakan barang sebelum menyerahkan uang pembayaran."
                </div>

                <div class="pk-doc-section-title">1. Pilih Lokasi Pertemuan yang Ramai &amp; Terbuka di Kampus</div>
                <ul class="pk-doc-list">
                    <li>Selalu sepakati titik temu (meeting point) di area terbuka kampus pada <strong>jam operasional perkuliahan (08.00 - 17.00 WIB)</strong> saat kondisi kampus ramai.</li>
                    <li><strong>Titik Temu yang Direkomendasikan:</strong>
                        <ul style="margin-top: 6px; padding-left: 18px;">
                            <li>Lobi gedung kuliah bersama atau lobi fakultas / dekanat.</li>
                            <li>Pelataran atau lobi depan Perpustakaan Kampus.</li>
                            <li>Kantin utama kampus pada jam istirahat.</li>
                            <li>Gazebo kegiatan mahasiswa atau dekat Pos Satpam / Keamanan Kampus.</li>
                        </ul>
                    </li>
                    <li><strong>Hindari:</strong> Menyetujui janji temu di tempat sepi, lorong terpencil, kamar kos pribadi yang sepi, atau pada larut malam.</li>
                </ul>

                <div class="pk-doc-section-title">2. Jangan Pernah Membayar Uang Muka (DP) Terlebih Dahulu</div>
                <p class="pk-doc-intro-text">
                    Penjual resmi PasarKampus tidak diperbolehkan meminta transfer Uang Muka (DP), pulsa, atau biaya tanda jadi sebelum barang diperiksa. <strong>Jangan pernah mentransfer dana apapun</strong> dengan alasan "agar barang tidak diambil orang lain" sebelum Anda memegang fisik barangnya secara tatap muka.
                </p>

                <div class="pk-doc-section-title">3. Periksa Kondisi Fisik &amp; Fungsi Barang di Tempat</div>
                <ul class="pk-doc-list">
                    <li>Cocokkan fisik barang dengan foto dan deskripsi yang ada di katalog PasarKampus.</li>
                    <li>Periksa skala kondisi (1-4) yang dijanjikan. Pastikan tidak ada cacat tersembunyi.</li>
                    <li><strong>Untuk Barang Elektronik:</strong> Mintalah izin untuk menyalakan perangkat, mencoba charger, mengecek tombol, baterai, layar, dan fungsi dasarnya secara teliti.</li>
                    <li><strong>Untuk Buku Perkuliahan:</strong> Periksa kelengkapan halaman dan ada atau tidaknya coretan yang mengganggu.</li>
                    <li>Jika kondisi fisik berbeda jauh dari apa yang diiklankan, Anda memiliki hak penuh untuk <strong>membatalkan transaksi secara sopan di tempat</strong> tanpa harus merasa bersalah.</li>
                </ul>

                <div class="pk-doc-section-title">4. Prosedur Pembayaran Aman</div>
                <ul class="pk-doc-list">
                    <li><strong>Pembayaran Tunai:</strong> Siapkan uang pas sesuai harga kesepakatan guna mempermudah transaksi dan menghindari masalah ketiadaan uang kembalian.</li>
                    <li><strong>Pembayaran Transfer Bank / QRIS di Tempat:</strong>
                        <ul style="margin-top: 6px; padding-left: 18px;">
                            <li>Lakukan transfer saat Anda berhadapan langsung dengan penjual.</li>
                            <li>Bagi Penjual: Pastikan selalu mengecek mutasi saldo masuk langsung di aplikasi perbankan Anda sendiri. Jangan hanya mempercayai tangkapan layar (screenshot) struk transfer.</li>
                        </ul>
                    </li>
                </ul>

                <div class="pk-doc-section-title">5. Gunakan Tombol WhatsApp Resmi &amp; Cek Kredibilitas</div>
                <p class="pk-doc-intro-text">
                    Hubungi lawan transaksi melalui tombol WhatsApp resmi yang disediakan setelah pengajuan diterima. Pesan otomatis telah dilengkapi format: <em>Nama Pengaju, Nama Barang, dan ID Transaksi</em> untuk verifikasi identitas. Anda juga dapat mengecek tautan profil media sosial (Instagram, LinkedIn, X) yang dicantumkan penjual di PasarKampus.
                </p>

                <div class="pk-doc-section-title">6. Fitur Laporkan (Report) Jika Ada Gelagat Mencurigakan</div>
                <p class="pk-doc-intro-text">
                    Jika Anda menemui penjual atau pembeli yang bertindak mencurigakan, memaksa transfer di luar ketentuan, barang terindikasi palsu/curian, atau tidak beriktikad baik:
                </p>
                <ul class="pk-doc-list">
                    <li>Segera tolak transaksi dan tinggalkan lokasi pertemuan menuju tempat aman / pos satpam.</li>
                    <li>Buka aplikasi PasarKampus, masuk ke halaman detail barang atau profil pengguna tersebut, lalu klik tombol <strong>"Laporkan" (Report)</strong>.</li>
                    <li>Sertakan bukti foto tangkapan layar chat WhatsApp atau foto barang. Admin PasarKampus akan segera menindaklanjuti dengan menangguhkan atau memblokir akun yang bersangkutan.</li>
                </ul>
            </section>

            <!-- ================= TAB 3: KEBIJAKAN PRIVASI & PLATFORM ================= -->
            <section id="pane-kebijakan" class="pk-doc-pane <?= $defaultTab === 'kebijakan' ? 'active' : '' ?>" role="tabpanel">
                <h1 class="pk-doc-title">KEBIJAKAN PRIVASI &amp; PLATFORM</h1>
                <div class="pk-doc-divider"></div>

                <div class="pk-doc-alert-heading">PENTING: KOMITMEN PERLINDUNGAN PRIVASI MAHASISWA</div>
                <p class="pk-doc-intro-text">
                    PASARKAMPUS MENJUNJUNG TINGGI PRIVASI DAN KEAMANAN DATA PRIBADI SELURUH CIVITAS AKADEMIKA MAHASISWA. KEBIJAKAN INI MEMAPARKAN BAGAIMANA INFORMASI DIKUMPULKAN, DIGUNAKAN, DAN DILINDUNGI SAAT ANDA MENJADI BAGIAN DARI EKOSISTEM PASARKAMPUS.
                </p>

                <div class="pk-doc-section-title">1. Informasi yang Kami Kumpulkan</div>
                <div class="pk-doc-term-item">
                    <strong>a. Informasi Akun:</strong> Alamat email institusi/pribadi, kata sandi terenkripsi (hash algoritma aman), dan peran akun.
                </div>
                <div class="pk-doc-term-item">
                    <strong>b. Data Profil Pengguna:</strong> Nama lengkap, asal perguruan tinggi / kampus, nomor telepon WhatsApp, jenis kelamin, tanggal lahir, dan wilayah domisili (kecamatan/kelurahan).
                </div>
                <div class="pk-doc-term-item">
                    <strong>c. Media Sosial Opsional:</strong> Tautan akun Instagram, LinkedIn, atau X yang dimasukkan sukarela untuk meningkatkan kredibilitas pengguna.
                </div>
                <div class="pk-doc-term-item">
                    <strong>d. Data Barang &amp; Pengajuan:</strong> Foto barang jualan, nama, harga, deskripsi, kondisi, kategori, serta riwayat interaksi pengajuan transaksi.
                </div>

                <div class="pk-doc-section-title">2. Penggunaan Informasi &amp; Perlindungan Kontak</div>
                <ul class="pk-doc-list">
                    <li>Data profil digunakan untuk memvalidasi ekosistem sirkulasi barang perkuliahan di lingkungan kampus yang relevan.</li>
                    <li><strong>Perlindungan Nomor WhatsApp (Anti-Spam):</strong> Nomor WhatsApp pengguna <strong>TIDAK ditampilkan secara terbuka</strong> kepada pengunjung publik sembarangan. Nomor WhatsApp hanya diberikan secara privat kepada pihak terkait saat pengajuan pembelian telah diajukan dan diproses demi keperluan koordinasi COD.</li>
                    <li>Kami <strong>tidak pernah menjual, menyewakan, atau menyalahgunakan</strong> data pribadi Anda kepada pihak ketiga pengiklan manapun.</li>
                </ul>

                <div class="pk-doc-section-title">3. Keamanan Data &amp; Tiadanya Penyimpanan Finansial</div>
                <p class="pk-doc-intro-text">
                    Kata sandi akun Anda dilindungi dengan sistem hashing satu arah standar industri terkini. Karena PasarKampus menggunakan sistem transaksi tatap muka langsung (COD), platform <strong>tidak pernah meminta atau menyimpan</strong> data finansial rahasia seperti nomor kartu kredit, PIN, atau rekening perbankan pengguna.
                </p>

                <div class="pk-doc-section-title">4. Kebijakan Konten Katalog &amp; Moderasi</div>
                <ul class="pk-doc-list">
                    <li>Pengguna bertanggung jawab penuh atas keabsahan, keaslian foto, dan legalitas barang yang dipajang.</li>
                    <li>Dilarang mengunggah konten yang mengandung unsur SARA, ujaran kebencian, penipuan, barang terlarang, atau melanggar hak cipta pihak lain.</li>
                    <li>Admin PasarKampus memiliki kewenangan penuh untuk mengedit informasi yang salah, menurunkan tayang (take down) produk bermasalah, atau menghapus listing yang melanggar aturan.</li>
                </ul>

                <div class="pk-doc-section-title">5. Penanganan Akun Ditangguhkan &amp; Diblokir</div>
                <p class="pk-doc-intro-text">
                    Akun yang menerima laporan pelanggaran yang terbukti valid akan dikenai status ditangguhkan (suspend) atau diblokir (ban). Pengguna dengan akun berstatus demikian tidak dapat melakukan pengajuan transaksi atau mengunggah barang baru, disertai alasan singkat yang ditampilkan oleh sistem saat mencoba mengakses.
                </p>

                <div class="pk-doc-section-title">6. Hak Pengguna &amp; Kontak Dukungan</div>
                <p class="pk-doc-intro-text">
                    Anda berhak memperbarui informasi profil, preferensi barang, maupun menghapus listing barang Anda kapan saja melalui dashboard pengguna. Jika Anda memiliki pertanyaan lebih lanjut, membutuhkan bantuan, atau ingin mengajukan pertanyaan privasi, silakan hubungi tim kami melalui email: <a href="mailto:support@pasarkampus.id" style="color: #2563EB; font-weight: 600;">support@pasarkampus.id</a>.
                </p>

                <div class="pk-doc-highlight-box">
                    <strong>Komitmen Kami:</strong> PasarKampus didedikasikan untuk menciptakan wadah jual beli barang perkuliahan yang aman, hemat biaya ongkir, dan berkesinambungan bagi seluruh mahasiswa.
                </div>
            </section>

        </article>
    </main>

    <!-- ================= 3. FOOTER (PERSIS Group 5.png) ================= -->
    <footer class="lp-footer">
        <div class="lp-container">
            <div class="lp-footer-grid">
                <!-- Col 1: Brand & Copyright -->
                <div class="lp-footer-col">
                    <a href="<?= route('/') ?>" class="lp-logo" style="color: #FFFFFF;">
                        PasarKampus
                    </a>
                    <p>
                        Platform marketplace eksklusif mahasiswa untuk sirkulasi barang perkuliahan yang aman, hemat, dan berkelanjutan.
                    </p>
                </div>

                <!-- Col 2: PasarKampus -->
                <div class="lp-footer-col">
                    <h4>PasarKampus</h4>
                    <ul class="lp-footer-links">
                        <li><a href="<?= route('/#tentang-kami') ?>">Tentang Kami</a></li>
                        <li><a href="<?= route('/barang') ?>">Katalog Barang</a></li>
                        <li><a href="<?= route('/register') ?>">Daftar Akun Mahasiswa</a></li>
                        <li><a href="<?= route('/dashboard_penjual.php') ?>">Dashboard Penjual</a></li>
                    </ul>
                </div>

                <!-- Col 3: Bantuan -->
                <div class="lp-footer-col">
                    <h4>Bantuan</h4>
                    <ul class="lp-footer-links">
                        <li><a href="<?= route('/#faq') ?>">Pusat Bantuan</a></li>
                        <li><a href="<?= route('/#faq') ?>">FAQ</a></li>
                        <li><a href="<?= route('/kontak-kami.php') ?>">Kontak Kami</a></li>
                    </ul>
                </div>

                <!-- Col 4: Dukungan -->
                <div class="lp-footer-col">
                    <h4>Dukungan</h4>
                    <ul class="lp-footer-links">
                        <li><a href="<?= route('/kebijakan.php') ?>" onclick="switchDocTab('kebijakan'); return false;">Kebijakan</a></li>
                        <li><a href="<?= route('/panduan-keamanan.php') ?>" onclick="switchDocTab('keamanan'); return false;">Panduan Keamanan COD</a></li>
                        <li><a href="<?= route('/syarat-ketentuan.php') ?>" onclick="switchDocTab('syarat'); return false;">Syarat &amp; Ketentuan</a></li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="lp-footer-bottom">
                <div>
                    &copy; 2026 PasarKampus, Hak Cipta Dilindungi.
                </div>
                <div>
                    Dibuat untuk Project Based Learning (PBL) Mahasiswa
                </div>
            </div>
        </div>
    </footer>

    <!-- ================= JAVASCRIPT LOGIC SWITCH TAB ================= -->
    <script>
        const validTabs = ['syarat', 'keamanan', 'kebijakan'];
        const docTitles = {
            'syarat': 'Syarat & Ketentuan - PasarKampus',
            'keamanan': 'Panduan Keamanan COD - PasarKampus',
            'kebijakan': 'Kebijakan Privasi & Platform - PasarKampus'
        };

        function switchDocTab(tabKey, updateHistory = true) {
            if (!validTabs.includes(tabKey)) {
                tabKey = 'syarat';
            }

            // Remove active from all tabs & panes
            document.querySelectorAll('.pk-doc-tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.pk-doc-pane').forEach(pane => pane.classList.remove('active'));

            // Activate chosen tab & pane
            const activeBtn = document.getElementById('tabBtn-' + tabKey);
            const activePane = document.getElementById('pane-' + tabKey);

            if (activeBtn) activeBtn.classList.add('active');
            if (activePane) activePane.classList.add('active');

            // Update document title
            if (docTitles[tabKey]) {
                document.title = docTitles[tabKey];
            }

            // Update URL hash / query smoothly without reloading
            if (updateHistory) {
                const newUrl = window.location.pathname + '?tab=' + encodeURIComponent(tabKey);
                window.history.replaceState({ tab: tabKey }, '', newUrl);
            }

            // Smooth scroll to top of document paper if tab switched from footer
            const docPaper = document.querySelector('.pk-doc-paper');
            if (docPaper) {
                const paperTop = docPaper.getBoundingClientRect().top + window.pageYOffset - 80;
                if (window.pageYOffset > paperTop + 100) {
                    window.scrollTo({ top: paperTop, behavior: 'smooth' });
                }
            }
        }

        // Handle URL Hash or Query param on page load
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const queryTab = urlParams.get('tab');
            const hash = window.location.hash.replace('#', '').toLowerCase();

            if (queryTab && validTabs.includes(queryTab)) {
                switchDocTab(queryTab, false);
            } else if (hash === 'kebijakan' || hash === 'privasi') {
                switchDocTab('kebijakan', false);
            } else if (hash === 'keamanan' || hash === 'cod' || hash === 'panduan') {
                switchDocTab('keamanan', false);
            } else if (hash === 'syarat' || hash === 'terms') {
                switchDocTab('syarat', false);
            }
        });
    </script>
</body>
</html>
