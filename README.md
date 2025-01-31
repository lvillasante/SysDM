
# Sistema Web Dinámica miasmática

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

- **PHP 8.1 o superior**
- **Composer** (para la gestión de dependencias de PHP)
- **Symfony CLI** (opcional, pero recomendado)
- **Symfony 4.4** 
- **MySQL 5.7 o superior**
- **Servidor web** (como Apache o Nginx)
- **Git** (para clonar el repositorio)

### 3. Configuración del Archivo `.env`

Copia el archivo `.env` de ejemplo para crear el archivo de entorno:

```bash
cp .env .env.local
```

Edita el archivo `.env.local` para configurar la conexión a la base de datos. Asegúrarse de actualizar la variable `DATABASE_URL` con los datos de tu base de datos MySQL:

```env
DATABASE_URL="mysql://usuario:password@127.0.0.1:3306/nombre_base_de_datos?serverVersion=5.7"
```

### 4. Crear la Base de Datos

Ejecuta el siguiente comando para crear la base de datos:

```bash
php bin/console doctrine:database:create
```

### 5. Restaurar la Base de Datos

Para restaurar la base de datos desde un archivo de respaldo `.sql`, sigue estos pasos:

```bash
mysql -u usuario -p nombre_base_de_datos < ruta/al/archivo/respaldo.sql
```

### 6. Ejecutar el Servidor de Desarrollo

Para ejecutar el servidor web de Symfony en un entorno local, utiliza el siguiente comando:

```bash
symfony server:start
```

O con PHP directamente:

```bash
php -S localhost:8000 -t public
```

## Comandos adicionales

- **Crear base de datos**: `php bin/console doctrine:database:create`
- **Ejecutar migraciones**: `php bin/console doctrine:migrations:migrate`
- **Cargar fixtures**: `php bin/console doctrine:fixtures:load`

--
LV