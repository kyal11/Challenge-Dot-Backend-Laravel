## Summary
Aplikasi CRUD yang menggunakan studi kasus sistem akademik universitas dimana pada aplikasi ini menggunakan arsitektur restapi untuk transfer data ke front end serta membuat admin panel untuk manajemen data dan menggunakan JWT (Json Web Token) untuk autentikasi model.

## Feature
- Login
- Register
- Authentication wit JWT
- Admin Panel (Development)
- CRUD Model
## Model
<img src="https://github.com/kyal11/Challenge-Dot-Backend-Laravel/blob/main/Model-Relasi.png" width="500" />

## Screenshot
<img src="https://github.com/kyal11/Challenge-Dot-Backend-Laravel/blob/main/Dashboard-screenshot.png" width="400" /> <img src="https://github.com/kyal11/Challenge-Dot-Backend-Laravel/blob/main/Student-Screenshot.png" width="400" /> <img src="https://github.com/kyal11/Challenge-Dot-Backend-Laravel/blob/main/Login-Screenshot.png" width="400" /> <img src="https://github.com/kyal11/Challenge-Dot-Backend-Laravel/blob/main/Register-Screenshot.png" width="400" /> 

## Documentary
[Documentary with Postman](https://documenter.getpostman.com/view/29947879/2s9YeHaBD9)

## Depedency
- Faker (Using for build dummy data)
- tymon/jwt-auth (Using for Authentication)
- AdminLte (Using for templete Admin Panel)
- laravel built-in dependencies
## Installing
1. Clone repository
```
$ git clone https://github.com/kyal11/Challenge-Dot-Backend-Laravel.git
```
2. Install Depedency
```
composer install
npm install
```
3. Migration Model
```
php artisan migrate:fresh --seed
```
4. Run Restapi in port 8000
```
php artisan serve --port=8000
```
5. Run AdminPanel in Any Port (Example Port 8001)
```
php artisan serve --port=8001
```
   
