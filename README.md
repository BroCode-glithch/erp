<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

## 🗂️ ERP System (Role-Based Laravel Dashboard)

This project is a **role-based ERP dashboard system** built with Laravel, designed to manage users and programs efficiently. The application implements a structured dashboard layout with routing logic that redirects authenticated users to the appropriate dashboard based on their role.

---

## 🚀 Features

### 🎯 Role-Based Authentication

- **Login/Register** page available on the landing screen
- Redirects users to dashboards based on their role:
  - **Admin**
  - **Program Manager**
  - **User**

### 🖥️ Admin Dashboard (in progress)

- Clean and responsive UI
- Sectioned into:
  - **Departments**
  - **Programs**
  - **Users**
- Each section includes:
  - Search functionality
  - "Create New" buttons
  - Table layout with dummy data
  - "Edit" and "Delete" action buttons
  - Button hover states
- Light/Dark mode toggle for better UX
- Structured and consistent visual theme

---

## 📁 Project Structure

- `resources/views/` - Blade templates for pages and layout
- `routes/web.php` - Web routing
- `app/Http/Controllers/` - Role-based controllers (auth + redirection logic)
- `public/` - Assets and styling

---

## 🛠️ Tech Stack

- **Laravel** (PHP framework)
- **Blade** (templating)
- **Tailwind CSS** (UI styling)
- **PHP 8+**
- **MySQL**

---

## 🔐 Getting Started

### Clone & Install

```bash
git clone git@github.com:BroCode-glithch/erp.git
cd erp
composer install
cp .env.example .env
php artisan key:generate

Set up database

Configure your .env database credentials

Run migrations (when models and migrations are ready):


php artisan migrate

Start local server

php artisan serve


💻 Screenshots (Coming Soon)

> UI will include screenshots of each dashboard section: departments, programs, and users.




📌 Project Roadmap

[x] Set up Laravel and authentication scaffolding

[x] Role-based login redirection

[x] Admin dashboard UI structure

[x] Dummy data tables

[x] Button styling improvements

[x] Light/Dark mode

[ ] Backend CRUD logic for each section

[ ] Program Manager dashboard

[ ] User dashboard

[ ] Notification system

[ ] User activity logs



📖 About Laravel

Laravel is a web application framework with expressive, elegant syntax. Laravel takes the pain out of development by easing common tasks like:

Routing

Dependency Injection

ORM (Eloquent)

Migrations

Queues

Broadcasting


Learn Laravel | Laravel Bootcamp | Laracasts


🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.


🛡️ License

This project is open-sourced under the MIT license.
```
