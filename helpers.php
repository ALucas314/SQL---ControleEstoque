<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function flash(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = $_SESSION['flash'] ?? [];
    $_SESSION['flash'][] = ['message' => $message, 'type' => $type];
}

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
    }
    return $_SESSION['csrf_token'];
}

function require_csrf(): void {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $token = $_POST['csrf'] ?? '';
        if (!$token || !hash_equals($_SESSION['csrf_token'] ?? '', $token)) {
            http_response_code(400);
            echo 'CSRF inválido';
            exit;
        }
    }
}

function input(string $key, $default = '') {
    return trim($_POST[$key] ?? $_GET[$key] ?? $default);
}

?>


