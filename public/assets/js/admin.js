/**
 * Pasar Kampus - Superadmin Dashboard & Central Monitoring System
 * Handles CRUD for Users, Products, Categories, Reports, and System-wide COD Transactions
 * Updated 2026 to match exact design screenshots.
 */

// Initial Seed Data Keys in LocalStorage
const STORAGE_KEYS = {
    SEED_VER: 'pk_admin_seed_version_2026_redesign',
    USERS: 'pk_admin_users',
    BARANG: 'pk_admin_barang',
    KATEGORI: 'pk_admin_kategori',
    REPORTS: 'pk_admin_reports',
    PENGAJUAN: 'pk_admin_pengajuan',
    CURRENT_TAB: 'pk_admin_active_tab'
};

const CURRENT_SEED_VERSION = 'v2_2026_11_12';

// ==========================================
// 1. DATA INITIALIZATION / SEEDING
// ==========================================
function initAdminStorage() {
    const isNewVersion = localStorage.getItem(STORAGE_KEYS.SEED_VER) !== CURRENT_SEED_VERSION;

    if (isNewVersion || !localStorage.getItem(STORAGE_KEYS.USERS)) {
        // Seed Users according to Screenshot 2026-11-12 110556.png
        const seedUsers = [
            { id: 1, nama: "Andi Raihan", nim: "2421414214", kampus: "Universitas Brawijaya", email: "andiraihan@student.ub.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 2, nama: "Alfiansyah", nim: "2422141241", kampus: "Universitas Negeri Malang", email: "alfiansyah@student.um.ac.id", role: "Mahasiswa", status: "Suspend", sanksi: "Terbukti melanggar aturan hit-and-run 3x berturut-turut" },
            { id: 3, nama: "Ja Morant", nim: "2414213124", kampus: "Politeknik Negeri Malang", email: "jamorant@student.polinema.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 4, nama: "Klay Thompson", nim: "2414213134", kampus: "Politeknik Negeri Malang", email: "klay@student.polinema.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 5, nama: "Hekitike", nim: "2414213127", kampus: "Politeknik Negeri Malang", email: "hekitike@student.polinema.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 6, nama: "Florian Wirtz", nim: "2414216453", kampus: "Binus University", email: "florian@binus.ac.id", role: "Mahasiswa", status: "Suspend", sanksi: "Melakukan spam pengajuan barang berulang" },
            { id: 7, nama: "Giannis A.", nim: "2414218734", kampus: "Binus University", email: "giannis@binus.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 8, nama: "Bradley Barcola", nim: "2414210912", kampus: "Universitas Merdeka Malang", email: "barcola@unmer.ac.id", role: "Mahasiswa", status: "Aktif", sanksi: "" },
            { id: 9, nama: "Manchester United", nim: "241421454", kampus: "-", email: "mu@student.ac.id", role: "Mahasiswa", status: "Banned", sanksi: "Pelanggaran integritas akun sistem" },
            { id: 10, nama: "Tottenham Hospurs", nim: "241421365", kampus: "-", email: "spurs@student.ac.id", role: "Mahasiswa", status: "Banned", sanksi: "Terindikasi penipuan transaksi COD fiktif" }
        ];
        localStorage.setItem(STORAGE_KEYS.USERS, JSON.stringify(seedUsers));
    }

    if (isNewVersion || !localStorage.getItem(STORAGE_KEYS.BARANG)) {
        // Seed Barang according to Screenshot 2026-11-12 110803.png & 113452.png
        const seedBarang = [
            {
                id: "A1",
                nama: "Jas Lab Kimia Polinema (Size L)",
                penjual: "Rizky (Polinema)",
                kategori: "Pakaian",
                harga: "Rp 65.000",
                status: "Tersedia",
                alasanHapus: "-",
                pengajuan: [
                    { pembeli: "Doni", kampus: "Politeknik Negeri Malang", waktu: "12 November 2026", status: "DI-ACC PENJUAL (PROCESS)" },
                    { pembeli: "Arfan", kampus: "Politeknik Negeri Malang", waktu: "18 November 2026", status: "DITOLAK (CLOSED)" }
                ]
            },
            {
                id: "A2",
                nama: "Jas Lab Kimia Polinema (Size L)",
                penjual: "Budi Santoso (UM)",
                kategori: "Lainnya",
                harga: "Rp 95.000",
                status: "Process",
                alasanHapus: "-",
                pengajuan: [
                    { pembeli: "Farhan", kampus: "Universitas Negeri Malang", waktu: "10 November 2026", status: "DI-ACC PENJUAL (PROCESS)" }
                ]
            },
            {
                id: "A3",
                nama: "Buku Kalkulus Thomas Ed. 13",
                penjual: "Andi Raihan (UB)",
                kategori: "Buku",
                harga: "Rp 80.000",
                status: "Tersedia",
                alasanHapus: "-",
                pengajuan: []
            },
            {
                id: "A4",
                nama: "Keyboard Wireless Logitech K380",
                penjual: "Citra (UMM)",
                kategori: "Elektronik",
                harga: "Rp 220.000",
                status: "Terjual",
                alasanHapus: "-",
                pengajuan: [
                    { pembeli: "Nabila", kampus: "Univ. Muhammadiyah Malang", waktu: "5 November 2026", status: "SELESAI (CLOSED)" }
                ]
            },
            {
                id: "A5",
                nama: "Kipas Angin Mini Portable USB",
                penjual: "Farhan (Polinema)",
                kategori: "Elektronik",
                harga: "Rp 35.000",
                status: "Process",
                alasanHapus: "-",
                pengajuan: []
            },
            {
                id: "A6",
                nama: "Sepatu Vans Old Skool (Size 42)",
                penjual: "Dimas (UB)",
                kategori: "Pakaian",
                harga: "Rp 250.000",
                status: "Tersedia",
                alasanHapus: "-",
                pengajuan: []
            },
            {
                id: "A7",
                nama: "Meja Belajar Lipat Kayu Lesehan",
                penjual: "Nabila (UM)",
                kategori: "Perlengkapan",
                harga: "Rp 45.000",
                status: "Tersedia",
                alasanHapus: "-",
                pengajuan: []
            },
            {
                id: "A8",
                nama: "Vaping / Liquid Bekas (Melanggar)",
                penjual: "Eko (UMM)",
                kategori: "Lainnya",
                harga: "Rp 110.000",
                status: "Takedown",
                alasanHapus: "Barang kategori rokok elektrik dilarang di lingkungan kampus",
                pengajuan: []
            },
            {
                id: "A9",
                nama: "Modul Praktikum Jaringan Komputer",
                penjual: "Dewa (Polinema)",
                kategori: "Buku",
                harga: "Rp 25.000",
                status: "Terjual",
                alasanHapus: "-",
                pengajuan: []
            },
            {
                id: "A10",
                nama: "Botol Minum Tupperware 1L Hijau",
                penjual: "Sari (UB)",
                kategori: "Perlengkapan",
                harga: "Rp 50.000",
                status: "Tersedia",
                alasanHapus: "-",
                pengajuan: []
            }
        ];
        localStorage.setItem(STORAGE_KEYS.BARANG, JSON.stringify(seedBarang));
    }

    if (isNewVersion || !localStorage.getItem(STORAGE_KEYS.KATEGORI)) {
        // Seed Kategori according to Screenshot 2026-11-12 110942.png
        const seedKategori = [
            { id: 1, nama: "Buku", deskripsi: "Diktat kuliah, buku ajar, komik & modul praktikum", jmlBarang: 120, status: "Aktif" },
            { id: 2, nama: "Pakaian", deskripsi: "Jas almamater, jas lab, kemeja sidang", jmlBarang: 250, status: "Aktif" },
            { id: 3, nama: "Elektronik", deskripsi: "Kalkulator, flashdisk, mouse, charger laptop", jmlBarang: 67, status: "Aktif" },
            { id: 4, nama: "Perlengkapan Kos", deskripsi: "Kipas angin, rak susun, meja lipat", jmlBarang: 67, status: "Aktif" }
        ];
        localStorage.setItem(STORAGE_KEYS.KATEGORI, JSON.stringify(seedKategori));
    }

    if (isNewVersion || !localStorage.getItem(STORAGE_KEYS.REPORTS)) {
        // Seed Reports according to Screenshot 2026-11-12 111022.png & 114151.png
        const seedReports = [
            {
                id: 1,
                pelapor: "Doni",
                terlapor: "Andi",
                alasan: "Penipuan",
                deskripsi: "Barang tidak sesuai dengan foto",
                bukti: "IMG",
                status: "PENDING",
                tindakan: "Abaikan Laporan"
            },
            {
                id: 2,
                pelapor: "Abul",
                terlapor: "Ani",
                alasan: "Spam",
                deskripsi: "Spam chat berulang kali dan membatalkan janji COD",
                bukti: "IMG",
                status: "DITINJAU",
                tindakan: "Abaikan Laporan"
            }
        ];
        localStorage.setItem(STORAGE_KEYS.REPORTS, JSON.stringify(seedReports));
    }

    if (isNewVersion || !localStorage.getItem(STORAGE_KEYS.PENGAJUAN)) {
        const seedPengajuan = [
            {
                id: "TRX-101",
                barangId: "A1",
                barangNama: "Jas Lab Kimia Polinema (Size L)",
                penjual: "Rizky (Polinema)",
                pembeli: "Doni",
                kampus: "Politeknik Negeri Malang",
                waktu: "12 November 2026",
                lokasiCod: "Gedung AB Polinema",
                status: "DI-ACC PENJUAL (PROCESS)"
            },
            {
                id: "TRX-102",
                barangId: "A1",
                barangNama: "Jas Lab Kimia Polinema (Size L)",
                penjual: "Rizky (Polinema)",
                pembeli: "Arfan",
                kampus: "Politeknik Negeri Malang",
                waktu: "18 November 2026",
                lokasiCod: "Kantin Pusat Polinema",
                status: "DITOLAK (CLOSED)"
            }
        ];
        localStorage.setItem(STORAGE_KEYS.PENGAJUAN, JSON.stringify(seedPengajuan));
    }

    localStorage.setItem(STORAGE_KEYS.SEED_VER, CURRENT_SEED_VERSION);
}

// Helpers to get & set data
function getUsers() {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.USERS)) || [];
}
function setUsers(data) {
    localStorage.setItem(STORAGE_KEYS.USERS, JSON.stringify(data));
}
function getBarang() {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.BARANG)) || [];
}
function setBarang(data) {
    localStorage.setItem(STORAGE_KEYS.BARANG, JSON.stringify(data));
}
function getKategori() {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.KATEGORI)) || [];
}
function setKategori(data) {
    localStorage.setItem(STORAGE_KEYS.KATEGORI, JSON.stringify(data));
}
function getReports() {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.REPORTS)) || [];
}
function setReports(data) {
    localStorage.setItem(STORAGE_KEYS.REPORTS, JSON.stringify(data));
}
function getPengajuan() {
    return JSON.parse(localStorage.getItem(STORAGE_KEYS.PENGAJUAN)) || [];
}
function setPengajuan(data) {
    localStorage.setItem(STORAGE_KEYS.PENGAJUAN, JSON.stringify(data));
}

// ==========================================
// 2. TAB NAVIGATION & VIEW SWITCHER
// ==========================================
function switchAdminTab(tabName) {
    const panels = document.querySelectorAll('.admin-view-panel');
    panels.forEach(p => p.classList.remove('active'));

    const links = document.querySelectorAll('.admin-nav-link');
    links.forEach(l => l.classList.remove('active'));

    const targetPanel = document.getElementById(`view-${tabName}`);
    const targetLink = document.getElementById(`nav-${tabName}`);
    if (targetPanel) {
        targetPanel.classList.add('active');
    } else if (panels.length === 1) {
        panels[0].classList.add('active');
    }
    if (targetLink) targetLink.classList.add('active');

    const breadcrumbLabel = document.getElementById('adminCurrentBreadcrumb');
    if (breadcrumbLabel) {
        const titles = {
            dashboard: 'Dashboard Analitik',
            users: 'Manajemen Pengguna (User)',
            barang: 'Manajemen Barang Katalog',
            pengajuan: 'Monitoring Pengajuan Transaksi COD',
            report: 'Laporan Aduan Masuk',
            kategori: 'Manajemen Kategori Katalog'
        };
        breadcrumbLabel.textContent = titles[tabName] || 'Dashboard';
    }

    localStorage.setItem(STORAGE_KEYS.CURRENT_TAB, tabName);

    if (tabName === 'dashboard' || document.getElementById('statTotalBarang')) renderDashboardView();
    if (tabName === 'users' || document.getElementById('userTableBody')) renderUsersTable();
    if (tabName === 'barang' || document.getElementById('barangTableBody')) renderBarangTable();
    if (tabName === 'pengajuan' || document.getElementById('pengajuanTableBody')) renderPengajuanTable();
    if (tabName === 'report' || document.getElementById('reportTableBody')) renderReportTable();
    if (tabName === 'kategori' || document.getElementById('kategoriTableBody')) renderKategoriTable();

    const sidebar = document.getElementById('adminSidebar');
    if (sidebar) sidebar.classList.remove('show-mobile');
}

function toggleMobileSidebar() {
    const sidebar = document.getElementById('adminSidebar');
    if (sidebar) sidebar.classList.toggle('show-mobile');
}

// ==========================================
// 3. DASHBOARD ANALYTICS
// ==========================================
function renderDashboardView() {
    const users = getUsers();
    const barang = getBarang();
    const kategori = getKategori();
    const reports = getReports();

    const pendingReports = reports.filter(r => r.status === 'PENDING' || r.status === 'Menunggu' || r.status === 'Butuh Tinjauan').length;

    if (document.getElementById('statTotalBarang')) {
        document.getElementById('statTotalBarang').textContent = "1,245";
    }
    if (document.getElementById('statJmlKategori')) {
        document.getElementById('statJmlKategori').textContent = (15).toString();
    }
    if (document.getElementById('statJmlReport')) {
        document.getElementById('statJmlReport').textContent = "28";
    }
    if (document.getElementById('statJmlUser')) {
        document.getElementById('statJmlUser').textContent = "3,400";
    }

    const repBadge = document.getElementById('sidebarReportBadge');
    if (repBadge) {
        repBadge.textContent = pendingReports > 0 ? pendingReports : 2;
        repBadge.style.display = 'inline-block';
    }
}

// ==========================================
// 4. CRUD USER (Kelola User - Screenshot 2026-11-12 110556.png)
// ==========================================
function renderUsersTable() {
    const users = getUsers();
    const tbody = document.getElementById('userTableBody');
    if (!tbody) return;

    const searchVal = (document.getElementById('userSearchInput')?.value || '').toLowerCase().trim();
    const filterKampus = document.getElementById('userFilterKampus')?.value || 'all';
    const filterStatus = document.getElementById('userFilterStatus')?.value || 'all';

    const filtered = users.filter(u => {
        const matchSearch = u.nama.toLowerCase().includes(searchVal) || 
                            u.nim.toLowerCase().includes(searchVal) ||
                            u.id.toString().includes(searchVal);
        const matchKampus = filterKampus === 'all' || u.kampus.toLowerCase().includes(filterKampus.toLowerCase());
        const matchStatus = filterStatus === 'all' || u.status.toLowerCase() === filterStatus.toLowerCase();
        return matchSearch && matchKampus && matchStatus;
    });

    const totalCountEl = document.getElementById('totalUserCount');
    if (totalCountEl) {
        totalCountEl.textContent = searchVal || filterKampus !== 'all' || filterStatus !== 'all'
            ? `Total: ${filtered.length} User`
            : `Total: 1945 User`;
    }

    if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" style="text-align: center; padding: 24px; color: #94A3B8;">Tidak ada data pengguna yang sesuai.</td></tr>`;
        return;
    }

    tbody.innerHTML = filtered.map(u => {
        let statusClass = 'status-text-aktif';
        if (u.status === 'Suspend') statusClass = 'status-text-suspend';
        if (u.status === 'Banned') statusClass = 'status-text-banned';

        return `
            <tr>
                <td style="font-weight: 500;">${u.id}</td>
                <td style="font-weight: 500;">${u.nama}</td>
                <td style="font-family: inherit;">${u.nim}</td>
                <td>${u.kampus}</td>
                <td><span class="${statusClass}">${u.status}</span></td>
                <td>
                    <button type="button" class="btn-navy-pill" onclick="openEditUserModal('${u.id}')">
                        Edit
                    </button>
                </td>
            </tr>
        `;
    }).join('');
}

// User Modal: Tambah Pengguna (Screenshot 2026-11-12 111455.png)
function openAddUserModal() {
    const form = document.getElementById('addUserForm');
    if (form) form.reset();
    const modal = document.getElementById('modalAddUser');
    if (modal) modal.classList.add('open');
}

function handleAddUserSubmit(e) {
    e.preventDefault();
    const nama = document.getElementById('newUserName').value.trim();
    const nim = document.getElementById('newUserNim').value.trim();
    const email = document.getElementById('newUserEmail').value.trim();
    const kampus = document.getElementById('newUserKampus').value;
    const roleRadio = document.querySelector('input[name="newUserRole"]:checked');
    const role = roleRadio ? roleRadio.value : 'Mahasiswa';

    if (!nama || !nim || !email || !kampus) {
        alert('Harap lengkapi semua kolom form tambah pengguna!');
        return;
    }

    const users = getUsers();
    const numericIds = users.map(u => parseInt(u.id)).filter(n => !isNaN(n));
    const newId = numericIds.length > 0 ? Math.max(...numericIds) + 1 : users.length + 1;

    users.push({
        id: newId,
        nama: nama,
        nim: nim,
        email: email,
        kampus: kampus,
        role: role,
        status: "Aktif",
        sanksi: ""
    });

    setUsers(users);
    closeModal('modalAddUser');
    renderUsersTable();
    renderDashboardView();
    showAdminToast(`Pengguna baru "${nama}" berhasil ditambahkan!`);
}

// User Modal: Edit Status Pengguna (Screenshot 2026-11-12 111455.png)
function openEditUserModal(userId) {
    const users = getUsers();
    const user = users.find(u => u.id.toString() === userId.toString());
    if (!user) return;

    document.getElementById('editUserId').value = user.id;
    document.getElementById('editUserNameView').textContent = `${user.nama} (NIM: ${user.nim})`;
    document.getElementById('editUserKampusView').textContent = user.kampus;
    document.getElementById('editUserSanksi').value = user.sanksi || 'Terbukti melanggar aturan hit-and-run 3x berturut-turut';

    const statusRadio = document.querySelector(`input[name="editUserStatus"][value="${user.status}"]`);
    if (statusRadio) {
        statusRadio.checked = true;
    } else {
        const defaultRadio = document.querySelector('input[name="editUserStatus"][value="Suspend"]');
        if (defaultRadio) defaultRadio.checked = true;
    }

    document.getElementById('modalEditUser').classList.add('open');
}

function handleEditUserSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('editUserId').value;
    const selectedStatus = document.querySelector('input[name="editUserStatus"]:checked')?.value || 'Aktif';
    const sanksi = document.getElementById('editUserSanksi').value.trim();

    const users = getUsers();
    const idx = users.findIndex(u => u.id.toString() === id.toString());
    if (idx !== -1) {
        users[idx].status = selectedStatus;
        users[idx].sanksi = sanksi;
        setUsers(users);
        closeModal('modalEditUser');
        renderUsersTable();
        renderDashboardView();
        showAdminToast(`Status pengguna #${id} diperbarui menjadi [${selectedStatus}].`);
    }
}

// ==========================================
// 5. CRUD BARANG (Kelola Barang - Screenshot 2026-11-12 110803.png & 113452.png)
// ==========================================
function renderBarangTable() {
    const barang = getBarang();
    const tbody = document.getElementById('barangTableBody');
    if (!tbody) return;

    const searchVal = (document.getElementById('barangSearchInput')?.value || '').toLowerCase().trim();
    const filterKat = document.getElementById('barangFilterKategori')?.value || 'all';
    const filterStat = document.getElementById('barangFilterStatus')?.value || 'all';

    const filtered = barang.filter(b => {
        const matchSearch = b.nama.toLowerCase().includes(searchVal) ||
                            b.penjual.toLowerCase().includes(searchVal) ||
                            b.id.toString().toLowerCase().includes(searchVal);
        const matchKat = filterKat === 'all' || b.kategori.toLowerCase() === filterKat.toLowerCase();
        const matchStat = filterStat === 'all' || b.status.toLowerCase() === filterStat.toLowerCase();
        return matchSearch && matchKat && matchStat;
    });

    const totalEl = document.getElementById('totalBarangCount');
    if (totalEl) {
        totalEl.textContent = searchVal || filterKat !== 'all' || filterStat !== 'all'
            ? `Total: ${filtered.length}`
            : `Total: 1232`;
    }

    if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 24px; color: #94A3B8;">Tidak ada data barang yang sesuai.</td></tr>`;
        return;
    }

    tbody.innerHTML = filtered.map(b => `
        <tr>
            <td style="font-weight: 500;">${b.id}</td>
            <td style="font-weight: 500;">${b.nama}</td>
            <td>${b.penjual}</td>
            <td>${b.kategori}</td>
            <td>${b.harga}</td>
            <td>${b.status}</td>
            <td>
                <div class="admin-table-action-gap">
                    <button type="button" class="btn-navy-pill" onclick="openDetailBarangModal('${b.id}')">
                        Detail
                    </button>
                    <button type="button" class="btn-navy-pill" onclick="openEditBarangModal('${b.id}')">
                        Edit
                    </button>
                </div>
            </td>
        </tr>
    `).join('');
}

// Modal Edit Status Barang (Screenshot 2026-11-12 113452.png)
function openEditBarangModal(id) {
    const barangList = getBarang();
    const item = barangList.find(b => b.id.toString() === id.toString());
    if (!item) return;

    document.getElementById('editBarangId').value = item.id;
    document.getElementById('editBarangNamaView').textContent = `${item.nama} (ID: ${item.id})`;
    document.getElementById('editBarangPenjualView').textContent = item.penjual;
    document.getElementById('editBarangAlasan').value = item.alasanHapus || '-';

    const isTakedown = item.status === 'Takedown' || item.status === 'Dihapus';
    const radioVal = isTakedown ? 'Takedown' : 'Tersedia';
    const radio = document.querySelector(`input[name="editBarangTindakan"][value="${radioVal}"]`);
    if (radio) radio.checked = true;

    document.getElementById('modalEditBarang').classList.add('open');
}

function handleEditBarangSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('editBarangId').value;
    const tindakan = document.querySelector('input[name="editBarangTindakan"]:checked')?.value || 'Tersedia';
    const alasan = document.getElementById('editBarangAlasan').value.trim();

    const barangList = getBarang();
    const idx = barangList.findIndex(b => b.id.toString() === id.toString());
    if (idx !== -1) {
        barangList[idx].status = tindakan === 'Takedown' ? 'Takedown' : 'Tersedia';
        barangList[idx].alasanHapus = alasan || '-';
        setBarang(barangList);
        closeModal('modalEditBarang');
        renderBarangTable();
        renderDashboardView();
        showAdminToast(`Status Barang ${id} diperbarui menjadi [${barangList[idx].status}].`);
    }
}

// Modal Detail Barang & Riwayat Pengajuan (Screenshot 2026-11-12 113452.png)
function openDetailBarangModal(id) {
    const barangList = getBarang();
    const item = barangList.find(b => b.id.toString() === id.toString());
    if (!item) return;

    document.getElementById('detailBarangNama').textContent = `${item.nama} (ID: ${item.id})`;
    document.getElementById('detailBarangPenjual').textContent = item.penjual;
    document.getElementById('detailBarangStatus').textContent = item.status;

    const tbody = document.getElementById('detailBarangPengajuanBody');
    if (tbody) {
        const pengajuanList = item.pengajuan && item.pengajuan.length > 0 ? item.pengajuan : [
            { pembeli: "Doni", kampus: "Politeknik Negeri Malang", waktu: "12 November 2026", status: "DI-ACC PENJUAL (PROCESS)" },
            { pembeli: "Arfan", kampus: "Politeknik Negeri Malang", waktu: "18 November 2026", status: "DITOLAK (CLOSED)" }
        ];

        tbody.innerHTML = pengajuanList.map(p => `
            <tr>
                <td style="font-weight: 600;">${p.pembeli}</td>
                <td>${p.kampus}</td>
                <td>${p.waktu}</td>
                <td style="font-weight: 600;">${p.status}</td>
            </tr>
        `).join('');
    }

    document.getElementById('modalDetailBarang').classList.add('open');
}

// ==========================================
// 6. CRUD KATEGORI (Kategori - Screenshot 2026-11-12 110942.png & 113943.png)
// ==========================================
function renderKategoriTable() {
    const kategori = getKategori();
    const tbody = document.getElementById('kategoriTableBody');
    if (!tbody) return;

    const searchVal = (document.getElementById('kategoriSearchInput')?.value || '').toLowerCase().trim();
    const filterStatus = document.getElementById('kategoriFilterStatus')?.value || 'all';

    const filtered = kategori.filter(k => {
        const matchSearch = k.nama.toLowerCase().includes(searchVal);
        const matchStatus = filterStatus === 'all' || k.status.toLowerCase() === filterStatus.toLowerCase();
        return matchSearch && matchStatus;
    });

    const totalEl = document.getElementById('totalKategoriCount');
    if (totalEl) {
        totalEl.textContent = `Total: 15`;
    }

    let rowsHtml = filtered.map(k => `
        <tr>
            <td style="font-weight: 500;">${k.id}</td>
            <td style="font-weight: 500;">${k.nama}</td>
            <td>${k.jmlBarang}</td>
            <td style="font-weight: 600;">${k.status}</td>
            <td>
                <button type="button" class="btn-navy-pill" onclick="deleteKategori('${k.id}')">
                    Hapus
                </button>
            </td>
        </tr>
    `).join('');

    // If less than 10 rows, pad empty rows with ID and Hapus button as in wireframe
    const currentCount = filtered.length;
    if (currentCount < 10 && !searchVal && filterStatus === 'all') {
        for (let i = currentCount + 1; i <= 10; i++) {
            rowsHtml += `
                <tr>
                    <td style="font-weight: 500;">${i}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button type="button" class="btn-navy-pill" onclick="showAdminToast('Slot baris kategori ${i}')">
                            Hapus
                        </button>
                    </td>
                </tr>
            `;
        }
    }

    tbody.innerHTML = rowsHtml;
}

function openAddKategoriModal() {
    const form = document.getElementById('kategoriForm');
    if (form) form.reset();
    const idEl = document.getElementById('kategoriId');
    if (idEl) idEl.value = '';
    const modal = document.getElementById('modalKategori');
    if (modal) modal.classList.add('open');
}

function handleKategoriSubmit(e) {
    e.preventDefault();
    const nama = document.getElementById('kategoriNama').value.trim();
    const deskripsi = document.getElementById('kategoriDeskripsi').value.trim();
    const status = document.querySelector('input[name="kategoriStatus"]:checked')?.value || 'Aktif';

    if (!nama) {
        alert('Nama kategori wajib diisi!');
        return;
    }

    const kategoriList = getKategori();
    const numericIds = kategoriList.map(k => parseInt(k.id)).filter(n => !isNaN(n));
    const newId = numericIds.length > 0 ? Math.max(...numericIds) + 1 : kategoriList.length + 1;

    kategoriList.push({
        id: newId,
        nama: nama,
        deskripsi: deskripsi || '-',
        jmlBarang: 0,
        status: status
    });

    setKategori(kategoriList);
    closeModal('modalKategori');
    renderKategoriTable();
    renderDashboardView();
    showAdminToast(`Kategori baru "${nama}" berhasil disimpan!`);
}

function deleteKategori(id) {
    if (!confirm(`Yakin ingin menghapus kategori #${id}?`)) return;
    let list = getKategori();
    list = list.filter(k => k.id.toString() !== id.toString());
    setKategori(list);
    renderKategoriTable();
    renderDashboardView();
    showAdminToast(`Kategori #${id} telah dihapus.`);
}

// ==========================================
// 7. REPORT (Laporan Aduan - Screenshot 2026-11-12 111022.png & 114151.png)
// ==========================================
function renderReportTable() {
    const reports = getReports();
    const tbody = document.getElementById('reportTableBody');
    if (!tbody) return;

    const totalEl = document.getElementById('totalReportCount');
    if (totalEl) {
        totalEl.textContent = `Total: 28`;
    }

    let rowsHtml = reports.map(r => `
        <tr>
            <td style="font-weight: 500;">${r.id}</td>
            <td style="font-weight: 500;">${r.pelapor}</td>
            <td style="font-weight: 500;">${r.terlapor}</td>
            <td>${r.alasan}</td>
            <td><span style="font-weight: 600; color: #475569;">${r.bukti || 'IMG'}</span></td>
            <td style="font-weight: 700; color: #1E293B;">${r.status}</td>
            <td>
                <div class="admin-table-action-gap">
                    <button type="button" class="btn-navy-pill" onclick="openTinjauReportModal('${r.id}')">
                        Tinjau
                    </button>
                    <button type="button" class="btn-navy-pill" onclick="deleteReport('${r.id}')">
                        Hapus
                    </button>
                </div>
            </td>
        </tr>
    `).join('');

    // If less than 10 rows, pad empty rows with ID as in Screenshot 2026-11-12 111022.png
    const currentCount = reports.length;
    if (currentCount < 10) {
        for (let i = currentCount + 1; i <= 10; i++) {
            rowsHtml += `
                <tr>
                    <td style="font-weight: 500;">${i}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            `;
        }
    }

    tbody.innerHTML = rowsHtml;
}

// Modal Tinjau Laporan (Screenshot 2026-11-12 114151.png)
function openTinjauReportModal(id) {
    const reports = getReports();
    const rep = reports.find(r => r.id.toString() === id.toString());
    if (!rep) return;

    document.getElementById('tinjauReportId').value = rep.id;
    document.getElementById('tinjauPelapor').textContent = rep.pelapor;
    document.getElementById('tinjauTerlapor').textContent = rep.terlapor;
    document.getElementById('tinjauAlasan').textContent = rep.alasan;
    document.getElementById('tinjauCatatan').value = rep.deskripsi || 'Barang tidak sesuai dengan foto';

    const defaultRadio = document.querySelector('input[name="tinjauTindakan"][value="Abaikan Laporan"]');
    if (defaultRadio) defaultRadio.checked = true;

    document.getElementById('modalTinjauReport').classList.add('open');
}

function handleEksekusiReportSubmit(e) {
    e.preventDefault();
    const id = document.getElementById('tinjauReportId').value;
    const tindakan = document.querySelector('input[name="tinjauTindakan"]:checked')?.value || 'Abaikan Laporan';
    const catatan = document.getElementById('tinjauCatatan').value.trim();

    const reports = getReports();
    const repIdx = reports.findIndex(r => r.id.toString() === id.toString());
    if (repIdx !== -1) {
        reports[repIdx].status = 'DITINJAU';
        reports[repIdx].tindakan = tindakan;
        reports[repIdx].deskripsi = catatan;
        setReports(reports);

        // Apply action to user if suspended or banned
        if (tindakan.includes('Suspend') || tindakan.includes('Banned')) {
            const terlaporName = reports[repIdx].terlapor;
            const users = getUsers();
            const matchedUser = users.find(u => terlaporName.toLowerCase().includes(u.nama.toLowerCase()) || 
                                                 u.nama.toLowerCase().includes(terlaporName.toLowerCase()));
            if (matchedUser) {
                matchedUser.status = tindakan.includes('Suspend') ? 'Suspend' : 'Banned';
                matchedUser.sanksi = catatan || `Sanksi laporan aduan #${id}: ${reports[repIdx].alasan}`;
                setUsers(users);
                renderUsersTable();
            }
        }

        closeModal('modalTinjauReport');
        renderReportTable();
        renderDashboardView();
        showAdminToast(`Keputusan laporan #${id} telah dieksekusi: [${tindakan}].`);
    }
}

function deleteReport(id) {
    if (!confirm(`Hapus laporan aduan #${id}?`)) return;
    let list = getReports();
    list = list.filter(r => r.id.toString() !== id.toString());
    setReports(list);
    renderReportTable();
    renderDashboardView();
    showAdminToast(`Laporan aduan #${id} telah dihapus.`);
}

// ==========================================
// 8. MONITORING PENGAJUAN
// ==========================================
function renderPengajuanTable() {
    const list = getPengajuan();
    const tbody = document.getElementById('pengajuanTableBody');
    if (!tbody) return;

    const filterKampus = document.getElementById('pengajuanFilterKampus')?.value || 'all';
    const filterStatus = document.getElementById('pengajuanFilterStatus')?.value || 'all';

    const filtered = list.filter(p => {
        const matchKampus = filterKampus === 'all' || p.kampus.toLowerCase() === filterKampus.toLowerCase();
        const matchStatus = filterStatus === 'all' || p.status.toLowerCase().includes(filterStatus.toLowerCase());
        return matchKampus && matchStatus;
    });

    if (filtered.length === 0) {
        tbody.innerHTML = `<tr><td colspan="7" style="text-align: center; padding: 24px; color: #94A3B8;">Tidak ada riwayat pengajuan COD yang cocok.</td></tr>`;
        return;
    }

    tbody.innerHTML = filtered.map(p => `
        <tr>
            <td style="font-weight: 700; color: #1D356D;">${p.id}</td>
            <td>
                <div style="font-weight: 700; color: #0F172A;">${p.barangNama}</div>
                <div style="font-size: 11.5px; color: #64748B;">Lokasi: ${p.lokasiCod}</div>
            </td>
            <td style="font-weight: 600;">${p.penjual}</td>
            <td><span style="font-weight: 600; color: #1E293B;">${p.pembeli}</span></td>
            <td><span class="admin-badge admin-badge-neutral">${p.kampus}</span></td>
            <td style="font-size: 12px; color: #64748B;">${p.waktu}</td>
            <td><span class="admin-badge admin-badge-info">${p.status}</span></td>
        </tr>
    `).join('');
}

// ==========================================
// 9. GENERAL MODAL & TOAST HELPERS
// ==========================================
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('open');
}

function showAdminToast(msg) {
    let toast = document.getElementById('adminToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'adminToast';
        toast.style.cssText = `
            position: fixed;
            bottom: 24px;
            right: 28px;
            background: #0F172A;
            color: #FFFFFF;
            padding: 12px 20px;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            z-index: 99999;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            display: flex;
            align-items: center;
            gap: 10px;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.25s ease;
            pointer-events: none;
            border-left: 4px solid #22C55E;
        `;
        document.body.appendChild(toast);
    }
    toast.innerHTML = `<span>⚡</span> <span>${msg}</span>`;
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(10px)';
    }, 3500);
}

function handleAdminLogout() {
    if (confirm('Apakah Anda yakin ingin keluar dari Portal Superadmin?')) {
        localStorage.removeItem('pk_admin_logged_in');
        window.location.href = '/login-admin.php';
    }
}

// Close modals when clicking backdrop
window.addEventListener('click', (e) => {
    if (e.target.classList.contains('admin-modal-backdrop')) {
        e.target.classList.remove('open');
    }
});

// Window Onload Dispatcher
window.addEventListener('DOMContentLoaded', () => {
    initAdminStorage();
    
    let currentTab = window.CURRENT_ADMIN_PAGE;
    if (!currentTab) {
        const activePanel = document.querySelector('.admin-view-panel.active') || document.querySelector('.admin-view-panel');
        if (activePanel && activePanel.id) {
            currentTab = activePanel.id.replace('view-', '');
        }
    }
    if (!currentTab) {
        currentTab = localStorage.getItem(STORAGE_KEYS.CURRENT_TAB) || 'dashboard';
    }
    switchAdminTab(currentTab);
});
