# 📊 Sistema de Finanzas Personales con Laravel + Filament
**Un proyecto práctico para gestionar ingresos, gastos y presupuestos personales con un panel administrativo moderno.**

___

## 🚀 Tecnologías Utilizadas

- Backend: Laravel 10+
- Panel Admin: Filament PHP 3.x
- Base de Datos: MySQL
- Frontend: Tailwind CSS + Livewire
- Gráficos: Filament Widgets + Chart.js

___

## ✨ Funcionalidades Principales
### 📌 Gestión de Usuarios

- Registro y autenticación de usuarios.
- Roles básicos (admin, usuario estándar).

### 💰 Movimientos Financieros

- Registro de ingresos y gastos con:
    - Monto, fecha, descripción y categoría.
    - Subida de imágenes (comprobantes o recibos).
- Filtros por fechas y categorías.

### 📂 Categorías Personalizadas
- Creación y edición de categorías (ej: "Comida", "Transporte", "Salario").

### 📅 Presupuestos Mensuales
- Asignación de presupuestos por categoría.
- Comparativa entre lo presupuestado y lo gastado.

### 📊 Reportes Gráficos
- Widgets interactivos en el dashboard:
    - Gráficos de barras para gastos vs ingresos.
    - Resumen mensual.
___

## 🛠️ Configuración del Proyecto
**Requisitos**
- PHP 8.2+
- Composer
- MySQL 5.7+

**Instalación**

 1. Clonar el repositorio:
```bash
git clone https://github.com/Mauro11F/finanzasConFilament.git
```
 2. Instalar dependencias:
```bash
composer install 
```
 3. Configurar entorno:
    -  Copiar `.env.example` a `.env` y ajustar credenciales de MySQL
 4. Migrar y poblar la base de datos:
```bash
php artisan migrate --seed  
```
 5. Generar enlace simbólico para imágenes:
```bash
php artisan storage:link  
```
 6. Iniciar el servidor:
```bash
php artisan serve  
```

### Acceso al Panel Admin
- URL: http://localhost:8000/admin
- Credenciales iniciales (seeder):
    - Email: admin@admin.com
    - Contraseña: admin123

## 📸


## 🌟 ¿Qué Aprendí?
- Filament PHP: Creación de CRUDs rápidos, widgets personalizados y manejo de recursos.
- Laravel: Relaciones Eloquent, validaciones y políticas de acceso.
- UX: Diseño de un panel intuitivo con Tailwind CSS.
- Despliegue: Configuración de almacenamiento de archivos en local.

___
¡Feedback y contribuciones son bienvenidos! 😊
___

## 🔗 Enlaces Útiles
- Documentación de Filament : [Filament.docs](https://filamentphp.com/docs/3.x/panels/installation)
- Demo: [Filament.Demo](https://demo.filamentphp.com/)
- Laravel Official Docs [Laravel.docs](https://laravel.com/docs/12.x/installation)
