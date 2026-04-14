<?php
// ══════════════════════════════════════════════════════════
//  SiKecil – Helper: Session & Auth
// ══════════════════════════════════════════════════════════

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ── Cek apakah user sudah login ───────────────────────────
function isLoggedIn(): bool {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// ── Ambil data user yang sedang login ────────────────────
function currentUser(): array {
    return [
        'id'    => $_SESSION['user_id']    ?? null,
        'nama'  => $_SESSION['user_nama']  ?? '',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}

// ── Redirect ke login jika belum login ───────────────────
function requireLogin(string $basePath = '../'): void {
    if (!isLoggedIn()) {
        header('Location: ' . $basePath . 'pages/login.php?redirect=1');
        exit;
    }
}

// ── Login: simpan data ke session ────────────────────────
function loginUser(array $user): void {
    session_regenerate_id(true); // cegah session fixation
    $_SESSION['user_id']    = $user['id'];
    $_SESSION['user_nama']  = $user['nama'];
    $_SESSION['user_email'] = $user['email'];
}

// ── Logout ────────────────────────────────────────────────
function logoutUser(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

// ── Flash message (tampil sekali lalu hilang) ─────────────
function setFlash(string $type, string $msg): void {
    $_SESSION['flash'] = ['type' => $type, 'msg' => $msg];
}

function getFlash(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

// ── Render flash HTML ─────────────────────────────────────
function showFlash(): void {
    $f = getFlash();
    if (!$f) return;
    $cls = $f['type'] === 'success' ? 'alert-success' : 'alert-error';
    echo '<div class="alert ' . $cls . '">' . htmlspecialchars($f['msg']) . '</div>';
}
