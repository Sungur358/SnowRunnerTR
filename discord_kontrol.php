<?php
// ============================================================
//  Discord Kullanıcı Kontrol Endpoint'i
//  public_html/api/discord_kontrol.php
//  Kullanım: GET isteği → ?username=DISCORD_ADI
// ============================================================

header('Content-Type: text/plain; charset=utf-8');

// Parametre kontrolü
if (!isset($_GET['username']) || trim($_GET['username']) === '') {
    echo "ERROR: username parametresi eksik.";
    exit;
}

require "db_config.php";

$username = trim($_GET['username']);

// Uzunluk güvenliği
if (strlen($username) > 100) {
    echo "ERROR: Geçersiz username.";
    exit;
}

try {
    $stmt = $pdo->prepare(
        "SELECT id FROM discord_users WHERE username = :username LIMIT 1"
    );
    $stmt->execute(['username' => $username]);

    if ($stmt->rowCount() > 0) {
        echo "OK";           // Kayıt bulundu → Launcher kilidi açılır
    } else {
        echo "NOT_FOUND";    // Kayıt yok → Launcher kilitli kalır
    }

} catch (PDOException $e) {
    echo "DB ERROR";
}
