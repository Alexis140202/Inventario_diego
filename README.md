Iniciar Proyecto

php artisan serve
npm run dev

--Dependencias

composer install
npm install

--
Cambios en la DB
php artisan migrate
-- correr 1 migracion
php artisan migrate --path=database/migrations/0001_01_01_000000_create_users_table.php

git pull - traer cambios

--resetear cambios (eliminar los locales y traer los del github)

git reset --hard
git pull --force

-- commit

git init
git add .
git commit -m "comentario(cambio que hiciste)"
git push

- -- Folder de vistas
  Resources/js/pages

jordy es cabro y agregue dos dependencias

npm install @headlessui/vue
npm install @heroicons/vue

Subir imagenes
git add -f storage/app/public/tiendas/*

cambias "tiendas" por la carpeta de imagenes que tengas 
