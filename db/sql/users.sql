ALTER DATABASE mydb
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;


-- 設定 ENGINE、CHARSET 與 COLLATE 可確保資料表使用支援交易的 InnoDB 引擎，
-- 並正確處理多語言與 emoji（utf8mb4），以及統一字串比對與排序邏輯（utf8mb4_unicode_ci）。
ALTER DATABASE mydb
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

SHOW VARIABLES LIKE 'character_set_server';
SHOW VARIABLES LIKE 'collation_server';
SHOW VARIABLES LIKE 'default_storage_engine';


-- 創建用戶表
CREATE TABLE IF NOT EXISTS users (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    email_verified_at TIMESTAMP NULL DEFAULT NULL,
    age INT NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP NULL DEFAULT NOW(),
    updated_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email),
    UNIQUE KEY users_phone_unique (phone),
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 插入測試數據
INSERT INTO users (name, email, age, phone, password) VALUES
('張家豪', 'zhang@example.com', 28, '0912-345-678', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('李美玲', 'li@example.com', 24, '0923-456-789', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('王大明', 'wang@example.com', 35, '0934-567-890', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('林小華', 'lin@example.com', 30, '0945-678-901', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('陳志明', 'chen@example.com', 42, '0956-789-012', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');







