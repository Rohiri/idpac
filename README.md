# IDPAC
_Prueba IDPAC desarrollador backend_

### Pre-requisitos

- Php 7.4.0
- Postgresql o Mysql
- Node & npm
- Composer
- Extensión pdo_pgsql habilitada si se usa postgres.
- Extensión pdo_mysql habilitada si se usa Mysql o MariaDB.

### Instalación

1. Clonar el repositorio en la carperta del servidor web.

```sh
git clone https://github.com/Rohiri/idpac.git
```

2.  Ingresamos a la raiz del proyecto e Instalamos las dependencias de PHP.

```sh
composer install
```

3. Instalar dependencias Javascript

```sh
npm install
```

4. Compilamos assets con laravel mix

```sh
npm run dev
```

5. Copiamos el archivo  `.env.example` a  `.env` para configurar nuestras variables de entorno.

```sh
`cp .env.example .env`
```

5. Editamos nuestro archivo .env para configurar las variables
- `DB_CONNECTION=` Variable de entorno para el tipo de base de datos (mysql o pgsql)
- `DB_HOST=` Variable de entorno para el host de BD.
- `DB_PORT=` Variable de entorno para el puerto de BD.
- `DB_DATABASE=` Variable de entorno para el nombre de BD.
- `DB_USERNAME=` Variable de entorno para el usuario de BD.
- `DB_PASSWORD=` Variable de entorno para la contraseña de BD.

6. Generamos llave de crifrado con el siguiente comando:

```sh
php artisan key:generate
```

7. Como ya configuramos nuestras variables de entorno para la base de datos, ejecutaremos nuestras migraciones y seeders.

```sh
php artisan migrate:refresh --seed
```

## Autor

**William Ricardo Torres Curtidor**