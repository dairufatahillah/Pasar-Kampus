<?php
$session = get_session();
$adminName = $session['name'] ?? 'Superadmin';
$activeTab = 'barang';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Barang - Portal Superadmin Pasar Kampus</title>
    <!-- Google Fonts Inter & Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="<?= asset('/css/style.css') ?>">
    <link rel="stylesheet" href="<?= asset('/css/admin-style.css') ?>">
</head>
<body class="admin-body">

    <!-- =========================================================
         LAYOUT UTAMA ADMIN
         ========================================================= -->
    <div class="admin-layout">

        <!-- ---------------- SIDEBAR ADMIN ---------------- -->
        <aside id="adminSidebar" class="admin-sidebar">
            <div class="admin-sidebar-top">
                <!-- POJOK KIRI ATAS: PROFILE (Sesuai Screenshot 2026-11-12 111239.png) -->
                <div class="admin-profile-box">
                    <div class="admin-profile-avatar-wrap">
                        <img src="<?= asset('/images/04573efb612afe5bde19c3cfa3a9c746.jpg') ?>" alt="Avatar Admin" class="admin-profile-avatar">
                    </div>
                    <div class="admin-profile-info">
                        <div class="admin-profile-name">Superadmin</div>
                        <div class="admin-profile-email">admin@pasarkampus.ac.id</div>
                    </div>
                </div>

                <!-- MENU ADMIN -->
                <div class="admin-nav-section">
                    <div class="admin-nav-title">MENU ADMIN</div>
                    <ul class="admin-nav-list">
                        <li>
                            <a href="<?= route('/dashboard/index.php') ?>" id="nav-dashboard" class="admin-nav-link <?= $activeTab === 'dashboard' ? 'active' : '' ?>">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= route('/dashboard/user.php') ?>" id="nav-users" class="admin-nav-link <?= $activeTab === 'users' ? 'active' : '' ?>">
                                <span>Kelola User</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= route('/dashboard/barang.php') ?>" id="nav-barang" class="admin-nav-link <?= $activeTab === 'barang' ? 'active' : '' ?>">
                                <span>Barang</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= route('/dashboard/report.php') ?>" id="nav-report" class="admin-nav-link <?= $activeTab === 'report' ? 'active' : '' ?>">
                                <span>Report</span>
                                <span id="sidebarReportBadge" class="admin-nav-badge">2</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= route('/dashboard/kategori.php') ?>" id="nav-kategori" class="admin-nav-link <?= $activeTab === 'kategori' ? 'active' : '' ?>">
                                <span>Kategori</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- SIDEBAR FOOTER -->
            <div class="admin-sidebar-footer">
                <button type="button" class="admin-btn-logout" onclick="handleAdminLogout()">
                    <span>[Logout]</span>
                </button>
                <a href="<?= route('/dashboard.php') ?>" target="_blank" class="admin-btn-back-katalog">
                    <span>Lihat Web Pengguna &rarr;</span>
                </a>
            </div>
        </aside>

        <!-- ---------------- MAIN CONTENT AREA ---------------- -->
        <main class="admin-main">
            <!-- Top Header Bar -->
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button type="button" class="admin-mobile-toggle" onclick="toggleMobileSidebar()" title="Toggle Sidebar">
                        ☰
                    </button>
                    <div class="admin-breadcrumb">
                        <span>Portal Admin / </span>
                        <strong id="adminCurrentBreadcrumb">Manajemen Barang Katalog</strong>
                    </div>
                </div>
            </header>

            <div class="admin-content-container">

                <!-- =========================================================
                     VIEW: KELOLA BARANG (Sesuai Screenshot 2026-11-12 110803.png)
                     ========================================================= -->
                <section id="view-barang" class="admin-view-panel active">
                    
                    <!-- Header Banner -->
                    <div class="admin-page-banner">
                        <div class="admin-page-banner-text">
                            <h2>Manajemen Barang Katalog</h2>
                            <p>Kelola barang yang dijual</p>
                        </div>
                    </div>

                    <!-- White Card Container -->
                    <div class="admin-card-below-banner">
                        <!-- Toolbar Filter Row -->
                        <div class="admin-filter-row-v2">
                            <div class="admin-filter-group-v2">
                                <div class="admin-filter-item-v2">
                                    <label for="barangSearchInput">Cari data barang</label>
                                    <div class="admin-search-box-v2" style="width: 280px;">
                                        <span class="search-icon">🔍</span>
                                        <input type="text" id="barangSearchInput" placeholder="Cari nama barang, ID, atau nama penjual" oninput="renderBarangTable()">
                                    </div>
                                </div>
                                <div class="admin-filter-item-v2">
                                    <label for="barangFilterKategori">Filter Kategori</label>
                                    <select id="barangFilterKategori" class="admin-select-v2" onchange="renderBarangTable()">
                                        <option value="all">Semua Kategori</option>
                                        <option value="Pakaian">Pakaian</option>
                                        <option value="Buku">Buku</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Perlengkapan">Perlengkapan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                                <div class="admin-filter-item-v2">
                                    <label for="barangFilterStatus">Filter Status</label>
                                    <select id="barangFilterStatus" class="admin-select-v2" onchange="renderBarangTable()">
                                        <option value="all">Semua Status</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Process">Process</option>
                                        <option value="Terjual">Terjual</option>
                                        <option value="Takedown">Takedown</option>
                                    </select>
                                </div>
                            </div>
                            <div class="admin-total-badge-v2" id="totalBarangCount">Total: 1232</div>
                        </div>

                        <!-- Table Barang Sesuai Screenshot: ID | Nama Barang | Penjual | Kategori | Harga | Status | Aksi -->
                        <div class="admin-table-container-v2">
                            <table class="admin-table-v2">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;">ID</th>
                                        <th>Nama Barang</th>
                                        <th>Penjual</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th style="width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="barangTableBody">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Footer Sesuai Screenshot -->
                    <div class="admin-pagination-card-v2">
                        <div>Menampilkan 1 - 10 dari 1.232 Barang</div>
                        <div class="admin-pagination-pages-v2">
                            <button type="button" class="page-btn-v2">&lt;</button>
                            <button type="button" class="page-btn-v2 active">1</button>
                            <button type="button" class="page-btn-v2">2</button>
                            <button type="button" class="page-btn-v2">3</button>
                            <button type="button" class="page-btn-v2">4</button>
                            <button type="button" class="page-btn-v2">5</button>
                            <button type="button" class="page-btn-v2">&gt;</button>
                        </div>
                    </div>

                </section>

            </div>
        </main>
    </div>

    <!-- ====================================================================
         MODALS (Barang Management Sesuai Screenshot 2026-11-12 113452.png)
         ==================================================================== -->

    <!-- 1. POP UP - Edit status barang -->
    <div id="modalEditBarang" class="admin-modal-backdrop">
        <div class="modal-v2-card">
            <div class="modal-v2-header">
                <h3>Edit Status Barang</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalEditBarang')">&times;</button>
            </div>
            <form id="editBarangForm" onsubmit="handleEditBarangSubmit(event)">
                <input type="hidden" id="editBarangId">
                <div class="modal-v2-body">
                    <!-- Item Info -->
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#1C3563"><path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/></svg>
                            <span id="editBarangNamaView">Jas Lab Kimia Polinema (ID: A1)</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#2563EB"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            <span id="editBarangPenjualView">Rizky</span>
                        </div>
                    </div>

                    <!-- Tindakan -->
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 13.5px; font-weight: 600; color: #1C3563; margin-bottom: 10px;">Tindakan:</div>
                        <div class="modal-v2-radio-row">
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="editBarangTindakan" value="Tersedia" checked>
                                <span>Biarkan Tersedia</span>
                            </label>
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="editBarangTindakan" value="Takedown">
                                <span>Takedown</span>
                            </label>
                        </div>
                    </div>

                    <!-- Alasan Takedown / Catatan -->
                    <div style="margin-bottom: 18px;">
                        <div style="font-size: 13.5px; font-weight: 600; color: #1C3563; margin-bottom: 8px;">Alasan Takedown / Catatan:</div>
                        <input type="text" id="editBarangAlasan" class="modal-v2-input" value="-">
                        <div style="font-size: 11px; color: #5A6E8C; margin-top: 5px;">Catatan ini akan dikirimkan ke email pengguna sebagai notifikasi.</div>
                    </div>

                    <div class="modal-v2-footer-center">
                        <button type="button" class="btn-pill-gray" onclick="closeModal('modalEditBarang')">Batal</button>
                        <button type="submit" class="btn-pill-navy">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. POP UP - Detail status barang & Riwayat Pengajuan -->
    <div id="modalDetailBarang" class="admin-modal-backdrop">
        <div class="modal-v2-card" style="max-width: 580px;">
            <div class="modal-v2-header">
                <h3>Detail Barang &amp; Riwayat Pengajuan</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalDetailBarang')">&times;</button>
            </div>
            <div class="modal-v2-body">
                <!-- Info Header -->
                <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 16px;">
                    <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#1C3563"><path d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z"/></svg>
                        <span id="detailBarangNama">Jas Lab Kimia Polinema (ID: A1)</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#2563EB"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                        <span id="detailBarangPenjual">Rizky</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #16A34A; font-size: 14px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="#22C55E"><path d="M19 6h-2c0-2.76-2.24-5-5-5S7 3.24 7 6H5c-1.1 0-1.99.9-1.99 2L3 20c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-7-3c1.66 0 3 1.34 3 3H9c0-1.66 1.34-3 3-3zm0 10c-2.76 0-5-2.24-5-5h2c0 1.66 1.34 3 3 3s3-1.34 3-3h2c0 2.76-2.24 5-5 5z"/></svg>
                        <span id="detailBarangStatus">Tersedia</span>
                    </div>
                </div>

                <!-- Daftar Pengajuan Masuk -->
                <div style="font-size: 13px; font-weight: 700; color: #1C3563; margin-bottom: 8px;">Daftar Pengajuan Masuk</div>
                <div class="admin-table-container-v2" style="margin-bottom: 14px;">
                    <table class="admin-table-v2" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Pembeli</th>
                                <th>Kampus</th>
                                <th>Waktu Pengajuan</th>
                                <th>Status Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody id="detailBarangPengajuanBody">
                            <!-- Populated dynamically via JS -->
                        </tbody>
                    </table>
                </div>

                <div style="font-size: 11px; color: #5A6E8C; line-height: 1.4; margin-top: 10px;">
                    Catatan Sistem: Hak akses Admin dibatasi. Admin hanya dapat memantau status transaksi tanpa bisa mengubah keputusan penjual
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script>window.CURRENT_ADMIN_PAGE = 'barang';</script>
    <script src="<?= asset('/js/admin.js') ?>"></script>
</body>
</html>
