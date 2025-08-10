# Docker PHP Development Environment

A containerized PHP development environment with Apache, MySQL, and phpMyAdmin using Docker Compose.

## 🚀 Features

- **PHP 8.2** with Apache web server
- **MySQL 8.0** database
- **phpMyAdmin** for database management
- **Hot reloading** - changes reflected instantly
- **Environment-based configuration**
- **Volume persistence** for database data

## 📋 Prerequisites

- [Docker](https://docs.docker.com/get-docker/) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed
- [Composer](https://getcomposer.org/download/) installed (for PHP dependencies)
- [Node.js](https://nodejs.org/en/download/) and [npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) installed (for development dependencies)

## 🛠️ Setup

1. **Clone the repository**

   ```bash
   git clone <repository-url>
   cd docker-php
   ```

2. **Install development dependencies**

   ```bash
   # Install Prettier and prettier-plugin-php for PHP code formatting,
   # then run composer install after npm install (triggered in postinstall script)
   npm install
   ```

3. **Create environment file**

   ```bash
   cp .env.example .env
   ```

4. **Configure environment variables**
   Edit `.env` file and set your database credentials:

   ```env
   DB_NAME=your_database_name
   DB_USER=your_username
   DB_PASSWORD=your_secure_password
   ```

5. **Start the containers**

   ```bash
   docker-compose up -d
   # or
   npm run start
   ```

6. **Stopping the containers**

   ```bash
   docker-compose down
   # or
   npm run stop
   ```

## 🌐 Access Points

- **Web Application**: http://localhost:3000
- **phpMyAdmin**: http://localhost:8000
  - Server: `db`
  - Username: Value from `DB_USER` in `.env`
  - Password: Value from `DB_PASSWORD` in `.env`

## 📁 Project Structure

```
docker-php/
├── app/                 # Application source code (controller, models, views)
├── database/            # Database migrations and seeds
├── public/              # Publicly accessible files (index.php, css, js)
├── routes/              # Application routes
├── src/                 # PHP application code
├── Dockerfile           # Dockerfile for building the PHP image
├── docker-compose.yml   # Docker services configuration
├── .env.example         # Environment variables template
├── .env                 # Environment variables (create from example)
├── .gitignore           # Git ignore rules
└── README.md            # This file
```

## 🐳 Docker Services

### Web Server (Apache + PHP 8.2)

- **Port**: 3000
- **Document Root**: `/var/www/html` (mapped to `./public`)
- **PHP Extensions**: Common extensions pre-installed

### Database (MySQL 8.0)

- **Port**: 3306 (internal)
- **Data Persistence**: `db_data` volume
- **Configuration**: Uses environment variables from `.env`

### phpMyAdmin

- **Port**: 8000
- **Purpose**: Web-based MySQL administration

## 🔒 Security Notes

- Change default database credentials in production
- Use strong passwords (generate with `openssl rand -base64 32`)
- Don't commit `.env` file to version control
- Consider using Docker secrets for production deployments

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
