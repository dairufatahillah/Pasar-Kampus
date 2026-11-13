<?php
$session = get_session();
$adminName = $session['name'] ?? 'Superadmin';
$activeTab = 'users';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Portal Superadmin Pasar Kampus</title>
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
                            <a href="<?= route('/dashboard/pengajuan.php') ?>" id="nav-pengajuan" class="admin-nav-link <?= $activeTab === 'pengajuan' ? 'active' : '' ?>">
                                <span>Pengajuan</span>
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
                        <strong id="adminCurrentBreadcrumb">Manajemen Pengguna (User)</strong>
                    </div>
                </div>
            </header>

            <div class="admin-content-container">

                <!-- =========================================================
                     VIEW: KELOLA USER (Sesuai Screenshot 2026-11-12 110556.png)
                     ========================================================= -->
                <section id="view-users" class="admin-view-panel active">
                    
                    <!-- Header Banner Sesuai Screenshot 2026-11-12 110556.png -->
                    <div class="admin-page-banner">
                        <div class="admin-page-banner-text">
                            <h2>Manajemen Pengguna (User)</h2>
                            <p>Ringkasan aktivitas PasarKampus hari ini</p>
                        </div>
                        <button type="button" class="btn-top-banner-add" onclick="openAddUserModal()">
                            + Tambah User
                        </button>
                    </div>

                    <!-- White Card Container -->
                    <div class="admin-card-below-banner">
                        <!-- Toolbar Filter Row -->
                        <div class="admin-filter-row-v2">
                            <div class="admin-filter-group-v2">
                                <div class="admin-filter-item-v2">
                                    <label for="userSearchInput">Cari data user</label>
                                    <div class="admin-search-box-v2">
                                        <span class="search-icon">🔍</span>
                                        <input type="text" id="userSearchInput" placeholder="Cari Nama, atau NIM..." oninput="renderUsersTable()">
                                    </div>
                                </div>
                                <div class="admin-filter-item-v2">
                                    <label for="userFilterKampus">Filter Kampus Asal</label>
                                    <select id="userFilterKampus" class="admin-select-v2" onchange="renderUsersTable()">
                                        <option value="all">Semua kampus</option>
                                        <option value="Universitas Brawijaya">Universitas Brawijaya</option>
                                        <option value="Universitas Negeri Malang">Universitas Negeri Malang</option>
                                        <option value="Politeknik Negeri Malang">Politeknik Negeri Malang</option>
                                        <option value="Binus University">Binus University</option>
                                        <option value="Universitas Merdeka Malang">Universitas Merdeka Malang</option>
                                    </select>
                                </div>
                                <div class="admin-filter-item-v2">
                                    <label for="userFilterStatus">Filter Status User</label>
                                    <select id="userFilterStatus" class="admin-select-v2" onchange="renderUsersTable()">
                                        <option value="all">Semua Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Suspend">Suspend</option>
                                        <option value="Banned">Banned</option>
                                    </select>
                                </div>
                            </div>
                            <div class="admin-total-badge-v2" id="totalUserCount">Total: 1945 User</div>
                        </div>

                        <!-- User Table Sesuai Screenshot: ID | Nama Lengkap | NIM | Kampus | Status | Aksi -->
                        <div class="admin-table-container-v2">
                            <table class="admin-table-v2">
                                <thead>
                                    <tr>
                                        <th style="width: 70px;">ID</th>
                                        <th>Nama Lengkap</th>
                                        <th>NIM</th>
                                        <th>Kampus</th>
                                        <th>Status</th>
                                        <th style="width: 140px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="userTableBody">
                                    <!-- Populated dynamically via JS -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination Footer Sesuai Screenshot -->
                    <div class="admin-pagination-card-v2">
                        <div id="userPaginationLabel">Menampilkan 1 - 10 dari 1.945 user</div>
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
         MODALS (Users Management Sesuai Screenshot 2026-11-12 111455.png)
         ==================================================================== -->

    <!-- 1. POP UP - Tambah user -->
    <div id="modalAddUser" class="admin-modal-backdrop">
        <div class="modal-v2-card">
            <div class="modal-v2-header">
                <h3>Tambah Pengguna Baru</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalAddUser')">&times;</button>
            </div>
            <form id="addUserForm" onsubmit="handleAddUserSubmit(event)">
                <div class="modal-v2-body">
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Nama Lengkap</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="text" id="newUserName" required class="modal-v2-input" placeholder="Isi nama lengkap...">
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>NIM</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="text" id="newUserNim" required class="modal-v2-input" placeholder="Isi NIM...">
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Email</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="email" id="newUserEmail" required class="modal-v2-input" placeholder="Isi Email...">
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Kata Sandi</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <input type="password" id="newUserPassword" required class="modal-v2-input" placeholder="Isi Kata sandi..." value="password123">
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Asal Kampus</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <select id="newUserKampus" class="modal-v2-select">
                                <option value="" disabled selected>Pilih Kampus</option>
                                <option value="Universitas Brawijaya">Universitas Brawijaya</option>
                                <option value="Universitas Negeri Malang">Universitas Negeri Malang</option>
                                <option value="Politeknik Negeri Malang">Politeknik Negeri Malang</option>
                                <option value="Binus University">Binus University</option>
                                <option value="Universitas Merdeka Malang">Universitas Merdeka Malang</option>
                                <option value="Univ. Muhammadiyah Malang">Univ. Muhammadiyah Malang</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-v2-grid-row">
                        <div class="modal-v2-grid-label"><span>Role Akun</span> <span>:</span></div>
                        <div class="modal-v2-grid-input-wrap">
                            <div class="modal-v2-radio-row">
                                <label class="modal-v2-radio-label">
                                    <input type="radio" name="newUserRole" value="Mahasiswa" checked>
                                    <span>Mahasiswa</span>
                                </label>
                                <label class="modal-v2-radio-label">
                                    <input type="radio" name="newUserRole" value="Admin">
                                    <span>Admin</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-v2-footer-center">
                        <button type="button" class="btn-pill-gray" onclick="closeModal('modalAddUser')">Batal</button>
                        <button type="submit" class="btn-pill-navy">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 2. POP UP - Edit status pengguna -->
    <div id="modalEditUser" class="admin-modal-backdrop">
        <div class="modal-v2-card">
            <div class="modal-v2-header">
                <h3>Edit Status Pengguna</h3>
                <button type="button" class="modal-v2-close-btn" onclick="closeModal('modalEditUser')">&times;</button>
            </div>
            <form id="editUserForm" onsubmit="handleEditUserSubmit(event)">
                <input type="hidden" id="editUserId">
                <div class="modal-v2-body">
                    <!-- Informasi Pengguna Sesuai Screenshot -->
                    <div style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 18px;">
                        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#8B5CF6"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            <span id="editUserNameView">Alfiansyah (NIM: 2422141241)</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px; font-weight: 700; color: #0F172A; font-size: 14px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#F59E0B"><path d="M5 13.18v4L12 21l7-3.82v-4L12 17l-7-3.82zM12 3L1 9l11 6 9-4.91V17h2V9L12 3z"/></svg>
                            <span id="editUserKampusView">Universitas Negeri Malang</span>
                        </div>
                    </div>

                    <!-- Status Akun -->
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 13.5px; font-weight: 600; color: #1C3563; margin-bottom: 10px;">Status Akun:</div>
                        <div class="modal-v2-radio-row">
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="editUserStatus" value="Aktif">
                                <span>Aktif</span>
                            </label>
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="editUserStatus" value="Suspend">
                                <span>Suspend</span>
                            </label>
                            <label class="modal-v2-radio-label">
                                <input type="radio" name="editUserStatus" value="Banned">
                                <span>Banned</span>
                            </label>
                        </div>
                    </div>

                    <!-- Alasan Sanksi / Catatan -->
                    <div style="margin-bottom: 18px;">
                        <div style="font-size: 13.5px; font-weight: 600; color: #1C3563; margin-bottom: 8px;">Alasan Sanksi / Catatan:</div>
                        <input type="text" id="editUserSanksi" class="modal-v2-input" placeholder="Terbukti melanggar aturan hit-and-run 3x berturut-turut">
                        <div style="font-size: 11px; color: #5A6E8C; margin-top: 5px;">Catatan ini akan dikirimkan ke email pengguna sebagai notifikasi.</div>
                    </div>

                    <div class="modal-v2-footer-center">
                        <button type="button" class="btn-pill-gray" onclick="closeModal('modalEditUser')">Batal</button>
                        <button type="submit" class="btn-pill-navy">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Files -->
    <script>window.CURRENT_ADMIN_PAGE = 'users';</script>
    <script src="<?= asset('/js/admin.js') ?>"></script>
</body>
</html>
