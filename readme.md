# Frame Sistema

Sistema de gestión de proyectos, teams (crew), clientes, centros de costo, jornadas, reportes y contratos de Frame.

Stack: Laravel 13, PHP 8.3, MySQL 8. Entorno Docker con [Laravel Sail](https://laravel.com/docs/sail).

## Requisitos

- PHP >= 8.3 (extensiones: `pdo_mysql`, `mbstring`, `gd`, `zip`, `xml`, `bcmath`)
- Composer 2
- MySQL 8
- Node + Yarn/NPM (solo para compilar assets con laravel-mix)

## Instalación local

```bash
cp .env.example .env        # completar DB_* y MAIL_*
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Nota: el login exige que `users.permissions` tenga un JSON con ids de rol (ej. `["1"]` = Super Administrador). `UsersTableSeeder` ya lo setea en los usuarios iniciales; para otros usuarios asignarlo a mano.

Si las migraciones fallan con `Row size too large`, usar `DB_CHARSET=utf8` y `DB_COLLATION=utf8_unicode_ci` en `.env`.

## Docker (Laravel Sail)

```bash
cp .env.example .env        # DB_USERNAME=root, DB_PASSWORD=secret, DB_DATABASE=frame_sistema
composer install            # o: docker run --rm -v $(pwd):/app composer install --ignore-platform-reqs
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
```

App en http://localhost (cambiar con `APP_PORT`). El compose define `DB_HOST=mysql` y charset utf8. Comandos útiles:

```bash
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'   # opcional, en ~/.zshrc
sail up -d / sail down          # levantar / bajar
sail artisan migrate            # artisan
sail composer require x/y       # composer
sail test                       # tests
sail mysql                      # consola MySQL
sail shell                      # shell dentro del contenedor
sail logs -f                    # logs
```

MySQL queda expuesto en `localhost:3306` (cambiar con `FORWARD_DB_PORT`).

El `Dockerfile` de la raíz es una imagen de producción (php-apache), independiente de Sail.

## Assets

```bash
yarn install
yarn dev        # o: yarn prod
```

## Tests

```bash
php artisan test
```

## Notas técnicas

- **Excel:** `app/Support/Excel` reimplementa la API de `maatwebsite/excel` 2.x (`Excel::create`, `sheet`, `fromArray`, `cell(s)`, `download`, `load`) sobre PhpSpreadsheet.
- **Roles y permisos:** el acceso real se controla con `users.permissions` (JSON) y `App\RoleUser`. Los modelos `App\Role` y `App\Permission` extienden `spatie/laravel-permission`.
- **Word:** los contratos se generan con `phpoffice/phpword`.
- **Rutas:** `routes/web.php` usa el estilo `'Backend\XController@method'`; el namespace se aplica en `AppServiceProvider`.
- **Variables de entorno renombradas en Laravel 13:** `MAIL_MAILER`, `CACHE_STORE`, `BROADCAST_CONNECTION`.
