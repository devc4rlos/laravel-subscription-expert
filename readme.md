# Laravel Subscription Expert

## Getting Started

### Prerequisites

* Docker & Docker Compose
* Composer

## Git Hooks (CaptainHook)

This project uses CaptainHook to ensure code quality. Hooks are automatically installed when running `composer install`
or `composer dump-autoload`.

* **Pre-commit**: Runs Laravel Pint only on modified files.
* **Pre-push**: Runs PHPStan (level 9) and PHPUnit before pushing to the repository.

To skip validation (emergency only):
`git commit -m "message" --no-verify`
