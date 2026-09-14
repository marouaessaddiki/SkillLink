# SkillLink deployment

## Docker local or VPS

Prerequisites: Docker Engine and Docker Compose v2.

1. Copy the Docker environment file:

```bash
copy .env.docker.example .env
```

On Linux/macOS use `cp` instead of `copy`.

2. Generate an application key:

```bash
docker compose run --rm app php artisan key:generate --show
```

Put the generated value in `.env` as `APP_KEY=...`.

3. Build and start the stack:

```bash
docker compose up -d --build
```

The application is available at `http://localhost:8000`. The `app` service runs migrations automatically after MySQL becomes healthy. The MySQL host port is `3307` to avoid conflicts with a local MySQL installation.

Services:

- `nginx`: public HTTP entry point;
- `app`: PHP-FPM Laravel application;
- `db`: MySQL 8.4 database;
- `queue`: Laravel database queue worker.

Useful commands:

```bash
docker compose logs -f app

docker compose exec app php artisan migrate:status
docker compose exec app php artisan db:seed
docker compose down
```

The named `mysql_data` volume keeps database data between restarts. To remove all local data, use `docker compose down -v`.

## Cloud deployment

The same image can be deployed on any service supporting Docker Compose or separate containers, such as a VPS, Azure Container Apps, AWS ECS, Render, Railway, or Fly.io.

Set these production values as platform secrets/environment variables:

- `APP_KEY`;
- `APP_URL`;
- `APP_ENV=production`;
- `APP_DEBUG=false`;
- `DB_CONNECTION=mysql`;
- `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`;
- mail provider variables if email delivery is enabled.

Expose only Nginx publicly. Keep MySQL on a private network, run `php artisan migrate --force` as a release step, and run `php artisan queue:work --sleep=3 --tries=3 --timeout=90` as a worker process.

The repository CI/CD workflow at `.github/workflows/ci.yml` runs PHP tests, builds Vite assets, validates Compose, and builds the Docker image. Pushes to `main` publish `ghcr.io/<owner>/<repository>:latest` and a commit-sha tag. A cloud provider can be configured to redeploy from that image after a successful push.
