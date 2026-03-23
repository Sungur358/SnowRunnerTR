<?php
// ============================================================
//  Discord Kullanıcı Kayıt Endpoint'i
//  public_html/api/discord_kayit.php
//  Kullanım: POST isteği → username parametresi
// ============================================================

header('Content-Type: text/plain; charset=utf-8');

// Sadece POST isteklerine izin ver
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "ERROR: Sadece POST destekleniyor.";
    exit;
}

// Parametre kontrolü
if (!isset($_POST['username']) || trim($_POST['username']) === '') {
    echo "ERROR: username parametresi eksik.";
    exit;
}

require "db_config.php";

$username = trim($_POST['username']);

// Uzunluk güvenliği (Discord max 32 karakter)
if (strlen($username) > 100) {
    echo "ERROR: Geçersiz username.";
    exit;
}

try {
    // Varsa güncelle, yoksa ekle (UPSERT)
    $stmt = $pdo->prepare(
        "INSERT INTO discord_users (username)
         VALUES (:username)
         ON DUPLICATE KEY UPDATE registered_at = CURRENT_TIMESTAMP"
    );
    $stmt->execute(['username' => $username]);

    echo "OK";

} catch (PDOException $e) {
    echo "DB ERROR";
}
