<?php 

session_start();
require_once __DIR__ . '/../core/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';


$stmt = executeQuery("SELECT u.*, p.name FROM users u LEFT JOIN user_profiles p ON u.user_id = p.user_id WHERE u.email = ? AND u.deleted_at = FALSE", [$email]);
$user = fetch($stmt);

if ($user && password_verify($password, $user['password'])) {

$_SESSION['user_id'] = $user['user_id'];
$_SESSION['email'] = $user['email'];
$_SESSION['role'] = $user['role']; 
$_SESSION['name'] = $user['name'] ?? 'Pengguna';

header("Location: index.php");
    exit;
        } else {
        $error = "Email atau password salah!";
        }
    }
?>

<!-- <!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login - Pasar Kampus</title>
</head>

<body>
    <h2>Login Pasar Kampus</h2>
    <?php if (isset($_GET['success'])): ?><p style="color: green;">Registrasi berhasil, silakan login!</p><?php endif; ?>
    <?php if ($error): ?><p style="color: red;"><?= $error ?></p><?php endif; ?>

    <form action="login.php" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar disini</a></p>
</body>

</html> -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Pasar Kampus</title>
    <!-- Google Fonts Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- CSS Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body.pbl-login-page {
            margin: 0;
            padding: 24px 16px;
            min-height: 100vh;
            background-color: #1A2F60;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .pbl-login-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 440px;
            padding: 38px 40px 34px;
            box-sizing: border-box;
            position: relative;
        }

        .pbl-login-close:hover {
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

        .pbl-login-title {
            font-size: 28px;
            font-weight: 800;
            color: #1D356D;
            text-align: center;
            margin: 0 0 6px 0;
            letter-spacing: -0.3px;
        }

        .pbl-login-subtitle {
            font-size: 13px;
            color: #64748B;
            text-align: center;
            margin: 0 0 26px 0;
            font-weight: 500;
        }

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
            height: 44px;
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

        .pbl-login-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 12.5px;
        }

        .pbl-remember-label {
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            color: #475569;
            font-weight: 500;
            user-select: none;
        }

        .pbl-forgot-link {
            font-weight: 600;
            color: #1D356D;
            text-decoration: underline;
        }

        .pbl-forgot-link:hover {
            color: #2563EB;
        }

        .pbl-login-btn-container {
            margin-top: 22px;
        }

        .pbl-login-btn {
            width: 100%;
            height: 44px;
            background-color: #1D356D;
            color: #FFFFFF;
            font-size: 14.5px;
            font-weight: 700;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background-color 0.2s, transform 0.1s;
        }

        .pbl-login-btn:hover {
            background-color: #162955;
            transform: translateY(-1px);
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

        .pbl-login-footer {
            text-align: center;
            font-size: 13px;
            color: #64748B;
        }

        .pbl-login-footer a {
            color: #1D356D;
            font-weight: 800;
            text-decoration: underline;
            margin-left: 4px;
        }

        .pbl-login-footer a:hover {
            color: #2563EB;
        }

        @media (max-width: 480px) {
            .pbl-login-card {
                padding: 32px 24px 28px;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body class="pbl-login-page">

    <main class="pbl-login-card">
        <!-- Close Button (X) back to index.html -->
        <a href="index.html" class="pbl-login-close" title="Kembali ke Beranda">&times;</a>

        <h1 class="pbl-login-title">Log in</h1>

        <form id="loginForm" onsubmit="handleLogin(event)">
            <!-- Email -->
            <div class="pbl-form-group">
                <label class="pbl-label" for="loginEmail">Email</label>
                <input type="text" id="loginEmail" required class="pbl-input" placeholder="Email" value="farhan@ui.ac.id">
            </div>

            <!-- Password -->
            <div class="pbl-form-group" style="margin-bottom: 6px;">
                <label class="pbl-label" for="loginPassword">Password</label>
                <div class="pbl-pwd-wrap">
                    <input type="password" id="loginPassword" required class="pbl-input" placeholder="Masukkan password" value="password123">
                    <button type="button" class="pbl-pwd-toggle" onclick="toggleLoginPagePwd(this)" title="Lihat/Sembunyikan password">
                        <img id="loginEyeIcon" src="images/eye-closed.png" alt="Toggle Password" class="pbl-pwd-eye-icon">
                    </button>
                </div>
                <div class="pbl-login-meta">
                    <label class="pbl-remember-label">
                        <input type="checkbox" id="loginRemember" checked>
                        <span>Tetap Login</span>
                    </label>
                    <a href="#" onclick="alert('Fitur reset password (Demo)'); return false;" class="pbl-forgot-link">Lupa Password?</a>
                </div>
            </div>

            <!-- Submit Button (Full Width) -->
            <div class="pbl-login-btn-container">
                <button type="submit" class="pbl-login-btn">
                    Masuk
                </button>
            </div>

            <!-- Divider: ATAU -->
            <div class="pbl-divider-or">
                <span>ATAU</span>
            </div>

            <!-- Footer: Belum punya akun? Daftar -->
            <div class="pbl-login-footer">
                Belum punya akun? <a href="register.html">Daftar</a>
            </div>
        </form>
    </main>

    <!-- JavaScript -->
    <script src="js/login.js"></script>
</body>
</html>
