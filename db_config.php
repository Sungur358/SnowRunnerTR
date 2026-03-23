<?php
// ============================================================
//  Veritabanı Bağlantısı
//  public_html/api/db_config.php
// ============================================================

$host     = "localhost";
$dbname   = "snowrunner_launcher";   // phpMyAdmin'de oluşturduğun DB adı
$username = "launcher_user";         // DB kullanıcı adı
$password = "SIFREN";                // DB şifresi

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Hata detayını dışarıya sızdırma, sadece genel mesaj ver
    die("DB ERROR");
}
