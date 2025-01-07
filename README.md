# Plugin SuperGIROS Norte del Valle

Este es un plugin personalizado para **SuperGIROS Norte del Valle**. Su función principal es crear y gestionar tipos de contenido personalizados (Post Types), taxonomías personalizadas, metaboxes y endpoints de la API REST para manejar datos como Noticias, Documentos, Portafolios, Loterías y Sorteos.

## Características del Plugin

- Crea **Post Types** personalizados para:
  - **Noticias**
  - **Documentos**
  - **Portafolio**
  - **Loterías**
  - **Sorteos**
- Crea **Taxonomías** personalizadas para:
  - **Noticias**
  - **Documentos**
  - **Portafolio**
- **Metaboxes** personalizados para:
  - **Documentos**
  - **Loterías**
- Registra **EndPoints de la API REST** para los Post Types y los datos de:
  - **Noticias**
  - **Documentos**
  - **Portafolio**
  - **Loterías**
  - **Sorteos**
  - **Post**

## Requisitos

- **WordPress** 5.0 o superior.
- **PHP** 7.4 o superior.
- **MySQL** 5.6 o superior (o MariaDB).

## Instalación

### Opción 1: Instalación desde el panel de administración de WordPress

1. Ve a **Plugins > Añadir nuevo** en el panel de administración de WordPress.
2. Haz clic en el botón **Subir plugin**.
3. Selecciona el archivo ZIP del plugin (por ejemplo, `supergiros-norte-del-valle-plugin.zip`).
4. Haz clic en **Instalar ahora** y luego en **Activar**.

### Opción 2: Instalación manual (a través de FTP)

1. Descarga el archivo ZIP del plugin.
2. Extrae el archivo en tu computadora.
3. Usa un cliente FTP (como **FileZilla**) para subir la carpeta del plugin a la carpeta `/wp-content/plugins/` de tu instalación de WordPress.
4. Ve a **Plugins > Plugins instalados** en el panel de administración de WordPress y activa el plugin.

## Funcionalidades

### 1. Post Types Personalizados

El plugin registra los siguientes Post Types personalizados para gestionar el contenido:

- **Noticias**: Para crear y mostrar artículos de noticias relevantes.
- **Documentos**: Para agregar y administrar documentos como PDF, Word, etc.
- **Portafolio**: Para mostrar proyectos o trabajos realizados.
- **Loterías**: Para gestionar la información sobre las loterías.
- **Sorteos**: Para crear y gestionar sorteos.

### 2. Taxonomías Personalizadas

Se crean las siguientes taxonomías para organizar el contenido de manera más eficiente:

- **Noticias**: Para clasificar las noticias en categorías.
- **Documentos**: Para categorizar los documentos.
- **Portafolio**: Para agrupar los proyectos de portafolio.

### 3. Metaboxes Personalizados

Los siguientes **Metaboxes** se añaden para proporcionar campos adicionales a los Post Types:

- **Documentos**: Permite agregar información adicional como la fecha de publicación, tipo de documento, y enlaces a archivos.
- **Loterías**: Permite agregar detalles relacionados con las loterías, como número de sorteo, fecha, y premios.

### 4. API REST

El plugin expone varios **EndPoints de la API REST** que permiten acceder a los datos de los siguientes Post Types y taxonomías:

- **Noticias**
- **Documentos**
- **Portafolio**
- **Loterías**
- **Sorteos**
- **Post** (para acceder a los posts estándar de WordPress)

Los endpoints son los siguientes:

- `GET /wp-json/supergiros/v1/noticias`
- `GET /wp-json/supergiros/v1/documentos`
- `GET /wp-json/supergiros/v1/portafolio`
- `GET /wp-json/supergiros/v1/loterias`
- `GET /wp-json/supergiros/v1/sorteos`

Estos endpoints permiten interactuar con los datos de manera eficiente a través de solicitudes REST.

## Configuración

Una vez activado el plugin, no se requiere configuración adicional para que los tipos de contenido y taxonomías estén disponibles. Sin embargo, puedes personalizar los siguientes aspectos desde el panel de administración de WordPress:

- **Post Types**: Crear nuevos elementos de Noticias, Documentos, Portafolios, Loterías y Sorteos desde el menú de administración.
- **Metaboxes**: Los campos adicionales para Documentos y Loterías estarán disponibles al crear o editar entradas de esos tipos.

### Opciones adicionales

- **API REST**: Para acceder a los datos desde tu aplicación externa o móvil, puedes utilizar los endpoints mencionados anteriormente. La autenticación se maneja a través de las funciones estándar de WordPress (como el uso de tokens de autenticación JWT).

## Personalización

Si deseas personalizar aún más el comportamiento de los Post Types, taxonomías o los metaboxes, puedes agregar filtros y acciones en el archivo `functions.php` de tu tema.

Por ejemplo, para modificar la vista de los documentos:

```php
add_filter('manage_document_posts_columns', 'agregar_columnas_documentos');
function agregar_columnas_documentos($columns) {
    $columns['fecha_documento'] = 'Fecha de Documento';
    return $columns;
}
```

## Soporte

Si tienes problemas con la instalación o personalización del tema, puedes ponerte en contacto con nuestro equipo de soporte:

- **Correo electrónico:** johnfrivera1309@gmail.com
- **Teléfono:** +57 313 5100275
