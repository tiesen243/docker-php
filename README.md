# Docker PHP Development Environment

A containerized PHP development environment with Apache, MySQL, and phpMyAdmin using Docker Compose.

## Features

- **PHP 8.4** with Apache web server
- **MySQL 8.0** database
- **phpMyAdmin** for database management
- **Environment-based configuration**
- **Volume persistence** for database data

## Prerequisites

- [Docker](https://docs.docker.com/get-docker/) installed
- [Docker Compose](https://docs.docker.com/compose/install/) installed
- [Composer](https://getcomposer.org/download/) installed (for PHP dependencies)
- [Node.js](https://nodejs.org/en/download/) and [npm](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm) installed (optional, for development tools)

## Setup

1. **Clone the repository**

   ```bash
   git clone git@github.com:tiesen243/docker-php.git [your-app-name]
   cd [your-app-name]
   ```

2. **Install dependencies**

   ```bash
   # Install Composer dependencies
   composer install

   # Install Prettier and prettier-plugin-php for PHP code formatting (optional)
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
   # For development
   composer dev:up

   # For production
   composer prod:up
   ```

6. **Stopping the containers**

   ```bash
   # For development
   composer dev:down

   # For production
   composer prod:down
   ```

## Access Points

- **Web Application**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Server: `db`
  - Username: Value from `DB_USER` in `.env`
  - Password: Value from `DB_PASSWORD` in `.env`

## Project Structure

```plaintext
├── app/                        # Application source code (controllers, models, views)
├── database/                   # Database SQL files, migrations, and seed data
├── public/                     # Public web root (index.php, CSS, JS, favicon, etc.)
├── routes/                     # Application route definitions
├── src/                        # Core framework and HTTP handling code
├── tests/                      # Unit, feature, and integration tests
├── Dockerfile.dev              # Development PHP image configuration
├── Dockerfile.prod             # Production PHP image configuration
├── docker-compose.dev.yml      # Docker Compose config for development services
├── docker-compose.prod.yml     # Docker Compose config for production services
└── .env                        # Actual environment variables file (from example)
```

## Docker Services

### Web Server (Apache + PHP 8.4)

- **Port**: 8080
- **Document Root**: `/var/www/html` (mapped to the local project root in development mode only)
- **PHP Extensions**: Common extensions pre-installed

### Database (MySQL 9.4.0)

- **Port**: 3306 (internal)
- **Data Persistence**: `db_data` volume
- **Configuration**: Uses environment variables from `.env`

### phpMyAdmin

- **Port**: 8081
- **Purpose**: Web-based MySQL administration

## License

This project is open source and available under the [MIT License](LICENSE).
