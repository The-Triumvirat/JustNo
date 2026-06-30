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

4. Run migrations and the local development seeders:

   ```bash
   php artisan migrate --seed
   ```

   The seeders create local demo accounts and are disabled in production.
   Review `database/seeders/UserTableSeeder.php` before using them.

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
