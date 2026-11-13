<?php
$session = get_session();
$adminName = $session['name'] ?? 'Superadmin';
$activeTab = 'report';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Aduan Masuk - Portal Superadmin Pasar Kampus</title>
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
                        <strong id="adminCurrentBreadcrumb">Laporan Aduan Masuk</strong>
                    </div>
                </div>
            </header>

            <div class="admin-content-container">

                <!-- =========================================================
                     VIEW: REPORT (Sesuai Screenshot 2026-11-12 111022.png)
                     ========================================================= -->
                <section id="view-report" class="admin-view-panel active">
                    
                    <!-- Header Banner -->
                    <div class="admin-page-banner">
                        <div class="admin-page-banner-text">
                            <h2>Laporan Aduan Masuk</h2>
                            <p>Kelola laporan aduan yang masuk</p>
                        </div>
                    </div>

                    <!-- White Card Container -->
                    <div class="admin-card-below-banner">
                        <div style="display: flex; justify-content: flex-end; margin-bottom: 14px;">
                            <div class="admin-total-badge-v2" id="totalReportCount">Total: 28</div>
                        </div>

                        <!-- Table Report Sesuai Screenshot: ID | Pelapor | Terlapor | Alasan | Bukti | Status | Aksi -->
                        <div class="admin-table-container-v2">
                            <table class="admin-table-v2">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">ID</th>
                                        <th>Pelapor</th>
                                        <th>Terlapor</th>
                                        <th>Alasan</th>
                                        <th>Bukti</th>
                                        <th>Status</th>
                                        <th style="width: 170px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="reportTableBody">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Footer Sesuai Screenshot -->
                    <div class="admin-pagination-card-v2">
                        <div>Menampilkan 1 - 10 dari 28 Laporan</div>
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
         MODALS (Report Management Sesuai Screenshot 2026-11-12 114151.png)
         ==================================================================== -->

    <!-- POP UP - Tinjau laporan -->
    <div id="modalTinjauReport" class="admin-modal-backdrop">
        <div class="modal-v2-card" style="max-width: 480px;">
            <div class="modal-v2-header">
                <h3>Tinjau laporan Aduan</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalTinjauReport')">&times;</button>
            </div>
            <form id="tinjauReportForm" onsubmit="handleEksekusiReportSubmit(event)">
                <input type="hidden" id="tinjauReportId">
                <div class="modal-v2-body">
                    <div style="font-size: 13.5px; font-weight: 700; color: #1C3563; margin-bottom: 12px;">Informasi &amp; Bukti Aduan</div>
                    
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px; font-size: 13px;">
                        <div style="display: flex;">
                            <span style="width: 90px; color: #1E293B; font-weight: 600;">Pelapor</span>
                            <span style="margin-right: 8px;">:</span>
                            <span id="tinjauPelapor" style="font-weight: 600; color: #1E293B;">Doni</span>
                        </div>
                        <div style="display: flex;">
                            <span style="width: 90px; color: #1E293B; font-weight: 600;">Terlapor</span>
                            <span style="margin-right: 8px;">:</span>
                            <span id="tinjauTerlapor" style="font-weight: 600; color: #1E293B;">Andi</span>
                        </div>
                        <div style="display: flex;">
                            <span style="width: 90px; color: #1E293B; font-weight: 600;">Alasan</span>
                            <span style="margin-right: 8px;">:</span>
                            <span id="tinjauAlasan" style="color: #1E293B;">Penipuan / Barang Palsu</span>
                        </div>
                    </div>

                    <!-- Alasan Takedown / Catatan -->
                    <div style="margin-bottom: 14px;">
                        <div style="font-size: 13px; font-weight: 600; color: #1C3563; margin-bottom: 6px;">Alasan Takedown / Catatan:</div>
                        <input type="text" id="tinjauCatatan" class="modal-v2-input" value="Barang tidak sesuai dengan foto">
                    </div>

                    <!-- Bukti Foto -->
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 13px; font-weight: 600; color: #1C3563; margin-bottom: 6px;">Bukti Foto:</div>
                        <div id="tinjauBuktiBox" style="width: 65px; height: 65px; border: 1.5px dashed #CBD5E1; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 12px; color: #94A3B8; background: #F8FAFC;">
                            IMG
                        </div>
                    </div>

                    <!-- Tindakan -->
                    <div style="margin-bottom: 18px;">
                        <div style="font-size: 13px; font-weight: 600; color: #1C3563; margin-bottom: 8px;">Tindakan:</div>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <div class="modal-v2-radio-row" style="flex-wrap: wrap;">
                                <label class="modal-v2-radio-label">
                                    <input type="radio" name="tinjauTindakan" value="Abaikan Laporan" checked>
                                    <span>Abaikan Laporan</span>
                                </label>
                                <label class="modal-v2-radio-label">
                                    <input type="radio" name="tinjauTindakan" value="Suspend Akun Terlapor">
                                    <span>Suspend Akun Terlapor</span>
                                </label>
                                <label class="modal-v2-radio-label">
                                    <input type="radio" name="tinjauTindakan" value="Banned Permanen Akun Terlapor">
                                    <span>Banned Permanen Akun Terlapor</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-v2-footer-center">
                        <button type="button" class="btn-pill-gray" onclick="closeModal('modalTinjauReport')">Batal</button>
                        <button type="submit" class="btn-pill-navy">Eksekusi Keputusan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script>window.CURRENT_ADMIN_PAGE = 'report';</script>
    <script src="<?= asset('/js/admin.js') ?>"></script>
</body>
</html>
