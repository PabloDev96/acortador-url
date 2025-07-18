# 🔗 Acortador de URLs con Laravel

Este es un acortador de URLs construido con Laravel. Permite introducir una URL larga y obtener un enlace corto que redirige automáticamente a la original. Está diseñado para aprender sobre Laravel, despliegue con Docker y Render, y gestión de rutas simples.

---

## 🚀 Demo en línea

👉 [https://acortador-url-18kt.onrender.com](https://acortador-url-18kt.onrender.com)

---

## 🧠 ¿Cómo funciona?

1. El usuario envía una URL desde el formulario principal.
2. Laravel genera un código aleatorio (6 caracteres) y lo guarda en la base de datos con la URL original.
3. El sistema responde con un enlace acortado como:
   ```
   https://acortador-url-18kt.onrender.com/Ab12Cd
   ```
4. Al acceder a ese enlace, Laravel redirige automáticamente a la URL original y registra la visita.

---

## 🧰 Tecnologías utilizadas

- PHP 8.2.12
- Laravel 12.20.0
- PostgreSQL
- Apache
- Docker
- Composer
- Render (para el despliegue)

---

## 📦 Estructura básica del proyecto

```
app/
 └── Http/Controllers/UrlController.php
resources/
 └── views/acortador.blade.php
routes/
 └── web.php
database/
 └── migrations/create_urls_table.php
public/
 └── clon.png (ícono copiar)
 └── tijeras.png (ícono tijera)
```

---

# 🛠️ Instalación del Proyecto Laravel y Subida a GitHub con SSH (Puerto 443)

## 1. Crear el proyecto Laravel

```bash
composer create-project laravel/laravel acortador-url
```

O si ya estaba creado, simplemente navegar a la carpeta del proyecto:

```bash
cd acortador-url
```

## 2. Inicializar repositorio Git

```bash
git init
```

## 3. Crear clave SSH (si no existe)

```bash
ssh-keygen -t ed25519 -C "tu-email@ejemplo.com"
```

Presiona `Enter` para aceptar la ubicación por defecto.

## 4. Agregar clave SSH a GitHub

- Copiar clave pública:

```bash
clip < ~/.ssh/id_ed25519.pub
```

- Ir a: [https://github.com/settings/keys](https://github.com/settings/keys)
- Click en **"New SSH Key"**
- Pegar la clave y guardar

## 5. Configurar Git para usar el puerto 443 (por si el puerto 22 está bloqueado)

Crear el archivo de configuración SSH:

```bash
notepad ~/.ssh/config
```

Y agregar:

```txt
Host github.com
  HostName ssh.github.com
  User git
  Port 443
```

## 6. Establecer el repositorio remoto

```bash
git remote add origin ssh://git@ssh.github.com:443/PabloDev96/acortador-url.git
```

Verificar:

```bash
git remote -v
```

## 7. Hacer primer commit y push

```bash
git add .
git commit -m "Instalación inicial de Laravel"
git push -u origin master
```

---

## 8. Clonar el proyecto en otra máquina

```bash
git clone ssh://git@ssh.github.com:443/PabloDev96/acortador-url.git
cd acortador-url
```

## 9. Instalar dependencias y levantar el proyecto localmente

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

El proyecto estará disponible en: [http://localhost:8000](http://localhost:8000)

---

## ☁️ Despliegue en Render con Docker

1. Crear cuenta en [Render](https://render.com/).
2. Subir el código a GitHub (público o autorizado).
3. Crear Web Service → seleccionar **Docker**.
4. Usar un `Dockerfile` personalizado con PHP, Apache y PostgreSQL:

   ```Dockerfile
   FROM php:8.2-apache

   RUN apt-get update && apt-get install -y \
       git unzip libzip-dev libpq-dev zip curl \
       && docker-php-ext-install zip pdo pdo_pgsql

   RUN a2enmod rewrite

   COPY . /var/www/html
   WORKDIR /var/www/html

   COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
   RUN composer install --no-dev --optimize-autoloader

   RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

   ENV APACHE_DOCUMENT_ROOT /var/www/html/public
   RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf

   CMD php artisan migrate --force && apache2-foreground
   ```

5. Configurar variables de entorno:
   - `APP_KEY`, `APP_ENV=production`, `APP_DEBUG=false`, etc.
   - `DB_CONNECTION=pgsql`, `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` desde PostgreSQL de Render.

6. Esperar despliegue y acceder a la URL pública.

---

## 📌 Mejoras futuras (To-Do)

- [ ] Panel de administración con estadísticas.
- [ ] Top de URLs más visitadas.
- [ ] Autenticación de usuarios con Laravel Breeze.
- [ ] Panel para gestión de URLs (editar/eliminar).
- [ ] Dominio propio con HTTPS.

---

## 👨‍💻 Autor

- **Pablo Díaz**
- GitHub: [PabloDev96](https://github.com/PabloDev96)
