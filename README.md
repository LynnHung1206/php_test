# Start php Test
---
- [composer](#composer-)
- [Laravel](#laravel)
- [redis & mariadb](#redis--mariadb)
- [local 開發小技巧 自增命令](#local-開發小技巧-自增命令)
- [元Java開發者小提醒（自己）](#元java開發者小提醒自己)
---

## Composer 
- 套件管理器
- 如已經安裝可跳過安裝步驟進到初始化/laravel安裝
- 拉下來的專案 有可能要做 `composer install`

### 安裝（如本機已安裝可跳過)
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 確認安裝成功(看版號)
composer -v
```
- 如果要使用 laravel 直接安裝 [Laravel](#laravel)
- 如果沒有用框架請自己[初始化composer.json](#初始化-init)
---
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
    - 打 api 時，記得加上，不然驗證錯誤時會自動 redirect 回首頁
      - Content-Type: application/json
      - Accept: application/json

- view
  - 除了上述外，到 resources/views 建立 xxx.blade.php
  - 此處的名稱會和 view('xxx',['name' => $name]) 的 xxx 對應
### 錯誤處理
- 錯誤處理在 [Handler.php](test_app/app/Exceptions/Handler.php)
- 參數失敗預設會 redirect 回首頁，且 status code default 422
### Middleware
- 中介層，主要用來處理請求和回應的過程
- 類似 Java 的 filter
- 需要在 [Kernel.php](test_app/app/Http/Kernel.php) 中註冊
- 以及在 routes/api.php 中使用
### Model建立 & Repository
  - 建立 model
    - 下指令後會在 app/Models 中
    - ```bash 
      php artisan make:model XXXModel
      ```
    - ```php
      class MyCustomModel extends Model
      {
          protected $table = 'your_table_name'; // 如果不是符合 Laravel 命名慣例就一定要指定

          protected $fillable = ['欄位1', '欄位2', ...]; // 建議列出你要寫入的欄位
      }
      ```  
  - 建立  repository
  - ```php
      class MyCustomRepository
        {
        public function getAll()
        {
        return MyCustomModel::all();
        }
        
            public function getById($id)
            {
                return MyCustomModel::find($id);
            }
        
            // 其他 create/update/delete 方法
        }
    ```
    
### 測試
> 分為功能測試與單元測試 (Feature Test & Unit Test)

> 檢查一下 composer.json ->"phpunit/phpunit": "^10.0"

```bash
php artisan test # 測試所有測試
php artisan make:test ExampleUnitTest --unit # 單元測試
php artisan make:test UserApiTest # 功能測試

```
- 單元測試
  - 測試單一 function / method 的邏輯是否正確，通常不會依賴外部資源（像資料庫、路由、API）。
  - 不需要 HTTP 請求、資料庫等外部依賴
  - 場景
    - 你要測試一個計算邏輯、字串處理、Service class、Repository 方法等
    - 通常會使用 Mock 物件來模擬依賴的行為
- 功能測試 / 整合測試
  - 模擬一整個應用流程是否正確運作，例如：路由 → 控制器 → 中介層 → 資料庫。
  - 模擬實際 HTTP 請求 ($this->get(), $this->post())
  - 使用 Laravel 的 Application Container
  - 可以跑資料庫（常用 RefreshDatabase trait）
  - 效能比單元測試慢，但更貼近實際使用
  - 場景
    - 測試 API 回傳是否正確
    - 驗證表單送出是否會驗證失敗
    - 檢查使用者登入後才能做某些事
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

#### Mariadb 注意事項
- 設定 ENGINE、CHARSET 與 COLLATE 可確保資料表使用支援交易的 InnoDB 引擎，
- 並正確處理多語言與 emoji（utf8mb4），以及統一字串比對與排序邏輯（utf8mb4_unicode_ci）。
- 可以在建立資料庫時指定這些參數，或在資料庫建立後使用 ALTER DATABASE 語句進行修改。
```sql
ALTER DATABASE mydb
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

SHOW VARIABLES LIKE 'character_set_server';
SHOW VARIABLES LIKE 'collation_server';
SHOW VARIABLES LIKE 'default_storage_engine';
```
---
## local 開發小技巧 自增命令
```bash
# app/Console/Commands
php artisan make:command CreateViewCommand
```
- 將要做的事寫在裡面
- 在 app/Console/Kernel.php 文件中註冊命令
---
## 元Java開發者小提醒（自己）
- php 變數前面要加 $
- php 陣列用 => 來指定 key
- -> 相當於 Java 的 .
  - 呼叫它的方法
  - 呼叫它的屬性

---
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
---
#### for test
```json
Content-Type: application/json
Accept: application/json
Authorization:eyJ1aWQiOjEyMywibmFtZSI6Ikx5bm4ifQ==
```