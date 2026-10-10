# JustNo

JustNo is a small Laravel application that returns a random, occasionally
sassy reason to say no.

It provides a public frontend, shareable links, a versioned JSON API, and an
authenticated backoffice for managing the reasons.

## Features

- Random No Reason on the public homepage
- Shareable pages at `/no/{id}`
- Copy and native sharing support
- Versioned JSON API with rate limiting
- Backoffice authentication and password reset
- No Reason create, edit, delete, search, sorting, and pagination
- JSON import and export
- Alpine-based notifications and delete confirmation dialog
- Role-protected backoffice routes
- Pest feature tests using an isolated in-memory SQLite database

## Requirements

- PHP 8.4 or newer
- Composer
- Node.js and npm
- MySQL or MariaDB for local and production use

The application currently uses Laravel 13, Vite 8, Tailwind CSS, and Alpine.js.

## Installation

1. Install PHP dependencies:

   ```bash
   composer install
   ```

2. Create the environment file and application key:

   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Create a database and configure the `DB_*` values in `.env`.
   Set `INITIAL_ADMIN_EMAIL` and a unique random `INITIAL_ADMIN_PASSWORD`
   (at least 24 characters). Generate one with
   `php -r "echo bin2hex(random_bytes(24));"`.

4. Run migrations and the local development seeders:

   ```bash
   php artisan migrate --seed
   ```

   The seeders create one active admin and ten example reasons. Repeating them
   does not reset passwords or duplicate records. Production skips example
   reasons, but still provisions the configured admin if it does not exist.

5. Install frontend dependencies and build the assets:

   ```bash
   npm install
   npm run build
   ```

6. Start the development environment:

   ```bash
   composer run dev
   ```

The public application is available at the configured `APP_URL`. The
backoffice login is available at `/backoffice/login`.

## Docker

The lightweight Compose setup follows Device Manager: PHP 8.4 FPM, Nginx,
and MariaDB, with frontend assets compiled in a Node build stage. Docker
Desktop with Linux containers is sufficient; host PHP and Node are not required.

1. Copy `.env.docker.example` to `.env.docker` (PowerShell:
   `Copy-Item .env.docker.example .env.docker`). Set both database passwords
   consistently and choose a separate root password.
2. Build the images:

   ```bash
   docker compose --env-file .env.docker build
   ```

3. Generate a key and put the output in `APP_KEY` in `.env.docker`:

   ```bash
   docker compose --env-file .env.docker run --rm --no-deps app php artisan key:generate --show
   ```

4. Generate a random admin password:

   ```bash
   docker compose --env-file .env.docker run --rm --no-deps app php -r "echo bin2hex(random_bytes(24));"
   ```

   Put the output in `INITIAL_ADMIN_PASSWORD` in `.env.docker` and set
   `INITIAL_ADMIN_EMAIL` to your preferred login address. Keep the password in
   a password manager; never commit `.env.docker`.

5. Start the containers:

   ```bash
   docker compose --env-file .env.docker up -d
   ```

6. Once `up -d` has completed successfully, explicitly seed the initial data:

   ```bash
   docker compose --env-file .env.docker run --rm app php artisan db:seed --force
   ```

Open http://localhost:8081 or http://localhost:8081/backoffice/login.
The one-shot `init` service runs only migrations before the app starts.
Container starts and recreations never run seeders automatically. On a fresh
database, the manual seed command creates ten example reasons and an admin
using the configured email and password. A missing or short initial password
fails seeding instead of creating an insecure account. Run seeders again only
when explicitly needed. Existing admin credentials remain unchanged;
changing the environment password is not a password reset. Use the backoffice
password-change form to rotate it.

The database and uploaded profile images persist in separate named volumes.
PHP can write profile images; Nginx mounts them read-only. JSON imports are
read from temporary uploads and exports are returned directly; no durable
application files currently live in `storage/app`. Add persistence there if
future features start storing files. Logs go to stderr; sessions and cache
use the database.

`docker compose --env-file .env.docker down` stops the setup without deleting
data; adding `-v` deletes both the database and uploaded profile images.
Source changes require `docker compose --env-file .env.docker up -d --build`.
After changing environment values, recreate containers with `up -d`.
Logs are available via `docker compose --env-file .env.docker logs -f`.

This is a local, built-image setup, not a Vite hot-reload environment. The HTTP
port is bound to localhost and the database is not published. For production,
use `APP_ENV=production`, `APP_DEBUG=false`, a correct `APP_URL`, secure secrets,
HTTPS via a reverse proxy, and a database backup strategy. Runtime images omit
test dependencies; the SQLite test workflow below stays unchanged.

### Backups

Named volumes are not backups. Before a production deployment, schedule
MariaDB logical dumps using `mariadb-dump --single-transaction`, copy them
outside the Docker host, and back up the profile-images volume separately.
Keep a secure copy of `APP_KEY`, protect backups containing password hashes
and personal data, and define retention and encryption policies.

Validate restoration into a separate database, never over the live database:
import the dump, compare tables and data, then test application login and
reason retrieval against the restored copy. Repeat after database upgrades.
The local setup was restore-tested on 2026-10-09: all tables and data produced
identical SQL dumps before and after restoration (one admin, ten reasons).
This verification is not an automated backup job or a disaster-recovery plan.

## Development

Run only the Laravel server:

```bash
php artisan serve
```

Run Vite in watch mode:

```bash
npm run dev
```

Create a production frontend build:

```bash
npm run build
```

## Tests

Run the complete test suite:

```bash
composer test
```

The test environment is configured in `phpunit.xml` and uses:

- `APP_ENV=testing`
- SQLite with `DB_DATABASE=:memory:`
- Array-backed cache and sessions
- Synchronous queues

The suite covers authentication, roles, profiles, password flows, No Reason
CRUD operations, filtering, pagination, import/export, and the public API.

## Backoffice Import

The importer accepts a JSON file containing an array of strings:

```json
[
  "No. Absolutely not.",
  "That sounds like a problem for tomorrow."
]
```

Rules:

- Maximum file size: 2 MB
- Each entry must be a string
- Each reason must contain between 2 and 512 characters
- Duplicate, invalid, and oversized entries are skipped

## API

All `/api/v1` endpoints are limited to 120 requests per minute per IP address.

| Method | Endpoint | Description |
| --- | --- | --- |
| `GET` | `/api/v1/no` | Return a random No Reason |
| `GET` | `/api/v1/no/count` | Return the number of stored reasons |
| `GET` | `/api/v1/no/{id}` | Return one reason or a JSON 404 |
| `GET` | `/api/v1/health` | Lightweight health response |
| `GET` | `/api/v1/status` | Service and database status |
| `GET` | `/api/v1/tea` | Return the intentional HTTP 418 response |

Example response:

```json
{
  "id": 12,
  "reason": "No. Absolutely not."
}
```

## Inspiration

The original idea was inspired by
[No-as-a-Service](https://github.com/hotheadhacker/no-as-a-service).

## License

JustNo is licensed under the GNU Affero General Public License v3.0 only.
See [LICENSE](LICENSE) for the complete license text.
