<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# 📚 Online Book Management System

A robust backend API built with **Laravel**, designed to manage and serve content for the Online Book platform. This project demonstrates proficiency in modern PHP development, API design, and database management.

---

## 🚀 Features

- 🔐 Secure API endpoints for book management
- 🗄️ Structured database schema for efficient data storage
- 📦 Dockerized environment for consistent development setup
- 🧪 PHPUnit-based testing suite for backend logic validation

---

## 🛠️ Tech Stack

- **Backend Framework**: [Laravel](https://laravel.com/)
- **Database**: MySQL
- **Containerization**: Docker
- **Testing**: PHPUnit
- **Version Control**: Git

---

## 📂 Project Structure

```

online\_book/
├── app/                  # Core application logic
├── bootstrap/            # Application bootstrapping
├── config/               # Configuration files
├── database/             # Database migrations and seeds
├── public/               # Publicly accessible files
├── resources/            # Views and localization files
├── routes/               # API and web routes
├── storage/              # Logs and file storage
├── tests/                # Automated tests
├── .dockerignore         # Docker ignore file
├── .editorconfig         # Editor configuration
├── .env.example          # Environment variables example
├── .gitignore            # Git ignore file
├── Dockerfile            # Docker configuration
├── README.md             # Project documentation
├── artisan               # Laravel command-line tool
├── composer.json         # PHP dependencies
├── composer.lock         # PHP dependency lock file
├── package-lock.json     # Node.js dependency lock file
└── vite.config.js        # Vite configuration for frontend assets

````

---

## ⚙️ Installation & Setup

### Clone the repository

```bash
git clone https://github.com/htay-htay-thwe/online_book.git
cd online_book
````

### Copy and configure environment variables

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other environment-specific settings.

### Build and start the Docker containers

```bash
docker-compose up -d
```

This command builds the Docker images and starts the containers in detached mode.

### Install PHP dependencies

```bash
docker-compose exec app composer install
```

### Generate the application key

```bash
docker-compose exec app php artisan key:generate
```

### Run database migrations

```bash
docker-compose exec app php artisan migrate
```

### Seed the database with sample data

```bash
docker-compose exec app php artisan db:seed
```

### Access the application

The backend API should now be accessible at `http://localhost:8000`.

---

## 🧪 Running Tests

To run the test suite:

```bash
docker-compose exec app php artisan test
```

This will execute the PHPUnit tests to ensure the integrity of your application.

---

## 📬 Contact

👤 **Your Name**
📧 Email: htayhtaythwe962@gmail.com

---

⭐ If you find this project useful, please consider giving it a **star**!

```

---

### 📌 Notes

This backend project is designed to work seamlessly with the [Online Book Frontend](https://github.com/htay-htay-thwe/online_book_frontend), providing a full-stack solution for book management. The use of Docker ensures a consistent development environment, making it easy to set up and collaborate on.

If you have any questions or need further information, feel free to reach out via the contact details provided above.
 
```

