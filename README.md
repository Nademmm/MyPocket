# 💰 MyPocket - Personal Finance Management Web App

> A modern, fintech-inspired personal finance tracker built with Laravel 12, Tailwind CSS, and Chart.js.

[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php)](https://php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css)](https://tailwindcss.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

MyPocket is a comprehensive web application designed to help users take control of their financial life. Track income, manage expenses, set long-term savings goals, and get reminded of upcoming bills—all while earning achievement badges through a gamified experience.

---

## ✨ Features

### 💳 Core Financial Management
- **Smart Dashboard** - Real-time visualization of your financial health using Chart.js.
- **Transaction Tracking** - Detailed logging of income and expenses with customizable categories.
- **Savings Targets** - Set specific financial goals (e.g., "New Laptop", "Emergency Fund") and track your progress percentage.
- **Saving Diary** - A personal space to record reflections, financial plans, and daily notes.
- **Bill Reminders** - Never miss a payment with scheduled notifications and repeat options.

### 🏆 Gamification & Engagement
- **Achievement Badges** - Earn rewards for consistent tracking, reaching saving milestones, and completing targets.
- **Level System** - Level up your profile as you grow your total savings.
- **Interactive UI** - Modern, responsive interface built with Tailwind CSS, featuring smooth transitions and a clean aesthetic.

### 🔐 Security & Access
- **Multi-role Support** - Separate interfaces for regular Users and Administrators.
- **API Ready** - Full RESTful API support with Laravel Sanctum for mobile or third-party integration.
- **Secure Auth** - Built on Laravel Breeze for robust authentication.

### 👨‍💼 Admin Features
- Comprehensive system overview.
- Manage users, categories, and achievement badges.
- Monitor system-wide financial statistics.

---

## 🛠️ Technology Stack

- **Backend:** [Laravel 12](https://laravel.com) (PHP 8.2+)
- **Frontend:** [Tailwind CSS](https://tailwindcss.com) + [Alpine.js](https://alpinejs.dev)
- **Database:** MySQL / PostgreSQL / SQLite
- **API:** Laravel Sanctum (Token-based Auth)
- **Testing:** [Pest PHP](https://pestphp.com)
- **Bundler:** [Vite](https://vitejs.dev)

---

## 🚀 Getting Started

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- A database (MySQL, PostgreSQL, or SQLite)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/mypocket.git
   cd mypocket
   ```

2. **Automated Setup (Recommended)**
   We provide a custom script to handle the installation of dependencies, environment setup, and migrations:
   ```bash
   composer run setup
   ```

3. **Manual Setup** (If preferred)
   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   # Configure your .env database settings
   php artisan migrate --seed
   npm run build
   ```

4. **Start the Development Server**
   ```bash
   composer run dev
   ```
   This will concurrently run `php artisan serve`, `npm run dev`, and the queue listener.

---

## 🧪 Testing

The project uses **Pest PHP** for testing. To run the test suite:

```bash
composer run test
```
Or directly via:
```bash
php artisan test
```

---

## � Project Structure

```text
app/
├── Http/Controllers/Api/   # RESTful API Controllers
├── Models/                 # Eloquent Models (User, Transaction, Target, etc.)
├── Policies/               # Authorization logic
database/
├── migrations/             # Database schema definitions
├── seeders/                # Default data & demo accounts
resources/
├── views/                  # Blade templates (Dashboard, Auth, Admin)
├── css/                    # Tailwind CSS source files
└── js/                     # Alpine.js & Axios setup
routes/
├── web.php                 # Web routes
└── api.php                 # API endpoints (Sanctum protected)
```

---

## 🔐 Demo Credentials

After seeding the database (`php artisan db:seed`), you can use the following accounts:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@mypocket.test` | `password` |
| **User** | `demo@mypocket.test` | `password` |

---

## 🛣️ API Endpoints

The application includes a fully functional API under the `/api` prefix.

| Method | Endpoint | Description |
| :--- | :--- | :--- |
| `POST` | `/api/login` | Get Sanctum Token |
| `GET` | `/api/me` | Current User Info |
| `GET` | `/api/transactions` | List Transactions |
| `POST` | `/api/transactions` | Create Transaction |
| `GET` | `/api/targets` | List Saving Targets |
| ... | ... | ... |

*Refer to `routes/api.php` for the full list of available endpoints.*

---

## � Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information.

---
Built with ❤️ by [Nadem](https://github.com/nadem)
