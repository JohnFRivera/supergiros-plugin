# Plugin Personalizado - Intranet SuperGIROS Norte del Valle

Este plugin ha sido desarrollado exclusivamente para la intranet de **SuperGIROS Norte del Valle**. Su propósito principal es extender las funcionalidades de WordPress mediante la creación de múltiples tipos de contenido personalizado (Custom Post Types) y taxonomías asociadas, con el fin de gestionar eficazmente la información interna de la empresa.

---

## Funcionalidades principales

### 1. Noticias de la Empresa

- **Custom Post Type:** `noticias`
- **Taxonomías personalizadas:**
  - `tipos_noticias` (tipo: categoría)
  - `etiquetas_noticias` (tipo: etiqueta)

> Este módulo permite la publicación y organización de noticias internas relevantes para la empresa.

### 2. Documentos Corporativos

- **Custom Post Type:** `documentos`
- **Taxonomías personalizadas:**
  - `clasificaciones_documentos` (tipo: categoría)
  - `etiquetas_documentos` (tipo: etiqueta)

> Este apartado permite almacenar documentos en PDF relacionados con procesos internos, manuales, formatos, entre otros.

### 3. Portafolio de Productos y Servicios

- **Custom Post Type:** `portafolio`
- **Taxonomías personalizadas:**
  - `categorias_portafolio` (tipo: categoría)
  - `etiquetas_portafolio` (tipo: etiqueta)

> Se utiliza para gestionar y mostrar los productos y servicios ofrecidos por SuperGIROS Norte del Valle.

### 4. Resultados de Loterías y Planes de Premios

#### a. Resultados y Secos

- **Custom Post Type:** `resultados-y-secos`
  > Almacena los resultados diarios o semanales de las distintas loterías.

#### b. Planes de Premios

- **Custom Post Type:** `planes-de-premios`
  > Almacena los planes de premios asignados a cada lotería.

#### c. Loterías

- **Taxonomía personalizada:** `loterias` (tipo: categoría)
- **Funcionalidad adicional:** Cada término de la taxonomía `loterias` incluye un campo personalizado (meta box) para almacenar la URL del logo de la lotería.
- **Campo personalizado:** `_loteria_logotipo`

---

## Archivos

- `intranet-supergiros.php`: Archivo principal que se encarga de agrupar los modulos del plugin.
- `uninstall.php`: Este archivo se encarga de eliminar las publicaciones de los distintos tipos de contenido, incluyendo configuraciones y opciones que haya registrado el plugin al desinstalarlo.
- `inc/class-functions.php`: Esta clase se encarga de contener los metodos utilizados por los modulos, por ejemplo: **register_post_type()**, **register_taxonomy()**, etc.
- `inc/class-portafolio.php`: Esta clase se encarga de registrar el tipo de contenido **Portafolio**, con sus respectivas taxonomías y configuraciones.
- `inc/class-noticias.php`: Esta clase se encarga de registrar el tipo de contenido **Noticias**, con sus respectivas taxonomías y configuraciones.
- `inc/class-loterias.php`: Esta clase se encarga de registrar los tipos de contenidos **Resultados y secos** y **Planes de premios**, con su respectiva taxonomía, campos y configuraciones.
- `js/loterias.js`: Este archivo se encargar manejar el campo personalizado de la taxonomía **Loterías** usando jQuery.
- `inc/class-documentos.php`: Esta clase se encarga de registrar el tipo de contenido **Documentos**, con sus respectivas taxonomías y configuraciones.

---

## Requisitos

- WordPress 5.5 o superior
- PHP 7.4 o superior

---

## Instalación

1. Sube la carpeta del plugin al directorio `/wp-content/plugins/`.
2. Activa el plugin desde el panel de administración de WordPress.
3. Los tipos de contenido aparecerán automáticamente en el menú lateral.

---

## Créditos

Desarrollado por [John Freddy Rivera](https://www.linkedin.com/in/john-freddy-rivera-ayala/) para **SuperGIROS Norte del Valle**.
