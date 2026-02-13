# Docker Setup for LanguageCourses

## Requirements

- Docker Desktop or Docker Engine
- Docker Compose

## 🚀 Quick Start - One Command!

```bash
cd .tools/docker
docker compose up -d --build
```

That's it! 🎉 The application will automatically:

- Copy the .env file
- Install PHP dependencies (composer)
- Install Node.js dependencies (npm)
- Build frontend assets
- Generate application key
- Run database migrations
- Seed database with test data (seeders) - only on first run
- Set appropriate permissions

Application will be available at: **http://localhost:8001**

## Application Access

- **Application**: http://localhost:8001
- **phpMyAdmin**: http://localhost:8081
    - Server: `db`
    - Username: `languagecourses`
    - Password: `secret`
    - Root password: `root`

## Container Structure

- **app**: Laravel application with PHP-FPM and Nginx (port 8001)
- **db**: MySQL 8.0 (port 3308)
- **redis**: Redis (cache and queues)
- **phpmyadmin**: Web interface for database management (port 8081)

## Useful Commands

### Stop Containers

```bash
docker compose down
```

### Restart Containers

```bash
docker compose restart
```

### View Logs

```bash
docker compose logs -f app
```

### Enter Application Container

```bash
docker exec -it languagecourses_app bash
```

### Enter Database Container

```bash
docker exec -it languagecourses_db mysql -u languagecourses -psecret languagecourses
```

### Clear Laravel Cache

```bash
docker exec -it languagecourses_app php artisan cache:clear
docker exec -it languagecourses_app php artisan config:clear
docker exec -it languagecourses_app php artisan route:clear
docker exec -it languagecourses_app php artisan view:clear
```

### Run Tests

```bash
docker exec -it languagecourses_app php artisan test
```

### Run Seeders

```bash
docker exec -it languagecourses_app php artisan db:seed
```

### Re-run Migrations (Warning - Clears Database!)

```bash
docker exec -it languagecourses_app php artisan migrate:fresh --seed
```

## Troubleshooting

### Permission Issues

```bash
docker exec -it languagecourses_app chown -R www-data:www-data /var/www/html
docker exec -it languagecourses_app chmod -R 775 storage bootstrap/cache
```

### Reset Database

```bash
docker exec -it languagecourses_app php artisan migrate:fresh --seed
```

### Rebuild Containers from Scratch

```bash
docker compose down -v
docker compose up -d --build
```

### Check Container Status

```bash
docker compose ps
```

### Check Initialization Logs

```bash
docker compose logs app
```

## Port Configuration

If ports are already in use, you can change them in `docker-compose.yml`:

```yaml
ports:
    - "8002:80" # Change from 8001 to 8002
```

## Update Dependencies

### PHP (Composer)

```bash
docker exec -it languagecourses_app composer update
```

### Node.js (NPM)

```bash
docker exec -it languagecourses_app npm update
docker exec -it languagecourses_app npm run build
```

## Clean Up and Restart

Complete cleanup and restart of the project:

```bash
# Stop and remove all containers and volumes
docker compose down -v

# Remove application image
docker rmi languagecourses-project-app

# Restart
docker compose up -d --build
```

## Management Script

Use the included management script for easier project management:

```bash
# Make script executable (first time only)
chmod +x manage.sh

# Available commands:
./manage.sh start    # Start project
./manage.sh stop     # Stop project
./manage.sh restart  # Restart project
./manage.sh build    # Rebuild and start project
./manage.sh logs     # View application logs
./manage.sh shell    # Enter application container
./manage.sh db       # Enter MySQL
./manage.sh seed     # Seed database
./manage.sh fresh    # Refresh database (migrate:fresh --seed)
./manage.sh reset    # Reset project (removes everything)
./manage.sh status   # Container status
```
