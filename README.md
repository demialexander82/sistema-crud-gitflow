# Sistema de Gestión CRUD con Git Flow

Este es un proyecto CRUD (Create, Read, Update, Delete) desarrollado para demostrar el uso de Git Flow en un entorno de desarrollo colaborativo.

## Estructura de Ramas

- `main` - Rama principal con el código de producción
- `develop` - Rama de desarrollo donde se integran las características
- `qa` - Rama para pruebas de control de calidad
- `feature/*` - Ramas para desarrollo de nuevas características
- `hotfix/*` - Ramas para correcciones críticas

## Características Implementadas

1. Autenticación de usuarios
2. CRUD de usuarios
3. Validaciones de formularios
4. Generación de reportes en PDF
5. Mejoras en la interfaz de usuario

## Requisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Composer

## Instalación

1. Clonar el repositorio
2. Ejecutar `composer install`
3. Configurar la base de datos en `config/database.php`
4. Importar el esquema de la base de datos

## Uso de Git Flow

Para comenzar una nueva característica:
```bash
git flow feature start nombre-caracteristica
```

Para finalizar una característica:
```bash
git flow feature finish nombre-caracteristica
```
"# sistema-crud-gitflow" 
