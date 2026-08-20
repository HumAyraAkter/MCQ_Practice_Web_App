# Online MCQ Examination System

A robust and scalable online Multiple Choice Question (MCQ) application built for creating, managing, and conducting online exams seamlessly. This platform provides an intuitive interface for both administrators and students.

## 🚀 Tech Stack

- **Backend Framework:** Laravel (PHP)
- **Database:** MySQL
- **Real-time Engine / Task Runner:** Node.js
- **Frontend:** Blade Templates, CSS, JavaScript / Bootstrap

---

## ✨ Features

### 👤 Admin Panel
- **User Management:** Create, update, and manage student and teacher profiles.
- **Question Bank:** Easily add, edit, and categorize MCQ questions by subjects and topics.
- **Exam Creation:** Schedule exams with time limits, passing marks, and random question generation.
- **Real-time Analytics:** View instant results, student performance graphs, and detailed pass/fail statistics.

### 🎓 Student Panel
- **Dashboard:** View upcoming, active, and completed exams.
- **Live Exam Interface:** Clean and distraction-free exam window with a real-time countdown timer.
- **Instant Grading:** Get immediate scores and detailed answer reviews right after submitting the exam.
- **Performance History:** Track previous exam results and improvement over time.

---

## 🛠️ Installation & Setup

Follow these steps to run the project locally:

### 1. Prerequisites
Make sure you have **PHP**, **Composer**, **MySQL**, and **Node.js** installed on your system.

### 2. Clone the Repository
```bash
git clone https://github.com
cd your-repo-name
```

### 3. Install Backend Dependencies
```bash
composer install
```

### 4. Install Frontend & Node Dependencies
```bash
npm install
```

### 5. Environment Configuration
Copy the `.env.example` file to create your `.env` file:
```bash
cp .env.example .env
```
Open the `.env` file and configure your MySQL database details:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Run Database Migrations
```bash
php artisan migrate --seed
```

### 8. Start the Application
Run the Laravel development server:
```bash
php artisan serve
```
In a separate terminal, start the Node.js / Asset builder:
```bash
npm run dev
```

Now, open your browser and navigate to `http://127.0.0.1:8000`.

---

## 📝 License
This project is open-sourced software licensed under the [MIT license](https://opensource.org).
