
# 🚀 Instalación del Proyecto Laravel y Subida a GitHub con SSH (Puerto 443)

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

> Alternativamente, se puede usar directamente el host y puerto en la URL remota.

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
