## Start project for dev
```
docker-compose up -d
docker-compose exec php bash (Nếu lỗi ở windows có thể phải thêm winpty vào đầu)

cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan db:seed --class=RoleSeeder
php artisan db:seed --class=UserSeeder
composer dump-autoload
npm install
npm run dev

php artisan datatables:make + Tên Bảng (Setup datatable) (Không cần tạo ngay vì sau này chia case thì mới dùng)
Tên database : graduation_project

Mỗi người khi colone về thì tự tạo nhánh mới của mình trên git. VD: git branch -b duongnvph33352
Và mỗi người chỉ được quyền đẩy code lên nhánh của mình..

Hãy cùng nhau xây dựng dự án tuyệt vời nhé! Thanks mọi người.
```
