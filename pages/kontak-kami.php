<?php
declare(strict_types=1);

$session = get_session();
$profileName = '';
$profileEmail = '';

if ($session !== null && isset($session['user_id'])) {
    $profile = executeQuery(
        'SELECT name FROM user_profiles WHERE user_id = ? ORDER BY profile_id DESC LIMIT 1',
        [$session['user_id']],
        'fetch'
    ) ?: [];
    $profileName = trim((string) ($profile['name'] ?? $session['name'] ?? ''));
    $profileEmail = trim((string) ($session['email'] ?? ''));
}

$successMessage = '';
$errorMessage = '';
$nameValue = $profileName;
$emailValue = $profileEmail;
$messageValue = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = trim((string) ($_POST['email'] ?? ''));
    $message = trim((string) ($_POST['message'] ?? ''));

    $nameValue = $name;
    $emailValue = $email;
    $messageValue = $message;

    if ($name === '' || mb_strlen($name) < 2) {
        $errorMessage = 'Silakan masukkan nama Anda dengan benar (minimal 2 karakter).';
    } elseif ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Format alamat email tidak valid. Silakan periksa kembali email Anda.';
    } elseif ($message === '' || mb_strlen($message) < 5) {
        $errorMessage = 'Silakan masukkan isi pesan Anda (minimal 5 karakter).';
    } else {
        $adminEmail = 'gamewoop0@gmail.com';
        $subject = 'Pesan Baru Kontak Kami PasarKampus dari ' . $name;

        // Build HTML Message
        $escapedName = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
        $escapedEmail = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
        $escapedMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
        $sendDate = date('d F Y, H:i') . ' WIB';

        $bodyHtml = <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pesan Kontak PasarKampus</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 24px; color: #1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.08); border: 1px solid #e2e8f0;">
        <tr>
            <td style="background: linear-gradient(180deg, #1D4ED8 0%, #1E40AF 100%); padding: 24px 32px; color: #ffffff;">
                <h1 style="margin: 0; font-size: 22px; font-weight: 800; letter-spacing: -0.5px;">PasarKampus</h1>
                <p style="margin: 6px 0 0; font-size: 13px; opacity: 0.9;">Notifikasi Pesan Kontak Baru Masuk</p>
            </td>
        </tr>
        <tr>
            <td style="padding: 32px;">
                <p style="font-size: 15px; margin: 0 0 20px;">Halo Admin PasarKampus, Anda menerima pesan baru dari pengunjung web melalui formulir Kontak Kami:</p>
                <table width="100%" cellpadding="8" cellspacing="0" style="background-color: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 24px; font-size: 14px;">
                    <tr>
                        <td width="30%" style="font-weight: bold; color: #475569; border-bottom: 1px solid #e2e8f0;">Nama Pengirim</td>
                        <td style="color: #0f172a; border-bottom: 1px solid #e2e8f0;">{$escapedName}</td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569; border-bottom: 1px solid #e2e8f0;">Email Pengirim</td>
                        <td style="color: #0f172a; border-bottom: 1px solid #e2e8f0;"><a href="mailto:{$escapedEmail}" style="color: #2563eb; text-decoration: none;">{$escapedEmail}</a></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold; color: #475569;">Waktu Pengiriman</td>
                        <td style="color: #0f172a;">{$sendDate}</td>
                    </tr>
                </table>
                <h3 style="margin: 0 0 10px; font-size: 15px; color: #0f172a;">Isi Pesan:</h3>
                <div style="background: #ffffff; border: 1px solid #cbd5e1; border-left: 4px solid #2563eb; padding: 16px; border-radius: 6px; font-size: 14px; line-height: 1.6; color: #334155;">
                    {$escapedMessage}
                </div>
                <div style="margin-top: 28px; padding-top: 20px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #94a3b8; text-align: center;">
                    Email ini dikirim secara otomatis oleh formulir kontak resmi platform PasarKampus.<br>
                    Untuk membalas pesan, klik tombol Reply pada email Anda atau kirim ke <a href="mailto:{$escapedEmail}" style="color: #2563eb;">{$escapedEmail}</a>.
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
HTML;

        // Try sending via PHPMailer or mail()
        $mailSent = false;

        if (class_exists('PHPMailer\\PHPMailer\\PHPMailer')) {
            try {
                $phpmailer = new PHPMailer\PHPMailer\PHPMailer(true);
                $phpmailer->CharSet = 'UTF-8';
                $phpmailer->setFrom('no-reply@pasarkampus.id', 'PasarKampus Contact');
                $phpmailer->addAddress($adminEmail, 'Admin PasarKampus');
                $phpmailer->addReplyTo($email, $name);
                $phpmailer->isHTML(true);
                $phpmailer->Subject = $subject;
                $phpmailer->Body = $bodyHtml;
                $phpmailer->AltBody = "Pesan baru dari {$name} ({$email}):\n\n{$message}\n\nWaktu: {$sendDate}";

                // Send via local mail transport
                $phpmailer->isMail();
                $mailSent = $phpmailer->send();
            } catch (Throwable $e) {
                $mailSent = false;
            }
        }

        if (!$mailSent) {
            $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
            $headers = [
                'MIME-Version: 1.0',
                'Content-Type: text/html; charset=UTF-8',
                'From: PasarKampus <no-reply@pasarkampus.id>',
                'Reply-To: ' . $escapedName . ' <' . $email . '>',
                'X-Mailer: PHP/' . phpversion()
            ];
            @ini_set('sendmail_from', 'no-reply@pasarkampus.id');
            $mailSent = @mail($adminEmail, $encodedSubject, $bodyHtml, implode("\r\n", $headers), '-fno-reply@pasarkampus.id');
        }

        // Successfully processed
        $successMessage = 'Terima kasih, ' . $escapedName . '! Pesan Anda telah berhasil terkirim ke email admin (' . $adminEmail . '). Kami akan segera merespons pesan Anda.';
        // Reset message field on success
        $messageValue = '';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami - PasarKampus</title>
    <meta name="description" content="Hubungi tim PasarKampus untuk pertanyaan, kritik, saran, maupun bantuan seputar layanan kami.">
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
            --pk-btn-blue: #2563EB;
            --pk-navy-footer: #1D356D;
            --pk-text-main: #0F172A;
            --pk-text-heading: #1E293B;
            --pk-text-muted: #64748B;
            --pk-border-input: #CBD5E1;
            --pk-bg-page: #F8FAFC;
        }

        body.pk-contact-body {
            background-color: var(--pk-bg-page);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #334155;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ================= 1. HEADER / NAVBAR (Sesuai Desain Halaman Kontak kami.png) ================= */
        .pk-navbar-custom {
            background: linear-gradient(180deg, #1D4ED8 0%, #2355B8 60%, #1E40AF 100%);
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 36px;
            color: #FFFFFF;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.08);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .pk-navbar-custom .pk-nav-inner {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .pk-navbar-custom .pk-nav-logo {
            font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
            font-size: 1.45rem;
            font-weight: 800;
            color: #FFFFFF;
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .pk-navbar-custom .pk-nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
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

        /* ================= 2. MAIN CONTAINER & CARD ================= */
        .pk-contact-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 24px;
        }

        .pk-contact-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            max-width: 1180px;
            width: 100%;
            padding: 64px 72px;
            box-sizing: border-box;
        }

        .pk-contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.35fr;
            gap: 64px;
            align-items: center;
        }

        /* Left Column: Heading */
        .pk-contact-left {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .pk-contact-title {
            font-family: 'Inter', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #1E3A8A;
            margin: 0 0 12px 0;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .pk-contact-subtitle {
            font-size: 1rem;
            color: #475569;
            margin: 0;
            line-height: 1.5;
            font-weight: 400;
        }

        /* Right Column: Form */
        .pk-contact-right {
            display: flex;
            flex-direction: column;
        }

        .pk-form-group {
            margin-bottom: 20px;
        }

        .pk-form-group:last-of-type {
            margin-bottom: 20px;
        }

        .pk-form-label {
            display: block;
            font-weight: 600;
            font-size: 0.95rem;
            color: #1E293B;
            margin-bottom: 8px;
        }

        .pk-form-input {
            width: 100%;
            height: 48px;
            border: 1px solid var(--pk-border-input);
            border-radius: 12px;
            padding: 0 18px;
            font-size: 0.95rem;
            color: #0F172A;
            box-sizing: border-box;
            background-color: #FFFFFF;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }

        .pk-form-input::placeholder {
            color: #94A3B8;
        }

        .pk-form-input:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .pk-form-textarea {
            width: 100%;
            border: 1px solid var(--pk-border-input);
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 0.95rem;
            color: #0F172A;
            box-sizing: border-box;
            background-color: #FFFFFF;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
            resize: vertical;
            min-height: 170px;
            font-family: inherit;
            line-height: 1.6;
        }

        .pk-form-textarea:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .pk-form-btn-kirim {
            align-self: flex-start;
            background-color: #2563EB;
            color: #FFFFFF;
            border: none;
            border-radius: 8px;
            padding: 10px 32px;
            font-size: 0.92rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.1s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .pk-form-btn-kirim:hover {
            background-color: #1D4ED8;
            box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
        }

        .pk-form-btn-kirim:active {
            transform: scale(0.98);
        }

        /* Alert notifications */
        .pk-alert {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .pk-alert-success {
            background-color: #ECFDF5;
            border: 1px solid #A7F3D0;
            color: #065F46;
        }

        .pk-alert-error {
            background-color: #FEF2F2;
            border: 1px solid #FECACA;
            color: #991B1B;
        }

        .pk-alert svg {
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Responsive Breakpoints */
        @media (max-width: 900px) {
            .pk-contact-grid {
                grid-template-columns: 1fr;
                gap: 36px;
            }
            .pk-contact-card {
                padding: 40px 28px;
                border-radius: 16px;
            }
            .pk-contact-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 600px) {
            .pk-navbar-custom {
                padding: 0 18px;
            }
            .pk-contact-main {
                padding: 24px 16px;
            }
            .pk-contact-card {
                padding: 28px 20px;
            }
            .pk-contact-title {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body class="pk-contact-body">

    <!-- ================= 1. HEADER (Persis Gambar Desain) ================= -->
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

    <!-- ================= 2. MAIN CONTENT (Card Kontak Kami) ================= -->
    <main class="pk-contact-main">
        <div class="pk-contact-card">

            <?php if ($successMessage !== ''): ?>
                <div class="pk-alert pk-alert-success" role="alert">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <div>
                        <strong>Pesan Berhasil Terkirim!</strong><br>
                        <?= esc($successMessage) ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($errorMessage !== ''): ?>
                <div class="pk-alert pk-alert-error" role="alert">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <strong>Gagal Mengirim Pesan:</strong><br>
                        <?= esc($errorMessage) ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="pk-contact-grid">
                <!-- Kolom Kiri: Judul Kontak Kami -->
                <div class="pk-contact-left">
                    <h1 class="pk-contact-title">Kontak Kami</h1>
                    <p class="pk-contact-subtitle">Silahkan tinggalkan pesan anda, pada kolom yang tersedia</p>
                </div>

                <!-- Kolom Kanan: Formulir Kirim Pesan -->
                <div class="pk-contact-right">
                    <form action="" method="POST" autocomplete="on">
                        <div class="pk-form-group">
                            <label for="contactName" class="pk-form-label">Nama Anda:</label>
                            <input 
                                type="text" 
                                id="contactName" 
                                name="name" 
                                class="pk-form-input" 
                                placeholder="Masukkan Nama" 
                                required 
                                value="<?= esc($nameValue) ?>"
                            >
                        </div>

                        <div class="pk-form-group">
                            <label for="contactEmail" class="pk-form-label">E-mail Anda:</label>
                            <input 
                                type="email" 
                                id="contactEmail" 
                                name="email" 
                                class="pk-form-input" 
                                placeholder="Masukkan Email" 
                                required 
                                value="<?= esc($emailValue) ?>"
                            >
                        </div>

                        <div class="pk-form-group">
                            <label for="contactMessage" class="pk-form-label">Pesan Anda:</label>
                            <textarea 
                                id="contactMessage" 
                                name="message" 
                                class="pk-form-textarea" 
                                required
                            ><?= esc($messageValue) ?></textarea>
                        </div>

                        <button type="submit" class="pk-form-btn-kirim">
                            Kirim
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- ================= 3. FOOTER (Sesuai Desain Halaman Kontak kami.png) ================= -->
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
                        <li><a href="<?= route('/#tentang-kami') ?>">Tentang kami</a></li>
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
                        <li><a href="<?= route('/kebijakan.php') ?>">Kebijakan</a></li>
                        <li><a href="<?= route('/panduan-keamanan.php') ?>">Panduan Keamanan COD</a></li>
                        <li><a href="<?= route('/syarat-ketentuan.php') ?>">Syarat &amp; Ketentuan</a></li>
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

</body>
</html>
