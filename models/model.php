<?php
class model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _deploy() {
    $hash = '$2y$10$dHAHTDMTyoeNTDvTOXTlO.0JxV/pebIg0DcCZ2te33QMhygGJCdwa';
    $query = $this->db->query('SHOW TABLES');
    $tables = $query->fetchAll(PDO::FETCH_COLUMN);

    if(count($tables) == 0) {
        $sql = <<<SQL
CREATE TABLE director (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    sexo CHAR(1) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    reputacion INT DEFAULT NULL,
    pais_origen VARCHAR(30) NOT NULL
);

CREATE TABLE pelicula (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(40) NOT NULL,
    duracion INT NOT NULL,
    imagen TEXT NOT NULL,
    precio FLOAT(6,2) NOT NULL,
    descripcion TEXT NOT NULL,
    fecha_lanzamiento DATE NOT NULL,
    atp TINYINT(1) NOT NULL,
    director_id INT NOT NULL,
    genero VARCHAR(30) NOT NULL,
    distribuidora VARCHAR(40) NOT NULL,
    FOREIGN KEY (director_id) REFERENCES director(id)
);

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(40) NOT NULL,
    email VARCHAR(40) NOT NULL,
    password VARCHAR(40) NOT NULL
);

INSERT INTO director (nombre, sexo, fecha_nacimiento, reputacion, pais_origen) VALUES
('shawn levy', 'm', '1968-07-23', 3, 'canada'),
('andrew adamson', 'm', '1966-12-01', 4, 'nueva zelanda'),
('james cameron', 'm', '1954-08-16', 5, 'canada'),
('steven spielberg', 'm', '1946-12-18', 5, 'estados unidos');

INSERT INTO pelicula (titulo, duracion, imagen, precio, descripcion, fecha_lanzamiento, atp, director_id, genero, distribuidora) VALUES
('tiburon', 120, 'url', 120.00, 'Tiburón...', '1975-06-20', 0, 4, 'terror', 'universal pictures'),
('jurassic park', 120, 'url', 200.00, 'Parque Jurásico...', '1993-06-11', 1, 4, 'terror', 'universal pictures'),
('e.t. el extraterrestre', 120, 'url', 180.00, 'Filme comienza...', '1982-06-11', 1, 4, 'ciencia ficcion', 'universal pictures'),
('terminator', 108, 'url', 600.00, 'En la madrugada...', '1984-10-26', 1, 3, 'ciencia ficcion', 'orion pictures');

INSERT INTO usuario (nombre, email, 'password') VALUES
('webadmin', 'webadmin@gmail.com', $hash)
SQL;

        $this->db->exec($sql);
    }
}
    }
?>