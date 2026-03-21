<?php
header('Content-Type: text/plain');

// Veritabanı bilgileri
$host = "localhost";
$db = "snowrunner_launcher";
$user = "db_user";       // buraya DB kullanıcı adını yaz
$pass = "db_password";   // buraya DB şifresini yaz

// DB bağlantısı
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo "ERROR: DB bağlantısı başarısız";
    exit;
}

// POST verisi kontrol
if (!isset($_POST['username']) || empty($_POST['username'])) {
    http_response_code(400);
    echo "ERROR: username eksik";
    exit;
}

$username = trim($_POST['username']);

// Kullanıcı kaydı
try {
    // Eğer kullanıcı zaten varsa zaman damgasını güncelle
    $stmt = $pdo->prepare("INSERT INTO discord_users (username) VALUES (:username) 
        ON DUPLICATE KEY UPDATE registered_at=CURRENT_TIMESTAMP");
    $stmt->execute(['username' => $username]);

    echo "OK";
} catch (PDOException $e) {
    http_response_code(500);
    echo "ERROR: " . $e->getMessage();
}
?>