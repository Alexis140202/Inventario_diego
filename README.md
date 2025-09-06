# 🛠️ Guía de Desarrollo Laravel + Vue  

## ▶️ Iniciar el proyecto  
```bash
php artisan serve     # Levantar servidor Laravel 🌐
npm run dev           # Iniciar Vite (assets) ⚡

📦 Instalación de dependencias
composer install   # Dependencias de PHP 🐘
npm install        # Dependencias de Node 📦
🗄️ Migraciones de Base de Datos
php artisan migrate   # Ejecutar todas las migraciones ✅


👉 Para correr una migración específica:

php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php

🔄 Actualizar código desde GitHub
git pull   # Traer los últimos cambios 📥


👉 Si quieres resetear cambios locales y traer todo desde GitHub:

git reset --hard
git pull --force

📝 Flujo de commits
git init                          # Inicializar repositorio 📂
git add .                         # Agregar cambios ✨
git commit -m "mensaje de cambio" # Confirmar cambios 📝
git push                          # Subir al repositorio 🚀

📂 Ubicación de vistas (Vue Pages)
resources/js/pages

🎨 Dependencias extra (UI/Icons)
npm install @headlessui/vue   # Componentes accesibles para Vue ♿
npm install @heroicons/vue    # Iconos bonitos en Vue 🎉

🖼️ Subir imágenes al repositorio

👉 Si tus imágenes están en storage/app/public/tiendas:

git add -f storage/app/public/tiendas/*


🔁 Cambia "tiendas" por la carpeta que necesites.

⚡ Optimización del proyecto
php artisan optimize:clear   # Limpieza de caché y optimización 🧹