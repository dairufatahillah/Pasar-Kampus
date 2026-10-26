<?php
$title = $title ?? '';
$session = get_session();
?>
<!-- <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pasar Kampus | <?= esc($title) ?></title>
    <style>
        :root { font-family: Arial, sans-serif; color: #222; background: #f5f5f5; }
        * { box-sizing: border-box; }
        body { margin: 0; }
        header { background: #1f2937; color: #fff; }
        nav { display: flex; align-items: center; justify-content: space-between; max-width: 960px; margin: auto; padding: 1rem; }
        nav strong a {color: #fff; text-decoration: none;}
        nav div a { color: #fff; text-decoration: none; margin-left: 1rem; }
        nav div a:hover { text-decoration: underline; }
        main { max-width: 960px; min-height: calc(100vh - 6.25rem); margin: auto; padding: 2rem 1rem; background: #fff; }
    </style>
</head>
<body>
<header>
    <nav>
        <strong>
            <a href="<?= route('/') ?>">
                Pasar Kampus
            </a>
        </strong>
        <div>
            <a href="<?= route('/barang') ?>">Barang</a>
            <a href="<?= route('/laporan') ?>">Laporan</a>
            <?php if ($session): ?>
                <a href="<?= route('/logout') ?>">Logout</a>
            <?php else: ?>
                <a href="<?= route('/login') ?>">Login</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main> -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Akun - Pasar Kampus</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* =========================================================
           PBL Registration Theme (Matching Login Design & 2-Step Wizard)
           ========================================================= */
        body.pbl-register-page {
            margin: 0;
            padding: 24px 16px;
            min-height: 100vh;
            background-color: #1A2F60;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        /* 1. INITIAL AUTH CARD (Daftar Awal - Desain Seperti Login) */
        .pbl-reg-auth-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 440px;
            padding: 38px 40px 34px;
            box-sizing: border-box;
            position: relative;
        }

        .pbl-close-btn:hover {
            background: #E2E8F0;
            color: #1E293B;
        }

        .pbl-badge-wrap {
            text-align: center;
            margin-bottom: 12px;
        }

        .pbl-badge-account {
            display: inline-block;
            background: #EFF6FF;
            color: #1D356D;
            font-size: 12px;
            font-weight: 700;
            padding: 4px 14px;
            border-radius: 9999px;
            border: 1px solid #BFDBFE;
        }

        .pbl-card-title {
            font-size: 28px;
            font-weight: 800;
            color: #1D356D;
            text-align: center;
            margin: 0 0 6px 0;
            letter-spacing: -0.3px;
        }

        .pbl-card-subtitle {
            font-size: 13px;
            color: #64748B;
            text-align: center;
            margin: 0 0 26px 0;
            font-weight: 500;
        }

        /* 2. WIZARD CARD (2 Langkah: Biodata & Preferensi) */
        .pbl-wizard-card {
            background: #ffffff;
            border-radius: 22px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 580px;
            padding: 38px 46px 42px;
            box-sizing: border-box;
            display: none;
        }

        /* Panel visibility */
        .pbl-step-panel {
            display: none;
        }

        .pbl-step-panel.active {
            display: block;
            animation: pblFadeIn 0.3s ease;
        }

        @keyframes pblFadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* 2-Step Indicator (1 - 2) */
        .pbl-step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 26px;
        }

        .pbl-step-dot {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: #FEEBBA;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            user-select: none;
            flex-shrink: 0;
            transition: background-color 0.3s ease;
        }

        .pbl-step-dot.active,
        .pbl-step-dot.completed {
            background-color: #FBBF24;
            color: #1D356D;
        }

        .pbl-step-line {
            width: 54px;
            height: 3px;
            background-color: #FDDF91;
            margin: 0 6px;
            transition: background-color 0.3s ease;
        }

        .pbl-step-line.active {
            background-color: #FBBF24;
        }

        /* Form Controls */
        .pbl-form-group {
            margin-bottom: 18px;
        }

        .pbl-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1D356D;
            margin-bottom: 7px;
        }

        .pbl-input {
            width: 100%;
            height: 42px;
            padding: 8px 14px;
            font-size: 13.5px;
            color: #1e293b;
            border: 1.5px solid #CBD5E1;
            border-radius: 10px;
            box-sizing: border-box;
            outline: none;
            background: #FFFFFF;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        .pbl-input:focus {
            border-color: #1D356D;
            box-shadow: 0 0 0 3px rgba(29, 53, 109, 0.12);
        }

        .pbl-pwd-wrap {
            position: relative;
        }

        .pbl-pwd-wrap .pbl-input {
            padding-right: 48px;
        }

        .pbl-pwd-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            border-radius: 6px;
            transition: opacity 0.2s;
        }

        .pbl-pwd-toggle:hover {
            opacity: 0.7;
        }

        .pbl-pwd-eye-icon {
            height: 16px;
            width: auto;
            display: block;
            user-select: none;
        }

        .pbl-select-wrapper {
            position: relative;
            width: 100%;
        }

        .pbl-select {
            width: 100%;
            height: 42px;
            padding: 8px 36px 8px 14px;
            font-size: 13px;
            color: #1e293b;
            border: 1.5px solid #CBD5E1;
            border-radius: 10px;
            box-sizing: border-box;
            outline: none;
            background: #FFFFFF;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .pbl-select:focus {
            border-color: #1D356D;
            box-shadow: 0 0 0 3px rgba(29, 53, 109, 0.12);
        }

        .pbl-select-arrow {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 6px solid #1D356D;
        }

        .pbl-grid-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 22px;
            row-gap: 16px;
        }

        /* Buttons */
        .pbl-btn {
            background-color: #1D356D;
            color: #FFFFFF;
            font-size: 13.5px;
            font-weight: 700;
            padding: 10px 24px;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.2s, transform 0.1s;
        }

        .pbl-btn:hover {
            background-color: #162955;
            transform: translateY(-1px);
        }

        .pbl-btn-full {
            width: 100%;
            height: 44px;
            font-size: 14.5px;
        }

        .pbl-btn-outline {
            background-color: transparent;
            color: #1D356D;
            border: 1.5px solid #CBD5E1;
        }

        .pbl-btn-outline:hover {
            background-color: #F1F5F9;
            border-color: #1D356D;
            color: #1D356D;
        }

        .pbl-footer-twoway {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
        }

        .pbl-divider-or {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 22px 0 16px;
            color: #94A3B8;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .pbl-divider-or::before,
        .pbl-divider-or::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #E2E8F0;
        }

        .pbl-divider-or span {
            padding: 0 12px;
        }

        .pbl-footer-link-wrap {
            text-align: center;
            font-size: 13px;
            color: #64748B;
        }

        .pbl-footer-link-wrap a {
            color: #1D356D;
            font-weight: 800;
            text-decoration: underline;
            margin-left: 4px;
        }

        .pbl-footer-link-wrap a:hover {
            color: #2563EB;
        }

        /* Preferensi Grid (Step 2) */
        .pbl-pref-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 10px;
            margin-bottom: 18px;
        }

        .pbl-pref-card {
            border: 1.5px solid #CBD5E1;
            border-radius: 12px;
            padding: 14px 10px;
            text-align: center;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.2s;
            background: #FFFFFF;
            user-select: none;
            position: relative;
        }

        .pbl-pref-card input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .pbl-pref-card.selected {
            border-color: #1D356D;
            background: #EEF2FF;
            box-shadow: 0 0 0 2px rgba(29, 53, 109, 0.15);
        }

        .pbl-pref-icon {
            font-size: 24px;
            margin-bottom: 6px;
        }

        .pbl-pref-name {
            font-size: 12px;
            font-weight: 700;
            color: #1D356D;
        }

        /* Modal Dialog */
        .pbl-modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 20, 45, 0.75);
            backdrop-filter: blur(4px);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 16px;
            box-sizing: border-box;
        }

        .pbl-modal-backdrop.show {
            display: flex;
            animation: pblFadeIn 0.3s ease;
        }

        .pbl-modal-box {
            background: #ffffff;
            border-radius: 20px;
            max-width: 440px;
            width: 100%;
            padding: 32px 28px;
            text-align: center;
            box-sizing: border-box;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }

        @media (max-width: 580px) {
            .pbl-wizard-card {
                padding: 30px 20px 32px;
                border-radius: 18px;
            }

            .pbl-grid-2col {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .pbl-pref-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body class="pbl-register-page">

    <!-- ================= 1. KARTU DAFTAR AWAL (Desain Seperti Login) ================= -->
    <main id="regAuthCard" class="pbl-reg-auth-card">
        <!-- Close Button (X) back to index.html -->
        <a href="index.html" class="pbl-close-btn" title="Kembali ke Beranda">&times;</a>

        <h1 class="pbl-card-title">Daftar</h1>

        <form id="regAuthForm" onsubmit="event.preventDefault(); startWizard();">
            <!-- Email -->
            <div class="pbl-form-group">
                <label class="pbl-label" for="regEmail">Email</label>
                <input type="text" id="regEmail" required class="pbl-input" placeholder="Email" value="farhan@ui.ac.id">
            </div>

            <!-- Password -->
            <div class="pbl-form-group" style="margin-bottom: 6px;">
                <label class="pbl-label" for="regPassword">Password</label>
                <div class="pbl-pwd-wrap">
                    <input type="password" id="regPassword" required class="pbl-input" placeholder="Masukkan password (min. 6 karakter)" value="password123">
                    <button type="button" class="pbl-pwd-toggle" onclick="toggleRegPwd(this)" title="Lihat/Sembunyikan password">
                        <img id="regEyeIcon" src="images/eye-closed.png" alt="Toggle Password" class="pbl-pwd-eye-icon">
                    </button>
                </div>
            </div>

            <!-- Button: Daftar (Lanjut ke pengisian 2 step biodata & preferensi) -->
            <div style="margin-top: 22px;">
                <button type="submit" class="pbl-btn pbl-btn-full">
                    Daftar
                </button>
            </div>

            <!-- Divider: ATAU -->
            <div class="pbl-divider-or">
                <span>ATAU</span>
            </div>

            <!-- Footer: Sudah punya akun? Masuk -->
            <div class="pbl-footer-link-wrap">
                Sudah punya akun? <a href="login.html">Masuk</a>
            </div>
        </form>
    </main>

    <!-- ================= 2. WIZARD WIZARD (Hanya 2 Step: Biodata & Preferensi) ================= -->
    <section id="regWizardCard" class="pbl-wizard-card">
        <form id="regMultiStepForm" onsubmit="event.preventDefault()">

            <!-- ================= STEP 1 DARI 2: BIODATA DIRI ================= -->
            <div id="stepPanel1" class="pbl-step-panel active">
                <h2 class="pbl-card-title" style="font-size: 24px; margin-bottom: 12px;">Biodata Diri</h2>

                <!-- 2-Step Indicator (1 - 2) -->
                <div class="pbl-step-indicator">
                    <div class="pbl-step-dot pbl-step-dot-1 active">1</div>
                    <div class="pbl-step-line pbl-step-line-1"></div>
                    <div class="pbl-step-dot pbl-step-dot-2">2</div>
                </div>
                
                <!-- 2-Column Form Grid -->
                <div class="pbl-grid-2col">
                    <!-- Row 1: Nama Lengkap & Kecamatan -->
                    <div class="pbl-form-group">
                        <label class="pbl-label" for="regNama">Nama Lengkap</label>
                        <input type="text" id="regNama" required class="pbl-input" placeholder="Masukkan nama lengkap" value="Muhammad Farhan">
                    </div>

                    <div class="pbl-form-group">
                        <label class="pbl-label" for="regKecamatan">Kecamatan Domisili</label>
                        <div class="pbl-select-wrapper">
                            <select id="regKecamatan" required class="pbl-select">
                                <option value="" disabled hidden>Pilih kecamatan</option>
                                <option value="Lowokwaru" selected>Lowokwaru</option>
                                <option value="Klojen">Klojen</option>
                                <option value="Sukun">Sukun</option>
                                <option value="Blimbing">Blimbing</option>
                                <option value="Kedungkandang">Kedungkandang</option>
                                <option value="Beji">Beji</option>
                                <option value="Sukolilo">Sukolilo</option>
                                <option value="Coblong">Coblong</option>
                                <option value="Sleman">Sleman</option>
                                <option value="Jatinangor">Jatinangor</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="pbl-select-arrow"></div>
                        </div>
                    </div>

                    <!-- Row 2: No. Telepon & Kampus -->
                    <div class="pbl-form-group">
                        <label class="pbl-label" for="regTelepon">Nomor WhatsApp / HP</label>
                        <input type="tel" id="regTelepon" required class="pbl-input" placeholder="Contoh: 081234567890" value="081234567890">
                    </div>

                    <div class="pbl-form-group">
                        <label class="pbl-label" for="regKampus">Kampus Asal</label>
                        <div class="pbl-select-wrapper">
                            <select id="regKampus" required class="pbl-select">
                                <option value="" disabled hidden>Pilih kampus</option>
                                <option value="Universitas Brawijaya (UB)" selected>Universitas Brawijaya (UB)</option>
                                <option value="Universitas Negeri Malang (UM)">Universitas Negeri Malang (UM)</option>
                                <option value="Politeknik Negeri Malang (Polinema)">Politeknik Negeri Malang (Polinema)</option>
                                <option value="Universitas Indonesia (UI)">Universitas Indonesia (UI)</option>
                                <option value="Institut Teknologi Bandung (ITB)">Institut Teknologi Bandung (ITB)</option>
                                <option value="Universitas Gadjah Mada (UGM)">Universitas Gadjah Mada (UGM)</option>
                                <option value="Institut Teknologi Sepuluh Nopember (ITS)">Institut Teknologi Sepuluh Nopember (ITS)</option>
                                <option value="Universitas Padjadjaran (Unpad)">Universitas Padjadjaran (Unpad)</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                            <div class="pbl-select-arrow"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 1 Buttons: Kembali ke halaman Daftar Awal & Lanjutkan ke Preferensi -->
                <div class="pbl-footer-twoway">
                    <button type="button" onclick="backToAuth()" class="pbl-btn pbl-btn-outline">
                        &larr; Kembali
                    </button>
                    <button type="button" onclick="nextStep(1)" class="pbl-btn">
                        Lanjutkan &rarr;
                    </button>
                </div>
            </div>

            <!-- ================= STEP 2 DARI 2: PREFERENSI ================= -->
            <div id="stepPanel2" class="pbl-step-panel">
                <h2 class="pbl-card-title" style="font-size: 24px; margin-bottom: 12px;">Preferensi</h2>

                <!-- 2-Step Indicator (1 - 2) -->
                <div class="pbl-step-indicator">
                    <div class="pbl-step-dot pbl-step-dot-1 completed">1</div>
                    <div class="pbl-step-line pbl-step-line-1 active"></div>
                    <div class="pbl-step-dot pbl-step-dot-2 active">2</div>
                </div>

                <!-- Jenis Barang yang Diminati -->
                <div class="pbl-form-group">
                    <label class="pbl-label">Jenis barang yang diminati di PasarKampus</label>
                    <div class="pbl-pref-grid">
                        <label class="pbl-pref-card selected" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="Buku" checked>
                            <span class="pbl-pref-icon">📚</span>
                            <span class="pbl-pref-name">Buku</span>
                        </label>
                        <label class="pbl-pref-card selected" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="Elektronik" checked>
                            <span class="pbl-pref-icon">💻</span>
                            <span class="pbl-pref-name">Elektronik</span>
                        </label>
                        <label class="pbl-pref-card selected" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="ATK" checked>
                            <span class="pbl-pref-icon">✏️</span>
                            <span class="pbl-pref-name">ATK</span>
                        </label>
                        <label class="pbl-pref-card selected" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="Perlengkapan Kost" checked>
                            <span class="pbl-pref-icon">🛏️</span>
                            <span class="pbl-pref-name">Perlengkapan Kost</span>
                        </label>
                        <label class="pbl-pref-card" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="Pakaian">
                            <span class="pbl-pref-icon">👕</span>
                            <span class="pbl-pref-name">Pakaian</span>
                        </label>
                        <label class="pbl-pref-card" onclick="togglePrefCard(this)">
                            <input type="checkbox" name="preferensi" value="Lainnya">
                            <span class="pbl-pref-icon">📦</span>
                            <span class="pbl-pref-name">Lainnya</span>
                        </label>
                    </div>
                </div>

                <!-- Step 2 Buttons: Kembali ke Biodata & Selesai -->
                <div class="pbl-footer-twoway">
                    <button type="button" onclick="prevStep(2)" class="pbl-btn pbl-btn-outline">
                        &larr; Kembali
                    </button>
                    <button type="button" onclick="finishRegistration()" class="pbl-btn">
                        Selesai &rarr;
                    </button>
                </div>
            </div>

        </form>
    </section>

    <!-- Success Modal Popup -->
    <div id="regSuccessModal" class="pbl-modal-backdrop">
        <div class="pbl-modal-box">
            <h2 style="font-size: 1.4rem; font-weight: 800; color: #1D356D; margin: 0 0 8px 0;">Registrasi Berhasil!</h2>
            <p style="font-size: 0.82rem; color: #64748B; margin: 0 0 20px 0; line-height: 1.5;">
                Akun PasarKampus Anda telah berhasil terdaftar dan aktif.
            </p>

            <div style="background: #F8FAFC; border: 1px solid #E2E8F0; border-radius: 12px; padding: 14px 18px; text-align: left; font-size: 0.8rem; margin-bottom: 22px; line-height: 1.8; color: #334155;">
                <div><strong style="color: #1D356D;">Nama Lengkap:</strong> <span id="sumNama">-</span></div>
                <div><strong style="color: #1D356D;">Preferensi Barang:</strong> <span id="sumPreferensi">-</span></div>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="index.html" class="pbl-btn" style="display: block; text-decoration: none; padding: 11px 20px; background-color: #1D356D;">
                    Lihat Beranda (Header Profil Aktif) &rarr;
                </a>
                <a href="dashboard.html" class="pbl-btn" style="display: block; text-decoration: none; padding: 10px 20px; background-color: transparent; color: #1D356D; border: 1.5px solid #1D356D;">
                    Masuk ke Dashboard Marketplace &rarr;
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="js/register.js"></script>
</body>
</html>
