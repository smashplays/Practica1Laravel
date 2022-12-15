# Comandos usados para la practica de Laravel

## Instalación

Comando para la instalación de mi proyecto con Composer

```bash
  composer create-project laravel/laravel practica1-jesusterres
```

## Crear tabla con migrations

Comando para hacer el archivo de la migration

```bash
  php artisan make:migration create_students_table
```

Ejecución de las migrations

```bash
  php artisan migrate
```

## Crear un seeder que se encargue de rellenar la tabla alumno

Comando para hacer el archivo del Seeder

```bash
  php artisan make:seeder StudentsSeeder
```

Ejecución de los Seeders

```bash
  php artisan db:seed --class=StudentsSeeder
```

## Crear un controller AlumnoController

Comando para hacer el archivo del Controller

```bash
  php artisan make:controller StudentController
```

## Crear un middleware que asegure que el id de las rutas es numérico, entero y positivo.

Comando para crear el Middleware

```bash
  php artisan make:middleware ValidateId
```