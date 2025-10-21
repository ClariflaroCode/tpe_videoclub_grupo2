# tpe_videoclub_grupo2
Proyecto de videoclub creado para la cátedra de Web 2. 

**Integrantes**: Luciano Sánchez Tomé(lsancheztome@alumnos.exa.unicen.edu.ar) y Julieta Watts(jwatts@alumnos.exa.unicen.edu.ar)

**Temática**: Videoclub

**Descripción**: 
Sitio web para exponer un catálogo de películas. Cada película tiene un único director y un director puede haber hecho muchas películas, una o ninguna.
El sitio permite:
  - Gestionar (Agregar, editar,eliminar y visualizar) un catálogo de películas
  - Administrar ("...") un cátalogo de directores de cine.
  - Filtrar películas por director.
El sitio web fue creado utilizando el enfoque **Server Side Rendering**, con el lenguaje de programación php, utilizando la interfaz PDO y como bases de datos MySQL. El sitio cuenta con una interfaz de administrador y una interfaz para un usuario común que visita el sitio, el administrador es el único que puede realizar las acciones de administración de los catálogos de director y películas, (veáse la alta, baja y modificación de los datos).
**Nota:** Para poder acceder como administrador al sitio se debe iniciar sesión con el usuario: webadmin y con la contraseña: admin. 

**Instrucciones para desplegar el sitio:**
  - Para poder ejecutar el proyecto se requiere de un servidor web que corra Apache, en la cátedra utilizamos Xampp (disponible tanto para Linux como para Windows) y que por defecto instala PHP y MySQL.
  - Crear una carpeta dentro de la carpeta "htdocs" que se crea con la instalación de XAMPP.
  - Clonar el repositorio dentro de la carpeta creada en el inciso anterior.
  - Para que el servidor web ejecute nuestro proyecto debemos iniciar la ejecución del servidor de Apache y de MySQL Database clickeando en los botones que ofrece la interfaz de XAMPP 
  - Abrir el navegador y escribir la url "localhost/" y el nombre de la carpeta creada en el paso 3. 

  Instrucciones para importar la base de datos:
  - Abre phpMyAdmin en tu navegador.
  - Crea una nueva base de datos llamada tpe.
  - El sitio se encargará de rellenar con los datos correspondientes al ejecutarse por primera vez. 


**Diagrama de Entidades y Relaciones**: 
[DER](videoclub_derext.pdf)

**SQL**: [SQL](tpe.sql)
