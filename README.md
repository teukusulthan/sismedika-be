# Sismedika POS Backend

Backend API for Sismedika POS system built using **Laravel +
PostgreSQL**.

---

## 🚀 Tech Stack

- Laravel
- PostgreSQL
- Laravel Sanctum (API Authentication)
- Eloquent ORM

---

## 📦 Installation Guide

### 1️⃣ Clone Repository

```bash
git clone <your-backend-repo-url>
cd sismedika-backend
```

---

### 2️⃣ Install Dependencies

```bash
composer install
```

---

### 3️⃣ Copy Environment File

```bash
cp .env.example .env
```

---

### 4️⃣ Configure Database (.env)

Update database configuration:

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=sismedika_db
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

---

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

### 6️⃣ Run Migrations & Seeders

```bash
php artisan migrate --seed
```

This will create:

- Users (Waiter & Cashier)
- Restaurant tables
- Food menu items

---

### 7️⃣ Run Development Server

```bash
php artisan serve
```

Backend runs at:

    http://127.0.0.1:8000

---

## 🔐 Default Login Credentials

### 👨‍🍳 Waiter

- Email: waiter@sismedika.com
- Password: password

### 💳 Cashier

- Email: cashier@sismedika.com
- Password: password

---

## 📡 API Base URL

    http://127.0.0.1:8000/api/v1

---

## 🧱 API Endpoints

### Authentication

- POST /api/v1/login
- POST /api/v1/logout
- GET /api/v1/me

### Tables

- GET /api/v1/restaurant-tables

### Foods

- GET /api/v1/foods
- POST /api/v1/foods
- PUT /api/v1/foods/{id}
- DELETE /api/v1/foods/{id}

### Orders

- GET /api/v1/orders
- POST /api/v1/orders/open
- GET /api/v1/orders/{id}
- POST /api/v1/orders/{id}/items
- DELETE /api/v1/orders/{id}/items/{itemId}
- POST /api/v1/orders/{id}/close

---

## 🧠 Architecture

- Controller → Service → Model
- Service layer handles business logic
- Sanctum handles token authentication
- Role-based behavior (waiter & cashier)

---

## 🏗 Production Build

```bash
php artisan config:cache
php artisan route:cache
php artisan optimize
```

---
