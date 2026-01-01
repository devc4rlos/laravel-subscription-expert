# SaaS Subscription Manager

[![Laravel Version](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel)](https://laravel.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.5-777BB4?style=flat-square&logo=php)](https://www.php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=flat-square)](LICENSE)

## About

A robust subscription and plan management system built with **Laravel 12** and **PHP 8.5**, focused on solving
real-world software company (SaaS) problems. The project simulates a complete client cycle: from registration and plan
selection to subscription lifecycle management.

## Core Features

- **Plan Management:** Administrative interface for creating and controlling packages (Basic, Pro, Diamond).
- **Subscription Lifecycle:** Automated status control (Active, Cancelled, Expired).
- **Access Control (ACL):** Route protection differentiating standard users from administrators.
- **Data Scalability:** Optimized database modeling with complex Eloquent relationships.

## Technical Highlights

- **Modern Architecture:** Extended MVC base with functional components (**Livewire Volt**) and reactive UI Kit
  (**Livewire Flux**).
- **Security:** Implementation of custom Middlewares, strict validation via Form Requests, and authentication via
  Laravel Fortify.
- **Code Quality (QA):** Strict pipeline with **Larastan (Level 9)**, **Pint**, and **CaptainHook** to ensure standards
  before every commit.
- **Agile Management:** Project structured to simulate a real environment with Kanban, weekly Milestones, and
  Conventional Commits.

---

## Tech Stack

- **Framework:** Laravel 12.x
- **Language:** PHP 8.5
- **Frontend:** Livewire Volt (Functional API) + Livewire Flux
- **Auth:** Laravel Fortify (Headless)
- **Environment:** Laravel Sail (Docker)
- **QA:** CaptainHook, Larastan, Laravel Pint

---

## Getting Started

Follow the steps below to start the development environment in minutes.

### Prerequisites

- Docker Desktop & Docker Compose
- Composer (optional, via Docker)

### Installation

1. **Clone the repository:**

   ```bash
    git clone https://github.com/devc4rlos/laravel-subscription-expert.git
    cd laravel-subscription-expert
    ```
2. **Configure environment variables:**

    ```bash
    cp .env.example .env
    ```

3. **Install dependencies:** Use Docker to ensure compatibility with PHP 8.5:

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        composer:latest \
        composer install --ignore-platform-reqs
    ```

4. **Start Sail environment:**

    ```bash
    ./vendor/bin/sail up -d
    ```

5. **Final Setup (Key, DB, and Frontend):**

    ```bash
    ./vendor/bin/sail artisan key:generate
    ./vendor/bin/sail artisan migrate --seed
    ./vendor/bin/sail npm install && ./vendor/bin/sail npm run build
    ```

---

## Git Hooks (CaptainHook)

This project uses **CaptainHook** to automatically ensure code quality.

* **Pre-commit:** Runs **Laravel Pint** only on modified files.
* **Pre-push:** Runs **PHPStan (Level 9)** and **PHPUnit** before remote push.

**Skip validation (emergencies only):**

```bash
git commit -m "urgent message" --no-verify
```

---

## Quality Assurance (Manual)

Run tools manually inside the container:

**Linting (Style):**

```bash
./vendor/bin/sail bin pint
```

**Static Analysis (Errors):**

```bash
./vendor/bin/sail bin phpstan
```

---

## Testing

The project uses PHPUnit for automated testing. To run the integrity and relationship tests:

```bash
./vendor/bin/sail artisan test
```

## Useful Sail Commands

* **Stop containers:** `./vendor/bin/sail down`
* **Access container shell:** `./vendor/bin/sail shell`
* **Run Artisan commands:** `./vendor/bin/sail artisan <command>`

## Standards & Workflow

This project follows strict development standards:

* **Git Flow:** All changes must be performed in feature branches.
* **Pull Requests:** Mandatory templates for PRs and Bug Reports.
* **Commit Messages:** Following Conventional Commits.

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
