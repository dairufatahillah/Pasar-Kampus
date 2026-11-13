<?php
$session = get_session();
$adminName = $session['name'] ?? 'Superadmin';
$activeTab = 'kategori';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori Katalog - Portal Superadmin Pasar Kampus</title>
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
                        <strong id="adminCurrentBreadcrumb">Manajemen Kategori Katalog</strong>
                    </div>
                </div>
            </header>

            <div class="admin-content-container">

                <!-- =========================================================
                     VIEW: KATEGORI (Sesuai Screenshot 2026-11-12 110942.png)
                     ========================================================= -->
                <section id="view-kategori" class="admin-view-panel active">
                    
                    <!-- Header Banner -->
                    <div class="admin-page-banner">
                        <div class="admin-page-banner-text">
                            <h2>Manajemen Kategori Katalog</h2>
                            <p>Kelola kategori bawaan untuk filter katalog</p>
                        </div>
                        <button type="button" class="btn-top-banner-add" onclick="openAddKategoriModal()">
                            + Tambah Kategori
                        </button>
                    </div>

                    <!-- White Card Container -->
                    <div class="admin-card-below-banner">
                        <!-- Toolbar Filter Row -->
                        <div class="admin-filter-row-v2">
                            <div class="admin-filter-group-v2">
                                <div class="admin-filter-item-v2">
                                    <label for="kategoriSearchInput">Cari data kategori</label>
                                    <div class="admin-search-box-v2">
                                        <span class="search-icon">🔍</span>
                                        <input type="text" id="kategoriSearchInput" placeholder="Cari kategori" oninput="renderKategoriTable()">
                                    </div>
                                </div>
                                <div class="admin-filter-item-v2">
                                    <label for="kategoriFilterStatus">Filter Status</label>
                                    <select id="kategoriFilterStatus" class="admin-select-v2" onchange="renderKategoriTable()">
                                        <option value="all">Semua Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="admin-total-badge-v2" id="totalKategoriCount">Total: 15</div>
                        </div>

                        <!-- Table Kategori Sesuai Screenshot: ID | Nama Kategori | Jumlah Barang | Status | Aksi -->
                        <div class="admin-table-container-v2">
                            <table class="admin-table-v2">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">ID</th>
                                        <th>Nama Kategori</th>
                                        <th>Jumlah Barang</th>
                                        <th>Status</th>
                                        <th style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="kategoriTableBody">
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
         MODALS (Kategori Management Sesuai Screenshot 2026-11-12 113943.png)
         ==================================================================== -->

    <!-- POP UP - Tambah kategori -->
    <div id="modalKategori" class="admin-modal-backdrop">
        <div class="modal-v2-card" style="max-width: 440px;">
            <div class="modal-v2-header">
                <h3>Tambah Kategori Baru</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalKategori')">&times;</button>
            </div>
            <form id="kategoriForm" onsubmit="handleKategoriSubmit(event)">
                <input type="hidden" id="kategoriId">
                <div class="modal-v2-body">
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Nama kategori</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="text" id="kategoriNama" required class="modal-v2-input" placeholder="Nama kategori...">
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Keterangan</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="text" id="kategoriDeskripsi" class="modal-v2-input" placeholder="Keterangan...">
                        </div>
                    </div>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 13px; font-weight: 600; color: #1C3563; margin-bottom: 8px;">Status:</div>
                        <div class="modal-v2-radio-row">
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="kategoriStatus" value="Aktif" checked>
                                <span>Aktif</span>
                            </label>
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="kategoriStatus" value="Nonaktif">
                                <span>Nonaktif</span>
                            </label>
                        </div>
                    </div>

                    <div class="modal-v2-footer-center">
                        <button type="button" class="btn-pill-gray" onclick="closeModal('modalKategori')">Batal</button>
                        <button type="submit" class="btn-pill-navy">Simpan Kategori</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script>window.CURRENT_ADMIN_PAGE = 'kategori';</script>
    <script src="<?= asset('/js/admin.js') ?>"></script>
</body>
</html>
