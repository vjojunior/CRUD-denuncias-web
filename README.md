# Denuncias Ciudadanas

Una simple aplicación web para gestionar denuncias ciudadanas.

## Características

- Listar, crear, editar y eliminar denuncias.
- Interfaz basada en modales (sin recarga de página).
- Funcionalidad de búsqueda.
- Paginación.

## Tecnologías Utilizadas

- PHP
- MySQL
- JavaScript (con SweetAlert2)
- Tailwind CSS

## Estructura del Proyecto

- `app/`: Contiene la lógica de la aplicación (controladores, modelos y vistas).
  - `controllers/`: Maneja la lógica de las peticiones.
  - `models/`: Interactúa con la base de datos.
  - `views/`: Contiene los archivos de la interfaz de usuario.
- `config/`: Contiene los archivos de configuración.
  - `database.php`: Clase para la conexión a la base de datos.
  - `config.php`: Credenciales de la base de datos.
- `public/`: Contiene los archivos públicos (CSS, JS, imágenes).
- `database.sql`: Script para la creación de la base de datos y la tabla de denuncias.

## Configuración de la Base de Datos

1. Cree una nueva base de datos en MySQL llamada `municipalidad`.
2. Importe el archivo `database.sql` en la base de datos `municipalidad`.
3. Configure las credenciales de la base de datos en el archivo `config/config.php`.

## Cómo Ejecutar el Proyecto

### Usando XAMPP

1. Copie la carpeta del proyecto en el directorio `htdocs` de XAMPP.
2. Inicie los servicios de Apache y MySQL en XAMPP.
3. Abra su navegador y vaya a `http://localhost/prueba/`.

### Usando el Servidor Incorporado de PHP

1. Abra una terminal en la raíz del proyecto.
2. Ejecute el siguiente comando:

    ```bash
    php -S localhost:8000
    ```

3. Abra su navegador y vaya a `http://localhost:8000/`. (Nota: es posible que deba ajustar la constante `BASE_URL` en `index.php` a `/` para que esto funcione correctamente).

4. Modo de uso:
    - Para listar las denuncias, haga clic en el botón "Listar Denuncias".
    - Para crear una nueva denuncia, haga clic en el botón "Crear Denuncia".
    - Para editar una denuncia, haga clic en el botón "Editar" en la lista de denuncias.
    - Para eliminar una denuncia, haga clic en el botón "Eliminar" en la lista de denuncias.

5. Interfaz de usuario:
    [Interfaz de usuario](media/pag-denunciasMunicipalidad.png)
