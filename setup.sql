-- ============================================================
--  phpMyAdmin'de çalıştır
--  Önce bu SQL ile tabloyu oluştur
-- ============================================================

CREATE TABLE IF NOT EXISTS discord_users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    username      VARCHAR(100) NOT NULL UNIQUE,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Test verisi eklemek için (opsiyonel):
-- INSERT INTO discord_users (username) VALUES ('test_kullanici');

-- Tabloyu görüntüle:
-- SELECT * FROM discord_users ORDER BY registered_at DESC;
