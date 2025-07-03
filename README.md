1. Open XAMPP
   - Start Apache and MySQL

2. Create Folder
   - Go to C:\xampp\htdocs
   - Create a folder named: VueLaravelExam

=========================
Frontend – Vue Setup
=========================

1. Open terminal:
   cd C:\xampp\htdocs\VueLaravelExam

2. Create Vue project:
   npm create vue@latest

   - Project name: VueExam
   - Package name: VueExam
   - Features: Only select "Router"

3. Move into Vue folder:
   cd VueExam

4. Install dependencies:
   npm install

5. Run dev server:
   npm run dev

6. Open browser to:
   http://localhost:5173

=========================
MySQL Database Setup
=========================

1. Open phpMyAdmin via XAMPP

2. Create database:
   manilafame_event

3. Create `account_information` table:
   Go to SQL tab, paste and run:

   CREATE TABLE account_information (
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     first_name VARCHAR(100) NOT NULL,
     last_name VARCHAR(100) NOT NULL,
     email VARCHAR(150) NOT NULL UNIQUE,
     username VARCHAR(100) NOT NULL UNIQUE,
     password VARCHAR(255) NOT NULL,
     type ENUM('Buyer', 'Exhibitor', 'Visitor') NOT NULL,
     created_at TIMESTAMP NULL DEFAULT NULL,
     updated_at TIMESTAMP NULL DEFAULT NULL
   );

4. Create `company_information` table:
   Go to SQL tab, paste and run:

   CREATE TABLE company_information (
     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     account_id INT UNSIGNED NOT NULL,
     company_name VARCHAR(150) NOT NULL,
     address_line VARCHAR(255) NOT NULL,
     town_city VARCHAR(100) NOT NULL,
     region_state VARCHAR(100) NOT NULL,
     country VARCHAR(100) NOT NULL,
     year_established YEAR NOT NULL,
     website VARCHAR(255),
     brochure_path VARCHAR(255),
     created_at TIMESTAMP NULL DEFAULT NULL,
     updated_at TIMESTAMP NULL DEFAULT NULL,
     CONSTRAINT fk_company_account FOREIGN KEY (account_id)
       REFERENCES account_information(id)
       ON DELETE CASCADE
   );

=========================
Backend – Laravel Setup
=========================

1. Install Composer:
   https://getcomposer.org/download/

   - Install for all users
   - PHP path: C:\xampp\php\php.exe

2. Create Laravel project:
   cd C:\xampp\htdocs\VueLaravelExam
   composer create-project laravel/laravel backend

3. Update `.env` file in:
   C:\xampp\htdocs\VueLaravelExam\backend\.env

   Change these values:

   APP_URL=http://localhost/VueLaravelExam/backend/public

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=manilafame_event
   DB_USERNAME=root
   DB_PASSWORD=

4. Generate app key:
   cd backend
   php artisan key:generate

5. Run migrations:
   php artisan migrate

6. Enable file storage:
   php artisan storage:link

=========================
Connect Vue to Laravel
=========================

In your frontend (App.vue):

   fetch("http://127.0.0.1:8000/api/register", {
     method: "POST",
     body: formData
   })

=========================
CORS Setup
=========================

Open: backend/config/cors.php

Change:

   'paths' => ['api/*'],
   'allowed_origins' => ['http://localhost:5173'],
   'allowed_methods' => ['*'],
   'allowed_headers' => ['*'],
