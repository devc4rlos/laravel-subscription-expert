# Laravel Subscription Expert

[![Laravel Version](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.5-777BB4?style=flat-square&logo=php)](https://www.php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

A robust, enterprise-ready subscription management system built with Laravel 12. This project implements a complete flow for plans, subscriptions, and user access control with a focus on database integrity and automated testing.

## Project Overview

This system is designed to handle complex subscription scenarios, including:
- **Flexible Tiers:** Support for multiple plans (Basic, Pro, Diamond).
- **Lifecycle Management:** Handling active, trialing, and expired states.
- **Data Integrity:** Strict database constraints and cascaded deletions.
- **Developer Experience First:** Fully dockerized environment and automated seeders for rapid development.

## Tech Stack

- **Framework:** Laravel 12
- **Language:** PHP 8.5
- **Database:** MySQL 8.4
- **Environment:** Laravel Sail (Docker)
- **Testing:** PHPUnit

## Getting Started

### Prerequisites

Ensure you have [Docker Desktop](https://www.docker.com/products/docker-desktop/) installed on your machine.

### Installation

1. **Clone the repository:**
```bash
git clone https://github.com/devc4rlos/laravel-subscription-expert.git
cd laravel-subscription-expert
```

2. **Install PHP dependencies:**
   *(Using a temporary docker container if you don't have PHP installed locally)*
```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php84-composer:latest \
    composer install --ignore-platform-reqs
```

3. **Setup environment:**
```bash
cp .env.example .env
```

4. **Start the environment:**
```bash
./vendor/bin/sail up -d
```

5. **Generate application key:**
```bash
./vendor/bin/sail artisan key:generate
```

6. **Run migrations and seeders:**
```bash
./vendor/bin/sail artisan migrate --seed
```

## Testing

The project uses PHPUnit for automated testing. To run the integrity and relationship tests:

```bash
./vendor/bin/sail artisan test
```

## Architecture & Database

The system relies on three core entities:

* **User:** The subscriber.
* **Plan:** Defines price, name, and features.
* **Subscription:** The pivot entity that links a User to a Plan, containing status and expiration dates.

## Standards & Workflow

This project follows strict development standards:

* **Git Flow:** All changes must be performed in feature branches.
* **Pull Requests:** Mandatory templates for PRs and Bug Reports.
* **Commit Messages:** Following Conventional Commits.

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.