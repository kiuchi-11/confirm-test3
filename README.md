# confirm-test3
# 環境構築
  1. リポジトリをクローン  
	git clone git@github.com:kiuchi-11/confirm-test3.git
  
  3. Dockerコンテナをビルド  
	docker-compose up -d --build  
  
  4. Laravel環境構築  
	docker-compose exec php bash  
	composer install  
	cp .env.example .env  
	php artisan key:generate  
	php artisan migrate:fresh --seed  

# 開発環境
	商品一覧画面：http://localhost/login
	phpMyAdmin：http://localhost:8080/

# 使用技術
	PHP 8.1.34  
	Laravel 8.83.29  
	MySQL 8.0.26  
	nginx 1.21.1  

# ER図
                                  +------------------+
                                  |  weight_targets  |
                                  +------------------+
                                  | id (PK)          |
    +------------------+          | user_id          |                    
    |      users       |          | target_weight    |                    
    +------------------+          | created_at       |                   
    | id (PK)          |+--------+| updated_at       |                    
    | name             |          +------------------+                    
    | email            |                                                  
    | password         |          +-------------------+                     
    | created_at       |+--------≡|    weight_logs    |                      
    | updated_at       |          +-------------------+           
    +------------------+          | id (PK)           |
                                  | name              |
                                  | user_id           |
                                  | date              |
                                  | weight            |
                                  | calories          |
                                  | exercise_time     |
                                  | exercise_content  |
                                  | created_at        |
                                  | updated_at        |
                                  +-------------------+
