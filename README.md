# Start php Test

## Composer 
- 套件管理器
- 如已經安裝可跳過安裝步驟進到初始化
### 安裝（如本機已安裝可跳過)
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 確認安裝成功(看版號)
composer -v
```
### 初始化 init
```bash
# 開始初始化專案
composer init
# 輸入 package name <vendor>/<name> ex.lynn/test
# desc
# Author
# minimum-stability 對於依賴的穩定性要求
# Package Type 先選 project
```
#### minimum-stability 選項
- stable：僅允許穩定版本的套件。適合生產環境。
- beta：允許穩定和測試版的套件。適合測試環境。
- alpha：允許穩定、測試版和開發版的套件。適合開發環境。
- dev：允許所有版本的套件，包括開發中的版本。適合開發環境。
## Laravel
### 安裝 10.*
```bash
composer create-project laravel/laravel test_app "10.*"
cd test_app # 之後都在裡面操作
php artisan serve # 啟動 laravel 內建 server
```
### 大致步驟
- 建立 controller
  - 下指令後會在 app/Http/Controllers 中
  - ```bash 
    php artisan make:controller XXXController
    ```
- 建立 route 
  - view -> routes/web.php
  - api -> routes/api.php， 且api 路徑預設帶 /api

- view
  - 除了上述外，到 resources/views 建立 xxx.blade.php
  - 此處的名稱會和 view('xxx',['name' => $name]) 的 xxx 對應
---
## redis & mariadb
- 建立 docker-compose.yml 直接拉起來即可
- Laravel 設置 .env
- 加入 redis 要用的composer 
  ```bash
  composer require predis/predis
  ```
- 新增環境變數
  ```properties
  # MariaDb
  DB_CONNECTION=mysql
  DB_HOST=mariadb
  DB_PORT=3306
  DB_DATABASE=mydb
  DB_USERNAME=myuser
  DB_PASSWORD=mypass
  
  # Redis 
  REDIS_HOST=localHost
  REDIS_PASSWORD=null
  REDIS_PORT=6379
  REDIS_CLIENT=predis
  ```
- redis 包成一包 util 比較好操作詳看 [CacheUtil](test_app/app/Utils/CacheUtil.php)
---
## local 開發小技巧 自增命令
```bash
# app/Console/Commands
php artisan make:command CreateViewCommand
```
- 將要做的事寫在裡面
- 在 app/Console/Kernel.php 文件中註冊命令


