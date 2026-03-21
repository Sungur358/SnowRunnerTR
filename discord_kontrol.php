<?php
header('Content-Type: text/plain');

// DB bilgileri
$host = "localhost";
$db = "snowrunner_launcher";
$user = "db_user";
$pass = "db_password";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    http_response_code(500);
    echo "ERROR: DB bağlantısı başarısız";
    exit;
}

// GET parametresi al
if (!isset($_GET['username']) || empty($_GET['username'])) {
    http_response_code(400);
    echo "ERROR: username eksik";
    exit;
}

$username = trim($_GET['username']);

// Kullanıcıyı kontrol et
try {
    $stmt = $pdo->prepare("SELECT * FROM discord_users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo "OK"; // kullanıcı kayıtlı
    } else {
        echo "NOT_FOUND"; // kullanıcı bulunamadı
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo "ERROR: " . $e->getMessage();
}
?>