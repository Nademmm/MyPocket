# 💰 MyPocket - Personal Finance Management Web App

> A modern, fintech-inspired personal finance tracker built with Laravel, Tailwind CSS, and Chart.js

![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-00758F?style=for-the-badge&logo=mysql)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=for-the-badge&logo=tailwind-css)

Track your income, expenses, set financial goals, earn badges, and maintain a saving diary - all in one beautiful application.

## ✨ Features

### 💳 Core Features
- **Authentication & Authorization** - Secure login with roles (user/admin)
- **Transaction Tracking** - Log income and expenses with categories and dates
- **Financial Categories** - Organize transactions by income/expense types
- **Financial Targets** - Set savings goals and track progress
- **Reminders** - Schedule and manage financial event notifications
- **Saving Diary** - Write personal finance notes and reflections
- **Dashboard Analytics** - Interactive financial metrics with Chart.js
- **Responsive Design** - Mobile-friendly with dark mode support

### 🏆 Gamification
- **Achievement Badges** - Earn badges for milestones:
  - First Step (create 1 transaction)
  - Consistent Tracker (50 transactions)
  - Money Saver (save Rp 1M)
  - Big Saver (save Rp 10M)
  - Target Master (complete 5 targets)
  - Daily Journaler (10 diary entries)
- **Level System** - Progress through levels based on total savings
- **Achievement Dashboard** - View all earned badges

### 👨‍💼 Admin Features
- Admin dashboard with system overview
- User statistics and analytics
- Badge management system
- Category management
- Transaction & target monitoring

## 🏗️ Architecture

### Technology Stack
- **Backend**: Laravel 11 with Blade templates
- **Database**: MySQL with Eloquent ORM
- **Frontend**: Tailwind CSS with dark mode, Chart.js for analytics
- **Authentication**: Laravel Breeze
- **Authorization**: Policy-based access control
- **Build Tools**: Vite, PostCSS

### Database Schema (8 Tables)
```
users ──────→ transactions ←────── categories
  │              │
  ├─────→ targets
  ├─────→ reminders
  ├─────→ saving_diaries
  └─────→ badges (via user_badges)
```

**Tables:**
- `users` - User accounts with role, level, total_saved
- `categories` - Transaction categories (income/expense)
- `transactions` - User transactions with amounts and dates
- `targets` - Financial goals with progress tracking
- `reminders` - Scheduled reminders with repeat options
- `saving_diaries` - Personal finance journal entries
- `badges` - Achievement badges with requirements
- `user_badges` - Badge-user relationships with earned_at timestamp

## 🚀 Quick Start

### Prerequisites
- PHP 8.1 or higher
- MySQL 5.7+
- Composer
- Node.js & NPM

### Installation Steps

1. **Install Composer Dependencies**
```bash
cd C:\xampp\htdocs\MyPocket
composer install
```

2. **Install Node Dependencies**
```bash
npm install
npm run build
```

3. **Configure Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Setup Database**
```bash
# Edit .env and configure MySQL connection
php artisan migrate
php artisan db:seed
```

5. **Start Development Server**
```bash
php artisan serve
```

6. **Access Application**
- Navigate to `http://localhost:8000`
- Login with demo credentials below

### 👤 Demo Accounts

| Role | Email | Password |
|------|-------|----------|
| User | demo@mypocket.test | password |
| Admin | admin@mypocket.test | password |

## 📊 Dashboard Overview

### Financial Summary Cards
- **Total Balance** - Current balance (income - expenses)
- **Total Income** - Sum of all income transactions
- **Total Expenses** - Sum of all expense transactions

### Analytics & Charts
- **Monthly Overview** - Line chart with 12-month income vs expense trends
- **Recent Transactions** - Last 5 transactions with quick details
- **Active Targets** - Savings goals with progress bars
- **Upcoming Reminders** - Next scheduled financial events
- **Achievements** - Recently earned badges showcase

## 📁 Project Structure

```
MyPocket/
├── app/
│   ├── Http/
│   │   ├── Controllers/        # Business logic & request handling
│   │   ├── Requests/           # Form validation rules
│   │   └── Middleware/         # Admin authorization middleware
│   ├── Models/                 # Database models with relationships
│   ├── Policies/               # Authorization policies
│   └── Providers/              # Service providers & configuration
├── database/
│   ├── migrations/             # Database schema definitions
│   ├── seeders/                # Demo data population
│   └── factories/              # Test data factories
├── resources/
│   ├── views/                  # Blade templates
│   │   ├── dashboard.blade.php
│   │   ├── transactions/
│   │   ├── targets/
│   │   ├── reminders/
│   │   ├── diaries/
│   │   ├── badges/
│   │   ├── admin/
│   │   ├── auth/
│   │   └── layouts/
│   ├── css/
│   │   └── app.css             # Tailwind CSS
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   ├── web.php                 # Main application routes
│   └── auth.php                # Authentication routes
├── config/
│   ├── app.php
│   ├── database.php
│   └── auth.php
└── public/
    └── index.php               # Application entry point
```

## 🛣️ API Routes

### Transaction Management
```
GET    /transactions              # List all transactions
POST   /transactions              # Create transaction
GET    /transactions/{id}         # Show transaction
PATCH  /transactions/{id}         # Update transaction
DELETE /transactions/{id}         # Delete transaction
```

### Target Management
```
GET    /targets                   # List all targets
POST   /targets                   # Create target
GET    /targets/{id}              # Show target
PATCH  /targets/{id}              # Update target
DELETE /targets/{id}              # Delete target
```

### Reminder Management
```
GET    /reminders                 # List all reminders
POST   /reminders                 # Create reminder
GET    /reminders/{id}            # Show reminder
PATCH  /reminders/{id}            # Update reminder
DELETE /reminders/{id}            # Delete reminder
```

### Diary Management
```
GET    /diaries                   # List diary entries
POST   /diaries                   # Create entry
GET    /diaries/{id}              # Show entry
PATCH  /diaries/{id}              # Update entry
DELETE /diaries/{id}              # Delete entry
```

### Admin Routes
```
GET    /admin                     # Admin dashboard
GET    /admin/badges              # List badges
POST   /admin/badges              # Create badge
PATCH  /admin/badges/{id}         # Update badge
DELETE /admin/badges/{id}         # Delete badge
```

## 🔐 Security Features

- ✅ CSRF protection on all forms
- ✅ SQL injection prevention via Eloquent ORM
- ✅ Password hashing with bcrypt
- ✅ Policy-based authorization
- ✅ Admin role middleware verification
- ✅ Input validation on all endpoints
- ✅ Secure session management

## 🎨 User Interface

### Design Highlights
- **Modern Cards** - Gradient card designs with shadows
- **Dark Mode** - Automatic dark theme support
- **Responsive** - Mobile, tablet, and desktop optimization
- **Interactive Charts** - Real-time Chart.js visualizations
- **Smooth Animations** - CSS transitions and hover effects
- **Intuitive Navigation** - Clear menu and breadcrumb structure
- **Form Validation** - Real-time error feedback
- **Dark-friendly Colors** - High contrast for accessibility

### Pages
- 🏠 Dashboard - Financial overview and analytics
- 💸 Transactions - CRUD for income/expenses
- 🎯 Targets - Savings goals management
- 🔔 Reminders - Event notifications
- 📔 Diaries - Personal finance journaling
- 🏆 Badges - Achievement showcase
- ⚙️ Admin - System administration
- 👤 Profile - User settings and preferences

## 🔑 Key Models & Methods

### User Model
```php
$user->getBalance();           // Income - Expenses
$user->totalIncome();          // Sum of income transactions
$user->totalExpenses();        // Sum of expense transactions
$user->transactions();         // User's transactions
$user->targets();             // User's savings targets
$user->reminders();           // User's reminders
$user->diaries();             // User's diary entries
$user->badges();              // Earned badges
```

### Transaction Model
```php
$transaction->user;            // Transaction owner
$transaction->category;        // Transaction category
```

### Dashboard Controller
```php
// Financial metrics
$balance = user income - user expenses
$incomeTotal = sum of all income
$expenseTotal = sum of all expenses

// Charts data
$monthlyIncome = [0,0,0,...] // 12 months
$monthlyExpense = [0,0,...] // 12 months

// Related data
$recentTransactions // Last 5 transactions
$activeTargets      // Targets in progress
$reminders          // Upcoming reminders
$badges             // Earned badges
```

## 📈 Database Population

The application comes with comprehensive demo data:

- **13 Categories** - 5 income types, 8 expense types
- **6 Badges** - Achievement milestones
- **2 Demo Users** - Regular user and admin
- **6 Sample Transactions** - Mixed income/expenses
- **3 Targets** - Savings goals in progress
- **3 Reminders** - Scheduled reminders
- **3 Diary Entries** - Sample journal entries

Populate database:
```bash
php artisan migrate:fresh --seed
```

## 🧪 Testing

Run all tests:
```bash
php artisan test
```

Run specific test suite:
```bash
php artisan test tests/Feature/TransactionTest.php
php artisan test tests/Unit/UserTest.php
```

With coverage:
```bash
php artisan test --coverage
```

## 🚀 Production Deployment

### Environment Setup
```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

### Database Migration
```bash
php artisan migrate --force
```

### Asset Compilation
```bash
npm run build
```

### Cache Configuration
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 📚 Project Learning Outcomes

This project demonstrates:
- ✅ Full-stack Laravel development
- ✅ MVC architecture pattern
- ✅ RESTful API design
- ✅ Database design and normalization
- ✅ User authentication & authorization
- ✅ Blade templating engine
- ✅ Tailwind CSS framework
- ✅ Chart.js integration
- ✅ Form validation & error handling
- ✅ Security best practices
- ✅ Gamification implementation
- ✅ Responsive UI/UX design

## 🛠️ Future Enhancements

- [ ] Budget limits with alerts
- [ ] Export data to PDF/Excel
- [ ] Recurring transactions
- [ ] Multi-currency support
- [ ] Advanced analytics & predictions
- [ ] Mobile app (React Native)
- [ ] REST API v1 (for mobile)
- [ ] Email notifications
- [ ] Bill payment reminders
- [ ] Collaborative family budgeting
- [ ] Investment tracking
- [ ] Debt payoff calculator

## 📄 License

This project is open source under the MIT License.

## 👨‍💻 About

**MyPocket** is a comprehensive school project demonstrating modern web development practices, fintech principles, and user engagement through gamification. Built as a portfolio piece to showcase full-stack development capabilities.

## 🙏 Acknowledgments

- Laravel framework and community
- Tailwind CSS for styling
- Chart.js for visualizations
- Icons from Heroicons

---

**Built with ❤️ for financial literacy and personal money management**



In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
#   M y P o c k e t  
 